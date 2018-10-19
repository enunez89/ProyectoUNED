<?php

require_once 'lib/examples/tcpdf_include.php';
require_once 'lib/tcpdf.php';

/**
 * Description of PDFCreator
 *
 * @author Armando Joaquin C <armand17.10@gmail.com>
 */
class PDFCreator {

    private $PDF;
    private static $SD = '/';
    private static $FOLDER = "documentRepository";

    function __construct() {
        $this->PDF = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $this->PDF->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $this->PDF->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $this->PDF->SetHeaderMargin(PDF_MARGIN_HEADER);
        $this->PDF->SetFooterMargin(PDF_MARGIN_FOOTER);
        $this->PDF->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $this->PDF->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $this->PDF->setFontSubsetting(true);
        $this->PDF->SetFont('dejavusans', '', 12, '', true);
    }

    public function setCreator($creator) {
        $this->PDF->SetCreator($creator);
    }

    public function setAutor($author) {
        $this->PDF->SetAuthor($author);
    }

    public function setTitle($title) {
        $this->PDF->SetTitle($title);
    }

    public function setSubject($asunto) {
        $this->PDF->SetSubject($asunto);
    }

    public function setKeywords($keywords) {
        $this->PDF->SetKeywords($keywords);
    }

    public function addPage() {
        $this->PDF->AddPage();
    }

    public function addHTML($html) {
        $this->PDF->writeHTML($html, true, false, true, false, '');
    }

    public function mostrarPDF($nombre) {
        $this->PDF->Output($nombre, 'I');
    }

    public function descargarPDF($nombre) {
        $this->PDF->Output($nombre, 'D');
    }

    public function guardarEnDisco($nombre,$anio) {        
        $path = $this->crearCarpetaAnual($anio);      
        $path .= $nombre;
        $this->PDF->Output($path, 'F');
        return $path;
    }

    private function crearCarpetaAnual($anio) {
        $PHP_SELF = explode(self::$SD, filter_input(INPUT_SERVER, 'PHP_SELF'));
        $path = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');
        $path .= self::$SD . $PHP_SELF[1] . self::$SD;
        $path .= self::$FOLDER . self::$SD;
        $year = $anio;        
        $filename = $path . $year . self::$SD;
        if (!file_exists($filename)) {
            if (mkdir($filename)) {
                return $filename;
            }
        } else {
            return $filename;
        }
        return $path;
    }
}
