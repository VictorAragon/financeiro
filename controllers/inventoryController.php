<?php 
class inventoryController extends controller {

    public function __construct() {
        parent::__construct();

        $u = new Users();
        if($u->isLogged() == false) {
            header("Location: ".BASE_URL."/login");
        }
    }

    public function index() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());

        $data["companyName"] = $company->getName();
        $data["userEmail"] = $u->getEmail();

        if($u->hasPermission('inventory_view')) {
            $i = new InventoryModel();
            $offset = 0;

            $data['inventory_list'] = $i->getList($offset, $u->getCompany());

            $data['add_permission'] = $u->hasPermission('inventory_add');
            $data['edit_permission'] = $u->hasPermission('inventory_edit');
        
            $this->loadTemplate('inventory', $data);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function add() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());

        $data["companyName"] = $company->getName();
        $data["userEmail"] = $u->getEmail();

        if($u->hasPermission('inventory_add')) {
            if(isset($_POST['name']) && !empty($_POST['name'])) {
                $i = new InventoryModel();

                $name = addslashes($_POST['name']);
                $price = addslashes($_POST['price']);
                $quant = addslashes($_POST['quant']);
                $minQuant = addslashes($_POST['minQuant']);

                $price = str_replace(',','.',$price);

                $i->add($name, $price, $quant, $minQuant, $u->getCompany(), $u->getId());

                header("Location: ".BASE_URL."/inventory");
            }
            
            $this->loadTemplate('inventory_add', $data);
        }
    }

    public function edit($id) {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());

        $data["companyName"] = $company->getName();
        $data["userEmail"] = $u->getEmail();

        if($u->hasPermission('inventory_edit')) {
            $i = new InventoryModel();

            if(isset($_POST['name']) && !empty($_POST['name'])) {
                $name = addslashes($_POST['name']);
                $price = addslashes($_POST['price']);
                $quant = addslashes($_POST['quant']);
                $minQuant = addslashes($_POST['minQuant']);

                $price = str_replace('.','',$price);
                $price = str_replace(',','.',$price);

                $i->edit($id, $name, $price, $quant, $minQuant, $u->getCompany(), $u->getId());

                header("Location: ".BASE_URL."/inventory");
            }

            $data['inventory_info'] = $i->getInfo($id, $u->getCompany());
            
            $this->loadTemplate('inventory_edit', $data);
        }
    }

    public function delete($id) {
        $u = new Users();
        $u->setLoggedUser();

        if($u->hasPermission('inventory_edit')) {
            $i = new InventoryModel();
            $i->delete($id, $u->getCompany(), $u->getId());
            header("Location: ".BASE_URL."/inventory");
        }
    }
}