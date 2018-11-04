<style type="text/css">
    .chat1Cont{
        border-right: #ddd solid 1px;
}

</style>
<script type="text/javascript" src="../../../js/assets/AssetsManagement.js"></script>
<script type="text/javascript" src="../../../js/assets/DeleteAsset.js"></script>
<script src="../../../js/general.js" type="text/javascript"></script>
<script>
$(document).ready(function () {
//se inicializa el forms
    assetManagement.fnInitializer();
});
</script>      
<h4 class="text-primary">
GESTIÓN ACTIVOS
</h4>
    <a href="index.php?action=newAssetForm" class="btn btn-success" >Registrar activo</a>
    <a id="btnRepair" href="index.php?action=consultRepairForm" class="btn btn-primary btnMenuPrincipal disabled" >Reparación</a>
<!--    <a id="btnQuote" href="index.php?action=newQuoteForm" class="btn btn-primary btnMenuPrincipal disabled" >Cotización</a>
    <a id="btnAssignment" href="index.php?action=newAssignmentForm" class="btn btn-primary btnMenuPrincipal disabled" >Asignación</a>
    <a id="btnPhysicalInventory" href="index.php?action=newPhysicalInventoryForm" class="btn btn-primary btnMenuPrincipal disabled" >Toma física</a>-->
    <hr/>
    
        
        <table class="table" id="AssetsMainTable">
            <thead>
                <tr>
                    <th>Selección</th>
<!--                    <th scope="col" >Código</th>-->
                    <th scope="col">Categoría</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Precio adquisición</th>
                    <th scope="col">Proveedor</th>
                    <th scope="col">Número de placa</th>
<!--                    <th scope="col">Descripción</th>-->
                    <th scope="col">Estado</th>
                    <th scope="col">Número de serie</th>
<!--                    <th scope="col">FechaAdqusicion</th>
                    <th scope="col">FechaRegistro</th>-->
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
 
<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Eliminar activo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Desea eliminar el activo seleccionado?
      </div>
      <div class="modal-footer">
          <button type="button" id="deleteAssetButton" class="btn btn-danger" onclick="$(deleteAsset.actions.fnDeleteAsset());">Eliminar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>


