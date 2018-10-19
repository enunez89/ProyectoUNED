<?php

require 'app/start.php';
//$client = new Dropbox\Client('qlZWb95FWjwAAAAAAAALZIi80gjyqd9KDhb0TiS2LiLMKL7kTCbJo-AOUveFKI7O', $appName, 'UTF-8');
$client = new Dropbox\Client('CkHZJYe9QBgAAAAAAADN5Z57aLeoqCdfavphLksKEGnySPy3NDvmIEfpTmt4f8i-', 'appName1.0', 'UTF-8');
//var_dump($client->getAccountInfo());


/*GetTemporalLink_download*/
/*$dropboxPath='/Subnetting IPV6.pdf';
$link = $client->createTemporaryDirectLink($dropboxPath);
print_r($link);*/


/*Download into project files*/
//$client->getFile("/wf.png", fopen("Files/wf.png", "wb"));

    
/*Upload File*/
$file = fopen('../../img/testPic.png', "rb");
$client->uploadFile("/Documentación_Sistemas_FUNDATEC/Sistema_Actas/testPic.png", Dropbox\WriteMode::add(), $file);
fclose($file);
echo 'upload complete';


/*Create share link*/
//echo $client->createShareableLink("/Subnetting IPV6.pdf");