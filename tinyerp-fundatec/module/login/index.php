<?php

require_once '../../config.php';

requireController("CLogin.php");

$clogin = new  CLogin();
$clogin->procesar();
