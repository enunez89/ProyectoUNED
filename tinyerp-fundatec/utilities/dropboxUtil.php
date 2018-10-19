<?php

/**
 * Description of dropboxUtil
 *
 * @author FUNDATEC - ITCR
 */


class dropboxUtil {

    public $client;

    function __construct() {
        $this->client = new Dropbox\Client(TOKEN_DROPBOX, APP_NAME_DROPBOX, 'UTF-8');
    }

    public function uploadActas($filename, $filePath,$year) {
        $file = fopen('../../'.$filePath.$filename, "rb");
        $this->client->uploadFile(DOCS_PATH_ACTAS.$year."/".$filename, Dropbox\WriteMode::force(), $file);
        fclose($file);
        
        return $this->client->createShareableLink(DOCS_PATH_ACTAS.$year."/".$filename);
    }
    
    

}
