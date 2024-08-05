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

    public function addSale($id_company, $id_client, $id_user, $total_price, $status) {
        $sql = $this->db->prepare("INSERT INTO sales SET idCompany = :id_company, idClient = :id_client, idUser = :id_user, dateSale = NOW(), totalPrice = :total_price, status = :status");
        $sql->bindValue(":id_company", $id_company);
        $sql->bindValue(":id_client", $id_client);
        $sql->bindValue(":id_user", $id_user);
        $sql->bindValue(":total_price", $total_price);
        $sql->bindValue(":status", $status);
        $sql->execute();
    }
}