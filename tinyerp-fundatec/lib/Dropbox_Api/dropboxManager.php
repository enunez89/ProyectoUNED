<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dropboxManager
 *
 * @author FUNDATEC - ITCR
 */
class dropboxManager {
    public $client;
    
    function __construct() {
        $this->client = new Dropbox\Client('CkHZJYe9QBgAAAAAAADN5Z57aLeoqCdfavphLksKEGnySPy3NDvmIEfpTmt4f8i-', $appName, 'UTF-8');
    }
    
    public function Upload($filePath, $fileName){
        $file = fopen($filePath, "rb");
        $this->client->uploadFile("/Documentación_Sistemas_FUNDATEC/".$fileName, Dropbox\WriteMode::add(), $file);
        fclose($file);
    }

}
