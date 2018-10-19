<?php

require_once '../../config.php';

requireController("CSesion.php");

$csesion = new CSesion();
$csesion->cerrarSesion();