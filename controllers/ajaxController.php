<?php 
class ajaxController extends controller {

    public function __construct() {
        parent::__construct();

        $u = new Users();
        if($u->isLogged() == false) {
            header("Location: ".BASE_URL."/login");
        }
    }

    public function index() {}

    public function search_clients() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $c = new ClientsModel();

        if(isset($_GET['a']) && !empty($_GET['a'])) {
            $a = addslashes($_GET['a']);

            $clients = $c->searchClientByName($a, $u->getCompany());

            foreach($clients AS $v) {
                $data[] = array(
                    'name'  => $v['name'],
                    'link'  => BASE_URL.'/clients/edit/'.$v['id'],
                    'id'    => $v['id'],
                    'email' => $v['email']
                );
            }
            
        }

        echo json_encode($data);
    }

    public function search_products() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $i = new InventoryModel();

        if(isset($_GET['a']) && !empty($_GET['a'])) {
            $a = addslashes($_GET['a']);
            $data = $i->searchProductsByName($a, $u->getCompany());
        }

        echo json_encode($data);
    }

    public function add_client() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $c = new ClientsModel();

        if(isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['email']) && !empty($_POST['email'])) {
            $name = addslashes($_POST['name']);
            $email = $_POST['email'];

            $data['id'] = $c->add($u->getCompany(), $name, $email);
            
        }

        echo json_encode($data);
    }
}