<?php
class SalesModel extends model {
    public function getList($offset, $id_company) {
        $array = array();

        $sql = $this->db->prepare("SELECT 
            sales.id, 
            sales.dateSale, 
            sales.totalPrice, 
            sales.status,
            clients.name AS clientName
        FROM sales 
        LEFT JOIN clients ON clients.id = sales.idClient
        WHERE sales.idCompany = :id_company
        ORDER BY sales.dateSale DESC
        LIMIT $offset, 10");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function addSale($id_company, $id_client, $id_user, $quant, $status) {
        $i = new InventoryModel();

        $sql = $this->db->prepare("INSERT INTO sales SET idCompany = :id_company, idClient = :id_client, idUser = :id_user, dateSale = NOW(), totalPrice = :total_price, status = :status");
        $sql->bindValue(":id_company", $id_company);
        $sql->bindValue(":id_client", $id_client);
        $sql->bindValue(":id_user", $id_user);
        $sql->bindValue(":total_price", '0');
        $sql->bindValue(":status", $status);
        $sql->execute();

        $id_sale = $this->db->lastInsertId();
        $total_price = 0;

          foreach($quant AS $k => $v) {
            $sql = $this->db->prepare("SELECT inventory.price FROM inventory WHERE idCompany = :id_company AND id = :id");
            $sql->bindValue(":id_company", $id_company);
            $sql->bindValue(":id", $k);
            $sql->execute();
            
            if($sql->rowCount() > 0) {
                $row = $sql->fetch();
                $price = $row['price'];

                $sqlP = $this->db->prepare("INSERT INTO sales_products SET idCompany = :id_company, idSale = :id_sale, idProduct = :id_product, quant = :quant, salePrice = :sale_price");
                $sqlP->bindValue(':id_company', $id_company);
                $sqlP->bindValue(':id_sale', $id_sale);
                $sqlP->bindValue(':id_product', $k);
                $sqlP->bindValue(':quant', $v);
                $sqlP->bindValue(':sale_price', $price);
                $sqlP->execute();

                $i->downInventory($k, $id_company, $v, $id_user);

                $total_price += $price * $v;
            }
        }

        $sql = $this->db->prepare("UPDATE sales SET totalPrice = :total_price WHERE id = :id");
        $sql->bindValue(":total_price", $total_price);
        $sql->bindValue(":id", $id_sale);
        $sql->execute();
    }

    public function getInfo($id, $id_company) {
        $array = array();

        $sql = $this->db->prepare("SELECT sales.*, clients.name AS client_name
        FROM sales 
        LEFT JOIN clients ON clients.id = sales.idClient
        WHERE sales.id = :id AND sales.idCompany = :id_company");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array['info'] = $sql->fetch();
        }

        $sql = $this->db->prepare("SELECT sales_products.*, inventory.name 
        FROM sales_products 
        LEFT JOIN inventory ON inventory.id = sales_products.idProduct
        WHERE sales_products.idSale = :id_sale AND sales_products.idCompany = :id_company");
        $sql->bindValue(':id_sale', $id);
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array['products'] = $sql->fetchAll();
        }

        return $array;
    }
}