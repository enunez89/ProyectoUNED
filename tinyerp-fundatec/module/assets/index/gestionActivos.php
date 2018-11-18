<style type="text/css">
    .chat1Cont{
        border-right: #ddd solid 1px;
}

</style>
<script type="text/javascript" src="../../../js/assets/AssetsManagement.js"></script>
<script type="text/javascript" src="../../../js/assets/DeleteModalManagement.js"></script>
<script type="text/javascript" src="../../../js/assets/jquery.maskMoney.js"></script>
<script type="text/javascript" src="../../../js/assets/moment.js"></script>
<script src="../../../js/general.js" type="text/javascript"></script>

<script>
$(document).ready(function () {
//se inicializa el forms
    assetManagement.fnIndexInitializer();
});
</script>      
<div class="page-header">
    <h1>Gestionar activos</h1>
</div>
    <a href="index.php?action=newAssetForm" class="btn btn-success" >Registrar activo</a>
    <a id="btnRepair" href="index.php?action=consultRepairForm" class="btn btn-primary btnMenuPrincipal disabled" >Reparación</a>
    <a id="btnQuotation" href="index.php?action=consultQuotationForm" class="btn btn-primary btnMenuPrincipal" >Cotización</a>
    <a id="btnAssignment" href="index.php?action=listAssignment" class="btn btn-primary btnMenuPrincipal" >Asignación</a>
    <a id="btnPhysicalInventory" href="index.php?action=newPhysicalInventoryForm" class="btn btn-primary btnMenuPrincipal" >Toma física</a>
    <hr/>
    
        
        <table class="table" id="AssetsMainTable">
            <thead>
                <tr>
                    <th>Selección</th>
                    <th scope="col">Categoría</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Precio adquisición</th>
                    <th scope="col">Proveedor</th>
                    <th scope="col">Número de placa</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Número de serie</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    <input type="hidden" id="maskMoneySetter" class="money"/>
 <?php
include ('deleteModal.php');
