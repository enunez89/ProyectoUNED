<?php       

if($this->resultLogin){
    ?>
    <div class="alert alert-warning">
      <strong>¡Lo sentimos!</strong> Nombre de usuario o contraseña invalido
    </div>
<?php            
}                        
?>
<form class="form-login" method="post" action="">
        <div class="form-group">
          <label for="username">Nombre de usuario </label>
          <input type="text" class="form-control" name="username" id="username" required="required" placeholder="Nombre de usuario ">
        </div>
        <div class="form-group">
          <label for="password">Contraseña</label>
          <input type="password" class="form-control" name="password" id="password" required="required" placeholder="Contraseña">
        </div>
        <input type="submit" class="btn btn-primary" value="Ingresar">
        <a href="#">Olvide mi contraseña</a>
        <div class="form-group"><br>
          <span>¿Necesitas una cuenta? <a href="#">Solicitar acceso</a></span> 
        </div>       

 </form>
