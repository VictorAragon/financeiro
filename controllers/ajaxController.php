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

        if(isset($_GET['q']) && !empty($_GET['q'])) {
            $q = addslashes($_GET['q']);

            $data = $c->searchClientByName($q, $u->getCompany());
            
        }

        echo json_encode($data);
    }
}