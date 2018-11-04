<h4 class="text-primary">
GESTIÓN ACTIVOS
</h4>
<h5 class="text-primary">
Reparaciones
</h5>
<script type="text/javascript" src="../../../js/assets/RepairManagement.js"></script>
<script type="text/javascript" src="../../../js/assets/URLSearchParams.js"></script>
<script src="../../../js/general.js" type="text/javascript"></script>
<script>
$(document).ready(function () {
//se inicializa el forms
    repairsManagement.fnInitializer();
});
</script>
   
<a href="index.php" class="btn btn-primary" >Volver</a>
<a href="index.php?action=newRepairForm" class="btn btn-success" >Registrar reparación</a>
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

<div class="modal fade" id="modalEliminarReparacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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

