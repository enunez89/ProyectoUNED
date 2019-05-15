<script src="../../../js/general.js" type="text/javascript"></script>
<script type="text/javascript" src="../../../js/assets/PeriodsManagement.js"></script>
<script type="text/javascript" src="../../../js/assets/AssetsManagement.js"></script>
<script>
$(document).ready(function () {
//se inicializa el forms
    periodsManagement.fnIndexInitializer();
});
</script>
<div class="page-header">
    <h1>Gestionar periodos de toma física</h1>
</div>

<a href="index.php" class="btn btn-primary" >Volver</a>
<a id="btnPeriod" href="index.php?action=newPeriodForm" class="btn btn-success btnMenuPrincipal" >Registrar Periodo</a>
<hr/>
        
<table class="table" id="PeriodMainTable">
    <thead>
        <tr>
            <th scope="col">Descripción</th>
            <th scope="col">Fecha Inicio</th>
            <th scope="col">Fecha Fin</th>
            <th scope="col">Estado</th>
            <th scope="col">Editar</th>
<!--            <th scope="col">Eliminar</th>-->
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<?php
include('deleteModal.php');