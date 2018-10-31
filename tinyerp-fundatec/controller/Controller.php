<?php

class Controller extends View {

    const CAPA_MODEL = 'model';
    const CAPA_MODELINVESMENT = 'model/inversiones';
    const CAPA_CONTROLLER = 'controller';
    const CAPA_ENTITY = 'entity';
    const ACTION = 'action';
    const CAPA_MODELPOINTOFSALE = 'model/pointOfSale';
    const CAPA_MODELCONTRACT = 'model/contract';
    const CAPA_MODELASSETS = 'model/assets';
    const  CAPA_ENTITYASSETS = 'entity/assets';

    protected $pageTitle = 'Sistemas FUNDATEC';

    function __construct($MODULE) {
        $this->MODULE = $MODULE;
    }

    protected function getAction() {
        return Request::getAttr(self::ACTION);
    }

    /**
     * Funcion para redireccionar el sitio de un lugar a otro
     * @param string $URL
     */
    public function redirect($URL) {
        //header("Location:" . $URL);
        echo "<script>location.href='$URL'</script>";
    }

    /**
     * Redirecciona a otro módulo del sistema
     * @param type $MODULO
     */
    protected function redirectModule($MODULO) {
        $URL = ".." . SD . $MODULO . SD;
        $this->redirect($URL);
    }
    
        /**
     * Redirecciona a otro módulo del sistema
     * @param type $MODULO
     */
    protected function redirectView($MODULO) {
        $URL = ".." . SD .".." . SD . $MODULO . SD;
        $this->redirect($URL);
    }

    /**
     * Verifica si la sesión esta o no activa,
     * en caso de que no este activa envía al usuario a login
     */
    protected function verificarSesionActiva() {
        Sesion::deleteAttr(Message::MSJ_WARNING);
        $BASENAME = basename(Server::URI()) == MODULO_LOGIN;
        $ACTIVE = Sesion::active();
        if (!$ACTIVE && $BASENAME <> MODULO_LOGIN) {
            Message::msjWarning("Sesión inactiva. Su sesión ha expirado o no se inició correctamente, por favor inicie sesión nuevamente");
            $this->redirectModule(MODULO_LOGIN);
        }
        if ($ACTIVE && $BASENAME == MODULO_LOGIN) {
            echo "Usuario activo, redireccionando...";
            $this->redirectModule(MODULO_INICIAL);
        }
    }
    
        /**
     * Verifica si la sesión esta o no activa para los modulos,
     * en caso de que no este activa envía al usuario a login
     */
    protected function verifyActiveSession() {
        Sesion::deleteAttr(Message::MSJ_WARNING);
        $BASENAME = basename(Server::URI()) == MODULO_LOGIN;
        $ACTIVE = Sesion::active();
        if (!$ACTIVE && $BASENAME <> MODULO_LOGIN) {
            Message::msjWarning("Sesión inactiva. Su sesión ha expirado o no se inició correctamente, por favor inicie sesión nuevamente");
            $this->redirectView(MODULO_LOGIN);
        }
        if ($ACTIVE && $BASENAME == MODULO_LOGIN) {
            echo "Usuario activo, redireccionando...";
            $this->redirectView(MODULO_INICIAL);
        }
    }

    /**
     * Función para leer la vista
     * @param string $phpView
     */
    protected function view($phpView, $MODULE = 'self') {
        if ($MODULE <> 'self') {
            $this->MODULE = $MODULE;
        }
        $this->load($phpView, $this->pageTitle);
    }

        /**
     * Función para leer la vista
     * @param string $phpView
     */
    protected function runView($phpView, $MODULE = 'self') {
        if ($MODULE <> 'self') {
            $this->MODULE = $MODULE;
        }
        $this->loadup($phpView, $this->pageTitle);
    }
    /**
     * Función para incluír una clase entity 
     * @param string $phpEntity
     * @param string $MODULO (opcional, en caso de llamar a una clase de otro
     * modulo)
     */
    protected function entity($phpEntity) {
        $this->import(self::CAPA_ENTITY, $phpEntity);
    }

    /**
     * Función para incluír una clase de model 
     * @param string $phpModel
     * @param string $MODULO (opcional, en caso de llamar a una clase de otro
     * modulo)
     */
    protected function model($phpModel) {
        $this->import(self::CAPA_MODEL, $phpModel);
    }

        /**
     * Función para incluír una clase de model 
     * @param string $phpModel
     * @param string $MODULO (opcional, en caso de llamar a una clase de otro
     * modulo)
     */
    protected function loadModel($phpModel) {
        $this->importFile(self::CAPA_MODELINVESMENT, $phpModel);
    }
    
    protected function loadModelLyout($phpModel) {
        $this->importFile("model", $phpModel);
    }
    
    protected function loadModelPointOfSale($phpModel) {
        $this->importFile(self::CAPA_MODELPOINTOFSALE, $phpModel);
    }
    
    protected function loadModelContract($phpModel) {
        $this->importFile(self::CAPA_MODELCONTRACT, $phpModel);
    }
    
     protected function loadModelAssets($phpModel) {
        $this->importFile(self::CAPA_MODELASSETS, $phpModel);
    }
    
    /**
     * Importa la entidad activos
     * @param type $phpModel
     */
    protected function loadEntityAssets($entity) {
        $this->importFile(self::CAPA_ENTITYASSETS, $entity);
    }
    
    /**
     * Funcion para importar archivos desde un controlador
     * @param type $CAPA
     * @param type $phpFile
     */
    private function import($CAPA, $phpFile) {
        $PATH = ".." . SD . ".." . SD . $CAPA . SD . $this->getPHPFile($phpFile);
        require_once $PATH;
    }

        /**
     * Funcion para importar archivos desde un controlador
     * @param type $CAPA
     * @param type $phpFile
     */
    private function importFile($CAPA, $phpFile) {
        $PATH = ".." . SD .".." . SD . ".." . SD . $CAPA . SD . $this->getPHPFile($phpFile);
        require_once $PATH;
    }
}
