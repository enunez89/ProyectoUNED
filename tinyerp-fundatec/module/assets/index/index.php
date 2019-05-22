<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../../../config.php';
require_once '../../../controller/Assets/AssetsController.php';
require_once '../../../entity/assets/Asset.php';
require_once '../../../entity/assets/Repair.php';
require_once '../../../entity/assets/Quotation.php';
require_once '../../../entity/assets/Period.php';
require_once '../../../entity/assets/Assignment.php';

$assetsController = new AssetsController();
$assetsController->procesar();