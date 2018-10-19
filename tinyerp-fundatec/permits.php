<?php
	require_once '../../../general/database.php';

	$username = json_decode(file_get_contents('php://input'));

	$conn = Database::connect();
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = "call selectPermitsOfProfile(?)";
	$q = $conn->prepare($sql);
	$q->execute(array($username->user));
	
	$fetchPermits = $q->fetch(PDO::FETCH_OBJ);
	
	$data = '['. $fetchPermits->permitHome .','
			   . $fetchPermits->permitAdmin .',' 
			   . $fetchPermits->permitUserConf .', '
			   . $fetchPermits->permitUserPermits .', '
			   . $fetchPermits->permitAddAsset .', '
			   . $fetchPermits->permitLoan .', '
			   . $fetchPermits->permitMove .']';

	echo "-";
	echo $data;

	Database::disconnect();
?>
