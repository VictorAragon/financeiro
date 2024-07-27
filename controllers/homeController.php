<?php
class homeController extends controller {

	private $user;

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

        $this->loadTemplate('home', $data);
    }

}