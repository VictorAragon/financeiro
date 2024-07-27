<?php
class loginController extends controller {

    public function index() {
        $data = array();

        if(isset($_POST["email"]) && !empty($_POST["email"])) {
            $email = addslashes($_POST["email"]);
            $password = addslashes($_POST["password"]);

            $u = new Users();

            if($u->doLogin($email, $password)) {
                header("Location: ".BASE_URL);
                exit();
            } else {
                $data["error"] = "Email e/ou Senha Errados.";
            }
        } else {
            $data["error"] = "Preencha os campos para logar.";
        }

        $this->loadView('login', $data);
    }

    public function logout(){
        $u = new Users();
        $u->logout();
        header("Location: ".BASE_URL);
      
    }

}