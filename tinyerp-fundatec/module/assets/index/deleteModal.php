<?php

echo('<input type="hidden" id="valueToDelete"></input>
    <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Eliminar activo</h5>
      </div>
      <div class="modal-body">
        ¿Desea eliminar el elemento seleccionado?
      </div>
      <div class="modal-footer">
          <button type="button" id="deleteButton" class="btn btn-danger">Eliminar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>');