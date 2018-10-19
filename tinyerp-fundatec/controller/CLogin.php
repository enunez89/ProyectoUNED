<?php

class CLogin extends Controller {

    function __construct() {
        parent::__construct(MODULO_LOGIN);
        Sesion::open();
        $this->verificarSesionActiva();
    }

    public function procesar() {
        switch ($this->getAction()) {
            default:
                $this->mostrarFrmLogin();
                break;
        }
    }

    private function mostrarFrmLogin() {
        $this->post(); 
        $this->setView = View::VIEW_OTRA;
        $this->view("frmLogin");
    }

    private function post() { 
        $this->resultLogin=false;
        if (Request::getAttr(Sesion::USERNAME) <> NULL) {
            $username = Request::getAttr(Sesion::USERNAME);
            $clave = Request::getAttr("password");
            //importar una clase de model
            $this->model("MLogin");
            $mlogin = new MLogin();           
            if ($mlogin->existeUsuario($username, $clave)) {                
                $this->permitirAcceso($username);                
                $this->resultLogin=false;
            }else{
                $this->resultLogin=true;                
            }
        }
    }

    private function permitirAcceso($username) {
        Sesion::setAttr(Sesion::USERNAME, $username);
        $this->redirectModule(MODULO_INICIAL);
    }
    
//    private function getMenu() {
//        if (Request::getAttr(Sesion::USERNAME) <> NULL) {
//            $username = Request::getAttr(Sesion::USERNAME);
//            $mlogin = new MLogin();
//            $mlogin->getMenu($username);
//        }
//    }

}
