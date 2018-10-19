
<!-- Author     : Yendry Arrieta -->

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FundaTEC</title>
        <link rel="stylesheet" href="../../css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="../../css/estilos.css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <script src="../../js/index.js" type="text/javascript"></script>
    </head>
    <body>
        <header>
            <div class="nav1">
                <nav class="navbar navbar-default">
                    <div class="container-fluid flex-container">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="#">
                                <img src="../../img/menu/LogoFUNDATEC.png" class="logo">
                            </a>
                            <form class="navbar-form navbar-right">
                                <div class="form-group">

                                    <!--Botón Notificaciones-->

                                    <div class="dropdown">
                                        <button class="dropbtn">
                                            <i  class="glyphicon glyphicon-bell"></i>
                                        </button>
                                        <!--<div id="myDropdown" class="dropdown-content">
                                            <a href="#home">Home</a>
                                            <a href="#about">About</a>
                                            <a href="#contact">Contact</a>
                                        </div>-->
                                    </div>

                                    <!--Botón Aplicaciones-->

                                    <div class="dropdown">
                                        <button class="dropbtn" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="glyphicon glyphicon-th"></i>
                                        </button>

                                        <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuLink">

                                            <ul class="gb_ia" aria-dropeffect="move" >
                                                <?php foreach ($this->applications as $key => $value) { ?>
                                                    <li class="icoLi" aria-grabbed="false" onclick="javascript: redireccionar('<?php echo $value->getApplicationId(); ?>', '<?php echo $value->getURL(); ?>');">
                                                        <a class="cont_menu" href="<?php echo $value->getURL(); ?>">

                                                            <div class="ICONO">
                                                                <i class="material-icons"><?php echo $value->getNameIcon(); ?></i>
                                                            </div>
                                                            <span class="gb_3" <a href="<?php echo $value->getURL(); ?>"><?php echo $value->getApplicationName(); ?></a></span>
                                                        </a>
                                                    </li>
                                                <?php } ?> 
                                                <li class="icoLi" aria-grabbed="false" href="http://sistemafundatec.tec.ac.cr:8080/cfmx/">
                                                    <a class="cont_menu" href="http://sistemafundatec.tec.ac.cr:8080/cfmx/">

                                                        <div class="ICONO">
                                                            <i class="material-icons">&#xE85C;</i>
                                                        </div>
                                                        <span class="gb_3">ERP</span>
                                                    </a>
                                                </li>
                                                <li class="icoLi" aria-grabbed="false" href="https://www.facturaelectronica.cr">
                                                    <a class="cont_menu" href="https://www.facturaelectronica.cr">
                                                        <div class="ICONO">
                                                            <i class="material-icons">&#xE320;</i>
                                                        </div>
                                                        <span class="gb_3">Factura Electrónica</span>
                                                    </a>
                                                </li>
                                                <li class="icoLi" aria-grabbed="false" href="https://www.inscribete.co.cr/fundatec/">
                                                    <a class="cont_menu" href="https://www.inscribete.co.cr/fundatec/">

                                                        <div class="ICONO">
                                                            <i class="material-icons">&#xE3C9;</i>
                                                        </div>
                                                        <span class="gb_3">Inscríbete</span>
                                                    </a>
                                                </li>
                                                <li class="icoLi" aria-grabbed="false" href="https://www.tec.ac.cr/fundatec">
                                                    <a class="cont_menu" href="https://www.tec.ac.cr/fundatec" >

                                                        <div class="ICONO">
                                                            <i class="material-icons">&#xE80B;</i>
                                                        </div>
                                                        <span class="gb_3">Web</span>
                                                    </a>
                                                </li>
                                                <li class="icoLi" aria-grabbed="false" href="https://www.outlook.com/owa/itcr.ac.cr">
                                                    <a class="cont_menu" href="https://www.outlook.com/owa/itcr.ac.cr" style="text-align: center;">

                                                        <div class="ICONO"><i class="material-icons">assessment</i></div>
                                                        <span class="gb_3">Correo</span>

                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                   
                                    <div class="dropdown">

                                        <img data-toggle="dropdown" aria-expanded="true" class="avatar" src="<?php echo Sesion::getAttr("imageProfile"); ?>" onError="this.src='../../img/user.png'" alt="">           

                                        <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
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
                            </form>
                        </div>
                    </div>
                    <div class="account d-flex">
                        
                    </div>
                </nav>
            </div>
        </header>

        <div class="encabezado">
            <div class="containerEnc">
                <img class="imgUserenc" src="<?php echo Sesion::getAttr("imageProfile"); ?>" onError="this.src='../../img/user(100).png'" alt="" class="img-circle">
                <h4>Te damos la bienvenida, <?php echo Sesion::getAttr("firstname"); ?> <?php echo Sesion::getAttr("lastname"); ?></h4>
                <h2>Fundación Tecnológica de Costa Rica</h2>
            </div>
        </div>
        <hr style="color: #0056b2;" />
        <section class="main container">
            <div class="container">
                <div class="w3-row w3-center flex-container">
                    <?php foreach ($this->applications as $key => $value) { ?>


                        <div class="col-md-4" id="cajaTexto" value="<?php echo $value->getApplicationId(); ?>" class="card" onclick="javascript: redireccionar('<?php echo $value->getApplicationId(); ?>', '<?php echo $value->getURL(); ?>');">

                            <h2 class="name-page">
                                <div class="icon">
                                    <div class="icon-page">
                                        <i class="material-icons"><?php echo $value->getNameIcon(); ?></i>
                                    </div>
                                </div>
                                <div class="page-name"><a href="<?php echo $value->getURL(); ?>"><?php echo $value->getApplicationName(); ?></a></div>
                                <div class="iconr">
                                    <div class="icon-right ">
                                        <i class="glyphicon glyphicon-menu-right"></i>
                                    </div>
                                </div>
                            </h2>
                            </a>
                            <hr style="color: gray;" />
                            <div class="infopages">
                                <p><?php echo $value->getDescription(); ?></p>
                            </div>
                            <br>
                            <div class="ingresa">
                                <a href="<?php echo $value->getURL(); ?>">Ingresá Aquí... </a>
                            </div>
                        </div>
                    <?php } ?> 


                    <div class="col-md-4" id="cajaTexto" href="http://sistemafundatec.tec.ac.cr:8080/cfmx/">
                        <a  href="http://sistemafundatec.tec.ac.cr:8080/cfmx/">
                            <h2 class="name-page">
                                <div class="icon">
                                    <div class="icon-page">
                                        <i class="material-icons">assessment</i>
                                    </div>
                                </div>
                                <div  class="page-name" id="i3">ERP</div>
                                <div class="iconr">
                                    <div class="icon-right ">
                                        <i class="glyphicon glyphicon-menu-right"></i>
                                    </div>
                                </div>
                            </h2>
                        </a>
                        <hr style="color: gray;" />
                        <div class="infopages">

                            <p>Sistema de planificación de recursos empresariales. 
                                Ejecute procesos de Recursos Humanos, autogestión, evaluaciones. 
                                Lleve el control de la contabilidad, inventarios, cuentas por pagar, cuentas por cobrar, activos fijos, punto de venta…
                            </p>
                        </div>
                        <br>
                        <div class="ingresa">
                            <a href="http://sistemafundatec.tec.ac.cr:8080/cfmx/">Ingresá Aquí... </a>
                        </div>
                    </div>

                    <div class="col-md-4" id="cajaTexto" href="https://www.facturaelectronica.cr">
                        <a href="https://www.facturaelectronica.cr">
                            <h2 class="name-page">
                                <div class="icon">
                                    <div class="icon-page">
                                        <i class="material-icons">laptop_windows</i>
                                    </div>
                                </div>
                                <div itemprop="name headline" class="page-name" id="i3">FACTURA ELECTRÓNICA</div>
                                <div class="iconr">
                                    <div class="icon-right ">
                                        <i class="glyphicon glyphicon-menu-right"></i>
                                    </div>
                                </div>
                            </h2>
                        </a>
                        <hr style="color: gray;" />
                        <div class="infopages">
                            <p>Factura Electrónica GTI es una plataforma Online, de usuario y clave, mediante la cual, cualquier contribuyente puede: generar, emitir y enviar Facturas Electrónicas, entre muchas otras cosas más, desde cualquier lugar donde se encuentre.</p>
                        </div>
                        <br>
                        <div class="ingresa">
                            <a href="https://www.facturaelectronica.cr">Ingresá Aquí... </a>
                        </div>
                    </div>

                    <div class="col-md-4" id="cajaTexto" href="https://www.inscribete.co.cr/fundatec/">
                        <a href="https://www.inscribete.co.cr/fundatec/">
                            <h2 class="name-page">
                                <div class="icon">
                                    <div class="icon-page">
                                        <i class="material-icons">edit</i>
                                    </div>
                                </div>
                                <div itemprop="name headline" class="page-name">INSCRÍBETE</div>
                                <div class="iconr">
                                    <div class="icon-right ">
                                        <i class="glyphicon glyphicon-menu-right"></i>
                                    </div>
                                </div>
                            </h2>
                        </a>
                        <hr style="color: gray;" />
                        <div class="infopages">
                            <p>FUNDATEC es un ente privado de utilidad pública y sin fines de lucro, creada en 1987 por un grupo
                                visionario de funcionarios del Tecnológico de Costa Rica (TEC), liderados por el entonces rector
                                MBA.
                            </p>
                        </div>
                        <br>
                        <div class="ingresa">
                            <a href="https://www.inscribete.co.cr/fundatec/">Ingresá Aquí... </a>
                        </div>
                    </div>

                    <div class="col-md-4" id="cajaTexto" href="https://www.tec.ac.cr/fundatec">
                        <a href="https://www.tec.ac.cr/fundatec">
                            <h2 class="name-page">
                                <div class="icon">
                                    <div class="icon-page">
                                        <i class="material-icons">&#xE80B;</i>
                                    </div>
                                </div>
                                <div itemprop="name headline" class="page-name">WEB</div>
                                <div class="iconr">
                                    <div class="icon-right ">
                                        <i class="glyphicon glyphicon-menu-right"></i>
                                    </div>
                                </div>
                            </h2>
                        </a>
                        <hr style="color: gray;" />
                        <div class="infopages">
                            <a href="https://www.tec.ac.cr/fundatec">
                                <p>
                                    <img style="width: 90%; margin-left: 10%; margin-top: 5%;" src="../../img/menu/LogoFUNDATEC.png">
                                </p>
                            </a>
                        </div>
                        <br>
                        <div class="ingresa">
                            <a href="https://www.tec.ac.cr/fundatec">Ingresá Aquí... </a>
                        </div>
                    </div>
                    <div class="col-md-4" id="cajaTexto" href="https://www.outlook.com/owa/itcr.ac.cr">
                        <a href="https://www.outlook.com/owa/itcr.ac.cr">
                            <h2 class="name-page">
                                <div class="icon">
                                    <div class="icon-page">
                                        <i class="material-icons">&#xE0BE;</i>
                                    </div>
                                </div>
                                <div itemprop="name headline" class="page-name">CORREO</div>
                                <div class="iconr">
                                    <div class="icon-right ">
                                        <i class="glyphicon glyphicon-menu-right"></i>
                                    </div>
                                </div>
                            </h2>
                        </a>
                        <hr style="color: gray;" />
                        <div class="infopages">
                            <p>
                                Correo institucional TEC. Ingrese a sus servicios en la nube de Office365, Outlook, OneDrive, SharePoint, Word, Excel, PowerPoint, OneNote.  
                            </p>

                        </div>
                        <br>
                        <div class="ingresa">
                            <a href="https://www.outlook.com/owa/itcr.ac.cr">Ingresá Aquí... </a>
                        </div>
                    </div>


                </div>
            </div>
        </section>
        <div>
            <br>
        </div>
            <footer>
                <div class="container1">
                    <br>
                    <div class="row">
                        <div class="datos-footer">
                            <p>
                            <h6>Contáctenos</h6>
                            Correo:
                            <a href="mailto:fundatec@tec.ac.cr" style="color:#FFF">fundatec@tec.ac.cr</a>
                            <br /> Teléfono: 2550-2628
                            </p>
                        </div>
                        <div class="datos-footer" style="margin-left: 5%">
                            <p>
                            <h6>Síganos en:</h6>
                            <a href="https://www.facebook.com/pages/FundaTEC/173220076069157" target="_blank">
                                <img src="../../img/menu/facebook.png" />
                            </a>
                            <a href="https://twitter.com/FundaTECcr" target="_blank">
                                <img src="../../img/menu/twitter.png" />
                            </a>
                            </p>
                        </div>
                        <div class="datos-footer">
                            <p>
                            <h6>Localizanos en:</h6>
                            <a target="_blank" href="https://www.google.co.cr/maps/place/FUNDATEC/@9.8517829,-83.9140578,17.43z/data=!4m5!3m4!1s0x8fa0dff35fbb9aaf:0xa648570af6c60974!8m2!3d9.852734!4d-83.9121097">
                                <img src="../../img/menu/google.png" />
                            </a>
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        <script type="text/javascript">

    function redireccionar(application, url) {
        $.ajax({
            url: 'index.php',
            type: 'post',
            data: {action: 'getAplication', applicationId: application},
            success: function (response) {
                location.href = url;
            },
            error: function (err) {
                console.log(err);
            }
        });
    }



</script>
    </body>
</html>
