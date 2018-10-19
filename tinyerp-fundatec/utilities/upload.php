<?php


function crearJPG($filePath){
	if(!file_exists($filePath)){
		return 0;
	}
	try{
	$nuevo = str_replace("png", "jpg", $filePath);
	$image = imagecreatefrompng($filePath);
	$bg = imagecreatetruecolor(imagesx($image), imagesy($image));
	imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
	imagealphablending($bg, TRUE);
	imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
	imagedestroy($image);
	$quality = 100; // 0 = worst / smaller file, 100 = better / bigger file 
	imagejpeg($bg, $nuevo, $quality);
	imagedestroy($bg);
	return true;
	}catch(Exception $ex){
		return $ex->getMessage();
	}
}


$img = $_FILES["upload"];

$tmp = $img["tmp_name"];

//obtener la extension de la imagen
$EXT = pathinfo($img["name"], PATHINFO_EXTENSION);

$nombre = date('YmdHi') . '-' . str_replace(" ", "", $img["name"]);

$message = "no se pudo subir la imagen";

$url = "";

$destino = "../documentRepository/img_ckeditor/$nombre";

$URL = "http://" . filter_input(INPUT_SERVER, 'SERVER_NAME');

$path = explode("utilities", filter_input(INPUT_SERVER, 'PHP_SELF'));

$URL .= $path[0] . "documentRepository/img_ckeditor/";

if (move_uploaded_file($tmp, $destino)) {
	
	if($EXT == "png"){
		crearJPG($destino);
		$nombre = str_replace("png", "jpg", $nombre);
	}
	
    $message = "Imagen subida correctamente";
    $URL .= $nombre;
}

$funcNum = $_GET['CKEditorFuncNum'];
echo "<script type = 'text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$URL', '$message');</script>";
