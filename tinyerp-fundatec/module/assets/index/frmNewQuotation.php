<script src="../../../js/general.js" type="text/javascript"></script>
<script type="text/javascript" src="../../../js/assets/AssetsManagement.js"></script>
<script type="text/javascript" src="../../../js/assets/jquery.maskMoney.js"></script>
<script type="text/javascript" src="../../../js/assets/URLSearchParams.js"></script>
<script>
    $(document).ready(function () {
    //se inicializa el forms
        repairsManagement.fnAdditionInitializer();
    });
</script>

<div class="page-header">
    <h1>Agregar cotización</h1>
</div>

<form class="form-group">  
        <div class="row">
            <div class="form-group col-lg-4">
                <label for="amount">Monto</label>
                <input type="text" class="form-control requerido money" name="amount" id="amount" required="required" placeholder="Monto">
            </div>
            <div class="form-group col-lg-4">
                <label for="provider">Proveedor</label>
                <select class="form-control requeridoCombo" id="provider" name="provider">
                    <option value="0">Seleccione</option>
                </select>
            </div>
        </div>
    
<?php
include('consultAssets.php');
?>
    <fieldset class="form-group">
        <div class="row">
            <div class="form-group col-lg-12">
                <input type="file" class="custom-file-input" id="quotationFile">
                <label class="custom-file-label" for="warrantyFile">Elija un archivo</label>                            
            </div>
        </div>
    </fieldset>
</form>

    <div class="row">
        <div class="form-group col-lg-12">
            <input type="button" class="btn btn-primary" value="Guardar" onclick="$(repairsManagement.actions.fnSaveNewRepair());">
            <a href="index.php?action=consultRepairForm" id="btnReturnToRepairIndex" class="btn btn-default" >Volver</a>
        </div>
    </div>