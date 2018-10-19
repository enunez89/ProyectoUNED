<?php

/**
 * Description of View
 *
 * @author Armando Joaquin C <armand17.10@gmail.com>
 */
class View {

    private $pageTitle;
    private $JS = array();
    private $CSS = array();
    private $phpView = '';

    const CAPA_VIEW = 'view';
    const VIEW_DEFAULT = 1;
    const VIEW_OTRA = 2;

    protected $MODULE = '';
    protected $setView;
    
    private function cargarVista() {
        switch ($this->setView) {
            case self::VIEW_OTRA:
                //otra vista
                $this->loginView();
                break;
            default:
                $this->defaultView();
                break;
        }
    }

        private function correrVista() {
        switch ($this->setView) {
            case self::VIEW_OTRA:
                //otra vista
                $this->loginView();
                break;
            default:
                $this->loadView();
                break;
        }
    }
    /**
     * Contrucción de la estructura HTML
     * con la vista por defecto para las páginas
     */
    private function defaultView() {
        $this->include = '..' . SD . '..' . SD . 'module' . SD . $this->MODULE . SD . $this->getPHPFile($this->phpView);
        $this->title = $this->pageTitle;
        require_once 'layout.php';
    }

    private function loadView() {
        $this->include = '..' . SD .'..' . SD . '..' . SD . 'module' . SD . $this->MODULE . SD . $this->getPHPFile($this->phpView);
        $this->title = $this->pageTitle;
        require_once 'layoutInvestment.php';
    }
    
    private function loginView() {
        $this->include = '..' . SD . '..' . SD . 'module' . SD . $this->MODULE . SD . $this->getPHPFile($this->phpView);
        $this->title = $this->pageTitle;
        require_once 'login.php';
    }
    
    public function importCSS($CSSFile) {
        $path = '../../css/' . $CSSFile;
        if (file_exists($path)) {
            return '<link rel="stylesheet" type="text/css" href="' . $path . '">';
        }
    }

    public function importJS($JSFile) {
        $path = '../../../js/' . $JSFile;
        if (file_exists($path)) {
            return '<script type="text/javascript" src="' . $path . '"></script>';
        }
    }

    protected function includeJS($JSFile) {
        array_push($this->JS, $JSFile);
    }

    protected function includeCSS($CSSFile) {
        array_push($this->CSS, $CSSFile);
    }

    protected function load($phpView, $pageTitle = 'Actas FUNDATEC') {
        $this->phpView = $phpView;
        $this->pageTitle = $pageTitle;
        $this->cargarVista();
    }

    protected function loadup($phpView, $pageTitle = 'Actas FUNDATEC') {
        $this->phpView = $phpView;
        $this->pageTitle = $pageTitle;
        $this->correrVista();
    }
    
    private function println($HTMLLine) {
        echo $HTMLLine . "\n";
    }

    /**
     * Funcion para agregar la extensión .php en la ruta de inclusión (
     * en caso de que no se le ponga)
     * @param string $filename
     * @return string
     */
    protected function getPHPFile($filename) {
        if (strpos($filename, '.php') === FALSE) {
            $filename .= '.php';
        }
        return $filename;
    }

}
