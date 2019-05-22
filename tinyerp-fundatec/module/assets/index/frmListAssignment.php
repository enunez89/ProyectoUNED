<script type="text/javascript" src="../../../js/assets/AssignmentManagement.js"></script>
<script type="text/javascript" src="../../../js/assets/DeleteModalManagement.js"></script>
<script type="text/javascript" src="../../../js/assets/URLSearchParams.js"></script>
<script type="text/javascript" src="../../../js/assets/AssetsManagement.js"></script>
<script src="../../../js/general.js" type="text/javascript"></script>
<script>
$(document).ready(function () {
//se inicializa el forms
    assignmentsManagement.fnIndexInitializer();
});
</script>
<div class="page-header">
    <h1>Gestionar asignaciones de activos</h1>
</div>

<a href="index.php" class="btn btn-primary" >Volver</a>
<a id="btnAssignment" href="index.php?action=newAssignmentForm" class="btn btn-success btnMenuPrincipal" >Registrar Asignación</a>
<hr/>
        
<table class="table" id="AssignmentMainTable">
    <thead>
        <tr>
            <th scope="col" >Id asignación</th>
            <th scope="col">Fecha asignación</th>
            <th scope="col" >Identificación del responsable</th>
            <th scope="col" >Nombre del responsable</th>
            <th scope="col">Estado</th>
            <th scope="col">Fecha devolución</th>
            <th scope="col">Editar</th>
        </tr>
    </thead>
</table>
<?php
include('deleteModal.php');
