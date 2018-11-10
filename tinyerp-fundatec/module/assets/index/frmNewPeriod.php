<script src="../../../js/general.js" type="text/javascript"></script>
<script type="text/javascript" src="../../../js/assets/URLSearchParams.js"></script>
<script type="text/javascript" src="../../../js/assets/moment.js"></script>
<script>
    $(document).ready(function () {
    });
</script> 
<div class="page-header">
    <h1>Agregar Periódo</h1>
</div>

<form id="frmNewPeriod" class="form-group">
    <div class="row">
        <div class="form-group col-lg-6">
            <label for="description">Descripción</label>
            <input type="text" class="form-control requerido" name="description" id="description" required="required" placeholder="Descripción">
        </div>
        <div class="form-group col-lg-6">
            <label for="stade">Estado</label>
            <select class="form-control requeridoCombo" id="stade" name="stade">
                <option value="0">Seleccione</option>
                <option value="1">En Proceso</option>
                <option value="2">Cerrado</option>
            </select>
        </div>
        
    </div>

    <div class="row">
        <div class="form-group col-lg-6">
            <label for="dtpBegin">Fecha inicio</label>
            <input type="text" class="form-control date requerido" name="dtpBegin" id="dtpBegin">
        </div>
        
       

        <div class="form-group col-lg-6">
            <label for="dtpEnd">Fecha final</label>
            <input type="text" class="form-control date requerido" name="dtpEnd" id="dtpEnd">
        </div>
    </div>

    <div class="row">
        <div class="form-group col-lg-12">
            <input type="button" class="btn btn-primary" value="Guardar" onclick="">
            <a href="index.php?action=newPhysicalInventoryForm" class="btn btn-default">Volver</a>
        </div>
    </div>
</form>
