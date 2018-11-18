<link href="../../../css/dropzone.css" rel="stylesheet" type="text/css"/>
<script src="../../../js/general.js" type="text/javascript"></script>
<script type="text/javascript" src="../../../js/assets/AssetsManagement.js"></script>
<script type="text/javascript" src="../../../js/assets/jquery.maskMoney.js"></script>
<script type="text/javascript" src="../../../js/assets/URLSearchParams.js"></script>
<script src="../../../js/assets/dropzone.js" type="text/javascript"></script>
<script src="../../../js/assets/FileManagement.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
//se inicializa el forms
        assetManagement.fnEditionInitializer();
    });
</script> 
<div class="page-header">
    <h1>Editar Activo</h1>
</div>

<div class="form-group" id="frmEditAsset">
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
                    <option>Seleccione</option>
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
                    <option>Seleccione</option>
                </select>
            </div>

            <div class="form-group col-lg-6">
                <label for="serialNum">Número Serie</label>
                <input type="text" class="form-control requerido" name="serialNum" id="serialNum" placeholder="Número Serie">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-6">
                <label for="plateNum">Número Placa</label>
                <input type="text" class="form-control requerido" name="plateNum" id="plateNum" placeholder="Número Placa">
            </div>


            <div class="form-group col-lg-6">
                <label for="dtpAcquisition">Fecha Adquisición</label>
                <input type="text" class="form-control date" name="dtpAcquisition" id="dtpAcquisition">
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
        
        <input type="hidden" id="hddIdGarantia">

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
                <?php
                include ('fileDownloadControl.php');
                ?>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-12">
                <?php
                include ('fileUploadControl.php');
                ?>
            </div>
        </div>
    </fieldset>


    <div class="row">
        <div class="form-group col-lg-12">
            <input type="button" class="btn btn-primary" value="Guardar" onclick="$(assetManagement.actions.fnSaveEditedAsset());">
            <a href="index.php" class="btn btn-default">Volver</a>
        </div>
    </div>
</div>