<script src="../../../js/general.js" type="text/javascript"></script>
<script type="text/javascript" src="../../../js/assets/AssetsManagement.js"></script>
<script type="text/javascript" src="../../../js/assets/jquery.maskMoney.js"></script>
<script>
    $(document).ready(function () {
        //se inicializa el forms
        $(assetManagement.fnAdditionInitializer());
    });
</script> 
<div class="page-header">
    <h1>Agregar Activo</h1>
</div>

<form id="frmNewAsset" class="form-group">
    <fieldset class="form-group">
        <legend>Información Activo</legend>
        <div class="row">
            <div class="form-group col-lg-6">
                <label for="code">Código</label>
                <input type="text" class="form-control requerido" name="code" id="code" required="required" placeholder="Código">
            </div>

            <div class="form-group col-lg-6">
                <label for="codCategory">Categoría</label>
                <select class="form-control requeridoCombo" id="codCategory" name="codCategory">
                    <option value="0">Seleccione</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-6">
                <label for="brand">Marca</label>
                <input type="text" class="form-control requerido" name="brand" id="brand" required="required" placeholder="Marca">
            </div>

            <div class="form-group col-lg-6">
                <label for="price">Precio Adquisición</label>
                <input type="tel" class="form-control requerido money" name="price" id="price" required="required" placeholder="Precio Adquisición">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-6">
                <label for="provider">Proveedor</label>
                <select class="form-control requeridoCombo" id="provider" name="provider">
                    <option value="0">Seleccione</option>
                </select>
            </div>

            <div class="form-group col-lg-6">
                <label for="serialNum">Número Serie</label>
                <input type="text" class="form-control" name="serialNum" id="serialNum" placeholder="Número Serie">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-6">
                <label for="plateNum">Número Placa</label>
                <input type="text" class="form-control" name="plateNum" id="plateNum" placeholder="Número Placa">
            </div>


            <div class="form-group col-lg-6">
                <label for="dtpAcquisition">Fecha Adquisición</label>
                <input type="text" class="form-control date requerido" name="dtpAcquisition" id="dtpAcquisition">
                <input type="hidden" name="dtpAcquisitionToSave" id="dtpAcquisitionToSave">
                    
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-12">
                <label for="description">Descripción</label>
                <textarea class="form-control requerido" rows="3" name="description" id="description"></textarea>
            </div>
        </div>

    </fieldset>

    <fieldset class="form-group">
        <legend>Garantía del Activo</legend>

        <div class="row">
            <div class="form-group col-lg-6">
                <label for="dtpExpiration">Fecha Vencimiento</label>
                <input type="text" class="form-control date" name="dtpExpiration" id="dtpExpiration">
            </div>

            <div class="form-group col-lg-6">
                <label for="terms">Condiciones</label>
                <textarea class="form-control" rows="3" name="terms" id="terms"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-12">
                <input type="file" class="custom-file-input" id="warrantyFile">
                <label class="custom-file-label" for="warrantyFile">Elija un archivo</label>                            
            </div>
        </div>
    </fieldset>


    <div class="row">
        <div class="form-group col-lg-12">
            <input type="button" class="btn btn-primary" value="Guardar" onclick="$(assetManagement.actions.fnSaveAsset());">
            <a href="index.php" class="btn btn-default">Volver</a>
        </div>
    </div>
</form>