<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Iniciar sesión</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../css/bootstrap/bootstrap.min.css">
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../../css/login.css">
    </head>
    <body>
     	<div class="container-fluid">
          <div class="row">            
            <div class="col-md-offset-4 col-md-4 col-sm-offset-2 col-sm-8">
            <div class="logo">
              <img src="../../img/logoFUNDATEC.png" alt="">
            </div>
            <div class="title">
              <h2>Iniciar sesión</h2>
            </div>
            
                   <?php require_once $this->include; ?>
                
                      <div class="footer">
                        <ul>
                          <li>
                            <a> © FUNDATEC 2016</a>
                          </li>
                           <li>
                           <a target="_blank" href="https://www.fundatec.ac.cr/Terminos.aspx"> Términos y condiciones</a>                            
                          </li>
                          <li>
                            <a target="_blank" href="https://fundatec.freshdesk.com/support/home"> Soporte</a>
                          </li>                                                   
                        </ul>
                      </div>
            </div>           
          </div>

     	</div>

        <script src="../../js/jquery.min.js" type="text/javascript"></script>
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>
