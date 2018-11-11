<script type="text/javascript" src="../../../js/assets/RepairManagement.js"></script>
<script type="text/javascript" src="../../../js/assets/DeleteModalManagement.js"></script>
<script type="text/javascript" src="../../../js/assets/URLSearchParams.js"></script>
<script type="text/javascript" src="../../../js/assets/AssetsManagement.js"></script>
<script src="../../../js/general.js" type="text/javascript"></script>
<script>
$(document).ready(function () {
//se inicializa el forms
    repairsManagement.fnIndexInitializer();
});
</script>

<div class="page-header">
    <h1>Gestionar reparaciones de un activo</h1>
</div>
   
<a href="index.php" class="btn btn-primary" >Volver</a>
<a id="newRepair" href="index.php?action=newRepairForm" class="btn btn-success" >Registrar reparación</a>
<hr/>
        
<table class="table" id="RepairsMainTable">
    <thead>
        <tr>
            <th scope="col" >Id de reparación</th>
            <th scope="col">Descripción</th>
            <th scope="col">Nombre del taller</th>
            <th scope="col">Fecha de registro</th>
            <th scope="col">Fecha de devolución</th>
            <th scope="col">Cubierto por garantía</th>  
            <th scope="col">Editar</th>
            <th scope="col">Eliminar</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<?php
include('deleteModal.php');