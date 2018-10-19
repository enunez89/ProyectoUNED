<?php


require __DIR__ . '/../vendor/autoload.php';

$dropboxKey ='g5dohnkbxxwxiib';
$dropboxSecret='7ocevhbp3prpe3q';
$appName='JorgeArt_DApp_2/1.0';

$appInfo = new Dropbox\AppInfo($dropboxKey, $dropboxSecret);

//store csrf token
$csfrTockenStore = new Dropbox\ArrayEntryStore($_SESSION, 'dropbox-auth-csrf-token');

//define auth details
$webAuth = new Dropbox\WebAuth($appInfo, $appName, 'http://localhost/Dropbox_2/dropbox_finish.php', $csfrTockenStore);


