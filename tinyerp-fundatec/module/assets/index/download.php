<?php

if (!empty($_GET['file'])) {
    // Security, down allow to pass ANY PATH in your server
    $fileName = basename($_GET['file']);
    $typeFile = S_GET['type'];
} else {    
    echo '';
}

$filePath = 'uploadFiles/' . $fileName;
if (!file_exists($filePath)) {
    echo '';
}

header("Content-disposition: attachment; filename=" . $fileName);
header("Content-type: ". $typeFile);
readfile($filePath);
