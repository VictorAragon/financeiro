<?php
class InventoryModel extends model {
    public function getList($offset, $id_company) {
        $array = array();

        $sql = $this->db->prepare('SELECT * FROM inventory WHERE idCompany = :id_company LIMIT '.$offset.', 10');
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getInfo($id, $id_company) {
        $array = array();

        $sql = $this->db->prepare('SELECT * FROM inventory WHERE id = :id AND idCompany = :id_company');
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }
        return $array;
    }

    public function setLog($id_product, $id_company, $id_user, $action) {
        $sql = $this->db->prepare("INSERT INTO inventory_history SET idProduct = :idProduct, idUser = :idUser, action = :action, dateTime = NOW(), idCompany = :id_company");
        $sql->bindValue(":idProduct", $id_product);
        $sql->bindValue(":idUser", $id_user);
        $sql->bindValue(":action", $action);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
    }

    public function add($name, $price, $quant, $minQuant, $id_company, $id_user) {
        $sql = $this->db->prepare("INSERT INTO inventory SET name = :name, price = :price, quant = :quant, minQuant = :minQuant, idCompany = :id_company");
        $sql->bindValue(":name", $name);
        $sql->bindValue(":price", $price);
        $sql->bindValue(":quant", $quant);
        $sql->bindValue(":minQuant", $minQuant);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        $id_product = $this->db->lastInsertId();

        $this->setLog($id_product, $id_company, $id_user, 'add');
    }

    public function edit($id, $name, $price, $quant, $minQuant, $id_company, $id_user) {
        $sql = $this->db->prepare("UPDATE inventory SET name = :name, price = :price, quant = :quant, minQuant = :minQuant WHERE id = :id AND idCompany = :id_company");
        $sql->bindValue(":name", $name);
        $sql->bindValue(":price", $price);
        $sql->bindValue(":quant", $quant);
        $sql->bindValue(":minQuant", $minQuant);
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        $this->setLog($id, $id_company, $id_user, 'edt');
    }

    public function delete($id, $id_company, $id_user) {
        $sql = $this->db->prepare("DELETE FROM inventory WHERE id = :id AND idCompany = :id_company");
        $sql->bindValue(':id', $id);
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();

        $this->setLog($id, $id_company, $id_user, 'del');
    }

    public function searchProductsByName($name, $id_company) {
        $array = array();

        $sql = $this->db->prepare("SELECT inventory.name, inventory.id, inventory.price FROM inventory WHERE name LIKE :name AND idCompany = :id_company LIMIT 10");
        $sql->bindValue(":name", '%'.$name.'%');
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function downInventory($id_prod, $id_company, $quant_prod, $id_user) {
        $sql = $this->db->prepare("UPDATE inventory SET quant = quant - $quant_prod WHERE id = :id AND idCompany = :id_company");
        $sql->bindValue(":id", $id_prod);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        $this->setLog($id_prod, $id_company, $id_user, 'dwn');
    }
}