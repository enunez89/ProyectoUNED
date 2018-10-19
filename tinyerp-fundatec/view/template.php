
<!DOCTYPE html>
<html lang="es">
    <head>
        <title><?php echo $this->title; ?></title>
        <meta charset="UTF-8">
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../../css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="../../css/default.css">
        <link rel="stylesheet" href="../../css/general.css">
        <link rel="stylesheet" href="../../css/select2.min.css">
        <link rel="stylesheet" href="../../css/datepicker.css">
        <link rel="stylesheet" href="../../css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="../../css/dataTables.bootstrap.css">
        <link rel="stylesheet" href="../../css/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="../../css/default2.css">
        <link rel="stylesheet" href="../../css/jquery-ui.min.css">
        <link rel="stylesheet" href="../../lib/alertifyjs/css/alertify.min.css">
        <link rel="stylesheet" href="../../lib/alertifyjs/css/myalertify.css">
        <script src="../../js/jquery.min.js" type="text/javascript"></script>
        <script src="../../js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../../js/moment.js" type="text/javascript"></script>
        <script src="../../js/bootstrap-datetimepicker.js" type="text/javascript"></script>
        <script type="text/javascript" src="../../js/jquery.dataTables.min.js"></script>
        <script src="../../js/select2.min.js" type="text/javascript"></script>
        <script src="../../js/MensajeError.js" type="text/javascript"></script>
        <script src="../../js/Message.js" type="text/javascript"></script>
        <script src="../../js/general.js" type="text/javascript"></script>
        <script src="../../js/defaultMenu.js" type="text/javascript"></script>
        <script src="../../lib/alertifyjs/js/alertify.min.js" type="text/javascript"></script>
        <script src="../../lib/alertifyjs/js/myalertify.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="content">

            <!-- Modal -->
            <?php
            require_once '../sesiones/viewAgregarSesion.php';
            ?>
            <!-- END MODAL -->

            <div class="content-header">
                <div class="container-fluid">		
                    <header class="header">
                        <div class="row">
                            <div class="col-md-3">
                                <img class="img-menu-top" src="../../img/list-menu.png" alt="" onclick="clicMenu()">
                                <img class="logo" src="../../img/logo.png" alt="" onclick="location.href = '../index/'">
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-8 col-xs-8">
                                        <div class="form-inline">
                                            <input id="text-search" class="form-control" type="text" placeholder="Buscar..." onkeypress="buscarGlobal(event);">
                                            <a href="../sesiones/?activar=true" class="btn btn-default" id="btn-new-session">Nueva sesión +</a>
                                            <!--
                                            <input id="btn-new-session" type="button" value="Nueva sesión +" class="btn btn-default" data-toggle="modal" data-target="#modalNewSession">
                                            -->
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xs-4 pull-right">

                                        <div class="headerintem">
                                            <div class="dropdown">
                                                <span data-toggle="dropdown" aria-expanded="true" class="lbusername pointer">
                                                    <?php echo Sesion::getAttr("username"); ?>
                                                </span>
                                                <img data-toggle="dropdown" aria-expanded="true" class="img40 pointer" src="<?php echo Sesion::getAttr("imageProfile"); ?>" onError="this.src='../../img/user.png'" alt="">           

                                                <ul id="menuuser" class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                                    <li class="dropdown-header">
                                                        <div class="infouser">
                                                            <img src="<?php echo Sesion::getAttr("imageProfile"); ?>" onError="this.src='../../img/user(100).png'">

                                                            <p><?php echo Sesion::getAttr("username"); ?></p>	
                                                        </div>
                                                    </li>
                                                    <li> <a href="#">Mi cuenta</a></li>
                                                    <li role="separator" class="divider"></li>

                                                    <li ><a href="../sesion/">Cerrar sesión</a></li>

                                                </ul>
                                            </div>	  						
                                        </div> 					
                                    </div>

                                </div>
                            </div>

                    </header>
                </div>
            </div>

            <div class="content-main">


                <div class="container-fluid">
                    <main class="main">
                        <div class="row">
                            <div id="content-rigth" class="col-sm-2">
                                <div class="sidebar-nav">
                                    <div class="navbar navbar-default" role="navigation">
                                        <div class="navbar-header">
                                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
                                                <span class="sr-only">Toggle navigation</span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                            </button>
                                            <img class="logoBlue" src="../../img/LogoFUNDATEC.png" alt="">
                                        </div>
                                        <div class="navbar-collapse collapse sidebar-navbar-collapse">
                                            <ul class="nav navbar-nav">
                                                <li class="active team">  <a href="../sesiones/"><img src="../../img/team.png" alt=""> Sesiones</a></li>
                                                <li><a href="../actas"><img src="../../img/archive.png" alt="">Libro de Actas</a></li>
                                                <li><a href="../acuerdo/index.php?action=listaAcuerdo"><img src="../../img/employment-deal.png" alt="">Acuerdos</a></li>

                                                <?php if (Rol::rolAdministrador() || Rol::rolSecreatria()) : ?>

                                                    <li>
                                                        <a href="javascript:verSubMenu('mconfig');"><img src="../../img/settings.png" alt="">Configuración</a>
                                                        <ul class="nav navbar-nav" id="mconfig" style="display:none;">
                                                            <li>
                                                                <a href="../juntadirectiva/">
                                                                    <span class="fa fa-user"></span> JuntaDirectiva
                                                                </a>
                                                            </li>                                                            
                                                            <li>
                                                                <a href="../persona/">
                                                                    <span class="fa fa-user"></span> Personas
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="../lugares/">
                                                                    <span class="fa fa-building"></span> Lugares
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>

                                                <?php endif; ?>
                                                <li class="active team">  <a href="../ayuda/"><img src="../../img/support.png" alt=""> Ayuda</a></li>
                                            </ul>
                                        </div><!--/.nav-collapse -->
                                    </div>
                                </div>
                                <!--
                                <div>
                                    <h4>Cosas por hacer</h4>
                                    <input class="form-control" type="text" placeholder="Añadir tarea">
                                    <ul>
                                        <li>Lorem ipsum dolor sit amet.</li>
                                        <li>Impedit facilis incidunt itaque, debitis.</li>
                                        <li>Officiis ipsum cupiditate cum fugiat.</li>		
                                    </ul>
                                </div>
                                -->
                            </div>
                            <div id="content-main" class="col-sm-10">
                                <div class="main-content">
                                    <?php
                                    $alertaGlobal = Message::getMsjSesion();
                                    ?>
                                    <?php if ($alertaGlobal["type"] <> NULL): ?>
                                        <div class="alert <?php echo $alertaGlobal["type"]; ?> alert-dismissible fade in" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <?php echo $alertaGlobal["msj"]; ?>
                                        </div>

                                        <script type="text/javascript">
                                            $(".alert").delay(4000).slideUp(100, function () {
                                                $(this).alert('close');
                                            });
                                        </script>

                                    <?php endif; ?>
                                    <?php require_once $this->include; ?>
                                </div>
                            </div>
                        </div>

                    </main>
                    <footer>		
                    </footer>
                </div>
            </div>
        </div>
    </body>
</html>
