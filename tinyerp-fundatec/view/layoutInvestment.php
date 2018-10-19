<!DOCTYPE html>
<html lang="es">
    
    <head>
        <?php
        require_once '../../../controller/LayoutController.php';
        ?>
        <title><?php echo $this->title; ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../../../css/bootstrap/bootstrap.min.css">
        <link href="../../../css/css.css" rel="stylesheet" type="text/css"/>       
        <link rel="stylesheet" href="../../../css/general.css">
        <link rel="stylesheet" href="../../../css/select2.min.css">
        <link rel="stylesheet" href="../../../css/datepicker.css">
        <link rel="stylesheet" href="../../../css/bootstrap-datetimepicker.min.css">
         <link rel="stylesheet" href="../../../lib/DataTables/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="../../../css/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="../../../css/default2.css">
        <link rel="stylesheet" href="../../../css/jquery-ui.min.css">
        <link rel="stylesheet" href="../../../lib/alertifyjs/css/alertify.min.css">
        <link rel="stylesheet" href="../../../lib/alertifyjs/css/myalertify.css">
        <link href="../../../css/defaultInvestment.css" rel="stylesheet" type="text/css"/>
        
        <script src="../../../js/jquery.min.js" type="text/javascript"></script>
        <script src="../../../js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="../../../js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../../../js/moment.js" type="text/javascript"></script>
        <script src="../../../js/jquery.dataTables.min.js"></script>
        <script src="../../../js/select2.min.js" type="text/javascript"></script>
        <script src="../../../js/MensajeError.js" type="text/javascript"></script>
        <script src="../../../js/Message.js" type="text/javascript"></script>
        <script src="../../../js/inversiones/general.js" type="text/javascript"></script>
        <script src="../../../js/defaultMenu.js" type="text/javascript"></script>        
        
        <script src="../../../lib/Datepicker/bootstrap-datetimepicker.js" type="text/javascript"></script>        
        <script src="../../../lib/Datepicker/daterangepicker.js" type="text/javascript"></script>
        <link href="../../../lib/Datepicker/datepicker3.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../../lib/Datepicker/daterangepicker.css" rel="stylesheet" type="text/css"/>
        <link href="../../../lib/Datepicker/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>
        
        <script src="../../../lib/alertifyjs/js/alertify.min.js" type="text/javascript"></script>
        <script src="../../../lib/alertifyjs/js/myalertify.js" type="text/javascript"></script>
        <script src="../../../js/index.js" type="text/javascript"></script>
        <script src="../../../lib/Numeral/numeral.min.js" type="text/javascript"></script>
        
        <script src="../../../lib/DataTables/jquery.dataTables.min.js"></script>
        <script src="../../../lib/DataTables/dataTables.bootstrap.min.js"></script>
        <script src="../../../config.js"></script>
    </head>
        <style>
            .img40{
                width: 32px;
                height:32px;
                border-radius: 100px;
                background: #FFF none repeat scroll 0% 0%;
            }
        </style>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="content-left col-xs-6 col-md-2 col-sm-2">
                    <div class="content-logo">
                        <img class="logo" src="../../../img/logo.png" alt="" onclick="location.href = '../../index/'">
                    </div>
                    <div class="content-menu">
                        <ul>
                            <?php
                            $temporal = 0;  
                            $layout= new LayoutController();                 
                            $layout->init();
                            
                            if($_SESSION['menuModulo']==""){
                                echo 'NO HAY PERMISOS';
                            }else{
                                 foreach ($_SESSION['menuModulo'] as &$valor) {
                                if ($temporal <> $valor[0]) {
                                    $temporal = $valor[0];
                                    ?> 
                                    <li class = "active">
                                        <a href = "javascript:verSubMenu('<?php echo $valor[2] ?> ');"><img src = "../../../<?php echo $valor[5] ?>" alt = ""> <?php echo $valor[3] ?></a>
                                        <ul id="<?php echo $valor[2] ?>" style="display:none;">
                                            <li><a href="../../../module/<?php echo $valor[9] ?>/"><span></span><?php echo $valor[6] ?></a></li>         
                                        </ul>
                                    </li>
                                <?php } else { ?>
                                    <ul id="<?php echo $valor[2] ?>" style="display:none;">
                                        <li><a href="../../../module/<?php echo $valor[9] ?>/"><span></span><?php echo $valor[6] ?></a></li>         
                                    </ul> 
                                <?php } ?>                                
                            <?php }     
                            }
                            ?> 
                                                   
                        </ul>
                    </div>
                    <div class="footer">                        
                        <div class="dropup">
                          
                        </div>                        
                    </div>
                </div>
                <div class="content-right col-xs-12 col-md-10 col-sm-10">
                    <div class="content-header">
                        <div class="row">
                            <div class="col-md-8 col-xs-8">
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <div class="headerintem">
                                    <div class="dropdown">
                                        <span data-toggle="dropdown" aria-expanded="true" class="lbusername pointer">
                                            <?php echo Sesion::getAttr("username"); ?>
                                        </span>
                                        <img data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" src="<?php echo Sesion::getAttr("imageProfile"); ?>" alt="usuario" onerror="this.src='../../../img/user(100).png'" class="img40 pointer">
                                        <ul id="menuuser" class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                            <li class="dropdown-header">
                                                <div class="infouser">
                                                   
                                                    <img src="<?php echo Sesion::getAttr("imageProfile"); ?>" onError="this.src='../../../img/user(100).png'" class="img40 pointer">

                                                    <p><?php echo Sesion::getAttr("username"); ?></p>	
                                                </div>
                                            </li>
                                            <li> <a href="#">Mi cuenta</a></li>
                                            <li role="separator" class="divider"></li>

                                            <li ><a href="../../sesion/">Cerrar sesión</a></li>

                                        </ul>
                                    </div>	  						
                                </div> 					
                            </div>
                        </div>
                    </div>
                    <div class="content-body">
                        <?php require_once $this->include; ?>
                    </div>
                </div>              
            </div>
        </div>       
    </body>
</html>
