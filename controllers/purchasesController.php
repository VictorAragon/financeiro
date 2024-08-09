<?php 
class purchasesController extends controller {

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

        // $data["statusName"] = array(
        //     '0'=>'Aguardando Pgto.',
        //     '1'=>'Pago',
        //     '2'=>'Vencido',
        // );

        if($u->hasPermission('purchases_view')) {
            $p = new PurchasesModel();
            $offset = 0;

            $data['purchases_list'] = $p->getList($offset, $u->getCompany());

            $this->loadTemplate('purchases', $data);
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
                $quant = $_POST['quant'];
                
                $total_price = addslashes($_POST['total_price']);
                $total_price = str_replace('.','',$total_price);
                $total_price = str_replace(',','.',$total_price);

                $s->addSale($u->getCompany(), $client_id, $u->getId(), $quant, $status);
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

        $data["statusName"] = array(
            '0'=>'Aguardando Pgto.',
            '1'=>'Pago',
            '2'=>'Vencido',
        );

        if($u->hasPermission('sales_view')) {
            $s = new SalesModel();

            $data['permission_edit'] = $u->hasPermission('sales_edit');

            if (isset($_POST['statusVenda']) && $data['permission_edit']) {
                $status = addslashes($_POST['statusVenda']);

                $s->changeStatus($status, $id, $u->getCompany());

                header("Location: ".BASE_URL."/sales");
            }

            $data['sales_info'] = $s->getInfo($id, $u->getCompany());

            $this->loadTemplate('sales_edit', $data);
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