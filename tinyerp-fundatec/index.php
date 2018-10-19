<?php
require_once 'config.php';
Sesion::open();
header('Location:' . DIR_MODULOS . '/login/');