<?php 
class clientsController extends controller {

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

        if($u->hasPermission('clients_view')) {
            $c = new ClientsModel();
            $offset = 0;
            $data['p'] = 1;
            if(isset($_GET['p']) && !empty($_GET['p'])) {
                $data['p'] = intval($_GET['p']);
                if($data['p'] == 0) {
                    $data['p'] = 1;
                }
            }
            $offset = ( 10 * ($data['p'] - 1) );

            $data['clients_list'] = $c->getList($offset, $u->getCompany());
            $data['clients_count'] = $c->getCount($u->getCompany());
            $data['p_count'] = ceil($data['clients_count'] / 10);
            $data['edit_permission'] = $u->hasPermission('clients_edit');

            $this->loadTemplate('clients', $data);
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

        if($u->hasPermission('clients_edit')) {
            $c = new ClientsModel();

            if(isset($_POST['name']) && !empty($_POST['name'])) {
                $name = addslashes($_POST["name"]);
                $email = addslashes($_POST["email"]);
                $phone = addslashes($_POST["phone"]);
                $stars = addslashes($_POST["stars"]);
                $internal_obs = addslashes($_POST["internal_obs"]);
                $addressZipcode = addslashes($_POST["addressZipcode"]);
                $address = addslashes($_POST["address"]);
                $addressNumber = addslashes($_POST["addressNumber"]);
                $addressComplement = addslashes($_POST["addressComplement"]);
                $addressNeighborhood = addslashes($_POST["addressNeighborhood"]);
                $addressCity = addslashes($_POST["addressCity"]);
                $addressState = addslashes($_POST["addressState"]);

                $c->add($u->getCompany(), $name, $email, $phone, $stars, $internal_obs, $addressZipcode, $address, $addressNumber, $addressComplement, $addressNeighborhood, $addressCity, $addressState);
                header("Location: ".BASE_URL."/clientes");
            }          

            $this->loadTemplate('clients_add', $data);
        } else {
            header("Location: ".BASE_URL."/clients");
        }
    }

    public function edit($id) {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());

        $data["companyName"] = $company->getName();
        $data["userEmail"] = $u->getEmail();

        if($u->hasPermission('clients_edit')) {
            $c = new ClientsModel();

            if(isset($_POST['name']) && !empty($_POST['name'])) {
                $name = addslashes($_POST["name"]);
                $email = addslashes($_POST["email"]);
                $phone = addslashes($_POST["phone"]);
                $stars = addslashes($_POST["stars"]);
                $internal_obs = addslashes($_POST["internal_obs"]);
                $addressZipcode = addslashes($_POST["addressZipcode"]);
                $address = addslashes($_POST["address"]);
                $addressNumber = addslashes($_POST["addressNumber"]);
                $addressComplement = addslashes($_POST["addressComplement"]);
                $addressNeighborhood = addslashes($_POST["addressNeighborhood"]);
                $addressCity = addslashes($_POST["addressCity"]);
                $addressState = addslashes($_POST["addressState"]);

                $c->edit($id, $u->getCompany(), $name, $email, $phone, $stars, $internal_obs, $addressZipcode, $address, $addressNumber, $addressComplement, $addressNeighborhood, $addressCity, $addressState);
                header("Location: ".BASE_URL."/clients");
            }
            
            $data['client_info'] = $c->getInfo($id, $u->getCompany());

            $this->loadTemplate('clients_edit', $data);
        } else {
            header("Location: ".BASE_URL."/clients");
        }
    }

    public function delete($id) {
        echo "Ação pendente.";
    }
}