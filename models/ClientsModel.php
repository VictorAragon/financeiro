<?php
class ClientsModel extends model {

    public function getList($offset, $id_company) {
        $array = array();

        $sql = $this->db->prepare("SELECT 
            clients.id, 
            clients.name, 
            clients.email, 
            clients.stars, 
            clients.phone, 
            clients.internal_obs, 
            clients_address.address, 
            clients_address.addressNumber, 
            clients_address.addressNeighborhood, 
            clients_address.addressCity, 
            clients_address.addressState, 
            clients_address.addressZipcode, 
            clients_address.addressComplement 
        FROM clients 
        LEFT JOIN clients_address ON clients_address.idClients = clients.id
        WHERE idCompany = :id_company
        LIMIT $offset, 10");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();


        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getInfo($id, $id_company) {
        $array = array();

        $sql = $this->db->prepare("SELECT 
            clients.id, 
            clients.name, 
            clients.email, 
            clients.stars, 
            clients.phone, 
            clients.internal_obs, 
            clients_address.address, 
            clients_address.addressNumber, 
            clients_address.addressNeighborhood, 
            clients_address.addressCity, 
            clients_address.addressState, 
            clients_address.addressZipcode, 
            clients_address.addressComplement 
        FROM clients 
        LEFT JOIN clients_address ON clients_address.idClients = clients.id 
        WHERE id = :id AND idCompany = :id_company");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    public function getCount($id_company) {
        $r = 0;

        $sql = $this->db->prepare("SELECT COUNT(*) AS c FROM clients WHERE idCompany = :id_company");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
        $row = $sql->fetch();

        $r = $row['c'];

        return $r;
    }

    public function add($id_company, $name, $email, $phone, $stars, $internal_obs, $addressZipcode, $address, $addressNumber, $addressComplement, $addressNeighborhood, $addressCity, $addressState) {
        $id_inserido = '';
        $sql = $this->db->prepare("INSERT INTO clients SET idCompany = :id_company, name = :name, email = :email, phone = :phone, stars = :stars, internal_obs = :internal_obs");
        $sql->bindValue(":id_company", $id_company);
        $sql->bindValue(":name", $name);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":phone", $phone);
        $sql->bindValue(":stars", $stars);
        $sql->bindValue(":internal_obs", $internal_obs);
        $sql->execute();
        
        $id_inserido = $this->db->lastInsertId();

        if($addressZipcode != '' && $id_inserido != '') {
            $sql = $this->db->prepare("INSERT INTO clients_address SET idClients = :idClients, addressZipcode = :addressZipcode, address = :address, addressNumber = :addressNumber, addressComplement = :addressComplement, addressNeighborhood = :addressNeighborhood, addressCity = :addressCity, addressState = :addressState");
            $sql->bindValue(":idClients", $id_inserido);
            $sql->bindValue(":addressZipcode", $addressZipcode);
            $sql->bindValue(":address", $address);
            $sql->bindValue(":addressNumber", $addressNumber);
            $sql->bindValue(":addressComplement", $addressComplement);
            $sql->bindValue(":addressNeighborhood", $addressNeighborhood);
            $sql->bindValue(":addressCity", $addressCity);
            $sql->bindValue(":addressState", $addressState);
            $sql->execute();
        }
    }

    public function edit($id, $id_company, $name, $email, $phone, $stars, $internal_obs, $addressZipcode, $address, $addressNumber, $addressComplement, $addressNeighborhood, $addressCity, $addressState) {
        $id_inserido = '';
        $sql = $this->db->prepare("UPDATE clients SET name = :name, email = :email, phone = :phone, stars = :stars, internal_obs = :internal_obs WHERE id = :id AND idCompany = :id_company");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->bindValue(":name", $name);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":phone", $phone);
        $sql->bindValue(":stars", $stars);
        $sql->bindValue(":internal_obs", $internal_obs);
        $sql->execute();
        
        $sql = $this->db->prepare("UPDATE clients_address SET addressZipcode = :addressZipcode, address = :address, addressNumber = :addressNumber, addressComplement = :addressComplement, addressNeighborhood = :addressNeighborhood, addressCity = :addressCity, addressState = :addressState WHERE idClients = :idClients");
        $sql->bindValue(":idClients", $id);
        $sql->bindValue(":addressZipcode", $addressZipcode);
        $sql->bindValue(":address", $address);
        $sql->bindValue(":addressNumber", $addressNumber);
        $sql->bindValue(":addressComplement", $addressComplement);
        $sql->bindValue(":addressNeighborhood", $addressNeighborhood);
        $sql->bindValue(":addressCity", $addressCity);
        $sql->bindValue(":addressState", $addressState);
        $sql->execute();

    }

    public function searchClientByName($name, $id_company) {
        $array = array();

        $sql = $this->db->prepare("SELECT clients.name, clients.id FROM clients WHERE name LIKE :name AND idCompany = :id_company");
        $sql->bindValue(":name", '%'.$name.'%');
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

}