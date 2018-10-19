<?php

/**
 * Description of dropbox
 *
 * @author Jorge Castillo Vindas <jcastillo@itcr.ac.cr>
 */

require '../../../content/Dropbox_Api/app/start.php';

class dropbox {
    public $client;

    function __construct() {
        $this->client = new Dropbox\Client(TOKEN_DROPBOXINVESMENT, APP_NAME_DROPBOXINVESMENT, 'UTF-8');
    }

    public function uploadInvestment($filename, $filePath) {
        $file = fopen($filePath, "rb");
        $this->client->uploadFile(DOCS_PATH_INVESTMENT_CERTIFICATES.date("Y")."/".$filename, Dropbox\WriteMode::add(), $file);
        fclose($file);
        
        return $this->client->createShareableLink(DOCS_PATH_INVESTMENT_CERTIFICATES.date("Y")."/".$filename);
    }
}
