<?php
class Permissions extends model {
    private $group;
    private $permissions;
    
    public function setGroup($id, $idCompany) {
        $this->group = $id;
        $this->permissions = array();

        $sql = $this->db->prepare("SELECT permission_groups.params FROM permission_groups WHERE id = :id AND idCompany = :idCompany");
        $sql->bindValue('id', $id);
        $sql->bindValue('idCompany', $idCompany);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $row = $sql->fetch();

            if(empty($row["params"])) {
                $row["params"] = '0';
            }

            $params = $row["params"];

            $sql = $this->db->prepare("SELECT permission_params.name FROM permission_params WHERE id IN ($params) AND idCompany = :idCompany");
            $sql->bindValue(':idCompany', $idCompany);
            $sql->execute();

            if($sql->rowCount() > 0) {
                foreach($sql->fetchAll() AS $item) {
                    $this->permissions[] = $item["name"];
                }
            }
        }
    }

    public function hasPermission($name){
        if(in_array($name, $this->permissions)) {
            return true;
        } else {
            return false;
        }
    }

    public function getList ($id_company) {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM permission_params WHERE idCompany = :id_company");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getGroupList ($id_company) {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM permission_groups WHERE idCompany = :id_company");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getGroup ($id, $id_company) {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM permission_groups WHERE id = :id AND idCompany = :id_company");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
            $array['params'] = explode(',', $array['params']);
        }

        return $array;
    }

    public function add ($name, $id_company) {
        $sql = $this->db->prepare("INSERT INTO permission_params SET name = :name, idCompany = :id_company");
        $sql->bindValue(":name", $name);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
    }

    public function addGroup ($name, $list, $id_company) {
        $params = implode(',', $list);
        $sql = $this->db->prepare("INSERT INTO permission_groups SET name = :name, idCompany = :id_company, params = :params");
        $sql->bindValue(":name", $name);
        $sql->bindValue(":id_company", $id_company);
        $sql->bindValue(":params", $params);
        $sql->execute();
    }

    public function delete ($id) {
        $sql = $this->db->prepare("DELETE FROM permission_params WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function deleteGroup ($id) {
        $u = new Users();

        if ($u->findUsersInGroupPermission($id) == false) {
            $sql = $this->db->prepare("DELETE FROM permission_groups WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();
        }
    }

    public function editGroup ($name, $list, $id, $id_company) {
        $params = implode(',', $list);

        $sql = $this->db->prepare("UPDATE permission_groups SET name = :name, idCompany = :id_company, params = :params WHERE id = :id");
        $sql->bindValue(":name", $name);
        $sql->bindValue(":id_company", $id_company);
        $sql->bindValue(":params", $params);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }
}