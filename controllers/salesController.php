<?php 
class salesController extends controller {

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

        $data["statusName"] = array(
            '0'=>'Aguardando Pgto.',
            '1'=>'Pago',
            '2'=>'Vencido',
        );

        if($u->hasPermission('sales_view')) {
            $s = new SalesModel();
            $offset = 0;

            $data['sales_list'] = $s->getList($offset, $u->getCompany());

            $this->loadTemplate('sales', $data);
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

        if($u->hasPermission('sales_view')) {
            $s = new SalesModel();

            if (isset($_POST['client_id']) && !empty($_POST['client_id'])) {
                $client_id = addslashes($_POST['client_id']);
                $status = addslashes($_POST['status']);
                $total_price = addslashes($_POST['total_price']);

                $total_price = str_replace('.','',$total_price);
                $total_price = str_replace(',','.',$total_price);

                $s->addSale($u->getCompany(), $client_id, $u->getId(), $total_price, $status);
                header("Location: ".BASE_URL."/sales");
                
            }

            $this->loadTemplate('sales_add', $data);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function edit($id) {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());

        $data["companyName"] = $company->getName();
        $data["userEmail"] = $u->getEmail();

        if($u->hasPermission('users_view')) {
            $p = new Permissions();

            if (isset($_POST['group']) && !empty($_POST['group'])) {
                $pass = addslashes($_POST['password']);
                $group = addslashes($_POST['group']);

                $a = $u->edit($pass, $group, $id, $u->getCompany());

                header("Location: ".BASE_URL."/users");
            }

            $data['user_info'] = $u->getInfo($id, $u->getCompany());
            $data['group_list'] = $p->getGroupList($u->getCompany());

            $this->loadTemplate('users_edit', $data);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function delete($id) {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());

        $data["companyName"] = $company->getName();
        $data["userEmail"] = $u->getEmail();

        if($u->hasPermission('users_view')) {
            $p = new Permissions();

            $u->delete($id, $u->getCompany());
            header("Location: ".BASE_URL."/users");
        }
    }
}