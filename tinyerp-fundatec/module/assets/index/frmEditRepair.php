<script src="../../../js/general.js" type="text/javascript"></script>
<script type="text/javascript" src="../../../js/assets/RepairManagement.js"></script>
<script type="text/javascript" src="../../../js/assets/AssetsManagement.js"></script>
<link href="../../../css/dropzone.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="../../../js/assets/jquery.maskMoney.js"></script>
<script type="text/javascript" src="../../../js/assets/URLSearchParams.js"></script>
<script type="text/javascript" src="../../../js/assets/moment.js"></script>
<script src="../../../js/assets/dropzone.js" type="text/javascript"></script>
<script src="../../../js/assets/FileManagement.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        //se inicializa el forms
        $(repairsManagement.fnEditionInitializer());
    });
</script>
<form id="frmExistingRepair">
<div class="page-header">
    <h1>Editar Reparación</h1>
</div>

<div class="form-group">
    <fieldset class="form-group">
        <div class="row">
            <div class="form-group col-lg-4">
                <label for="studioName">Nombre Taller</label>
                <input type="text" class="form-control requerido" name="studioName" id="studioName" required="required" placeholder="Nombre Taller">
            </div>

            <div class="form-group col-lg-4">
                <label for="dtpDevolution">Fecha devolución</label>
                <input type="text" class="form-control date requerido" name="dtpDevolution" id="dtpDevolutionToShow">
                <input type="hidden" class="form-control" name="dtpDevolution" id="dtpDevolutionToSave">
            </div>

            <div class="form-group col-lg-4">
                <label>Cubierto por garantía</label>
                <div class="radio">
                    <label><input id="chkCovertTrue" type="radio" name="covert" value="1">Si</label>
                </div>
                <div class="radio">
                    <label><input id="chkCovertFalse" type="radio" name="covert" value="0">No</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-12">
                <label for="descRepair">Descripción</label>
                <textarea class="form-control requerido" rows="3" name="descRepair" id="descRepair"></textarea>
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
</div>

<div class="row">
    <div class="form-group col-lg-12">
        <input type="button" class="btn btn-primary" value="Guardar" onclick="$(repairsManagement.actions.fnSaveEditedRepair());">
        <a href="index.php?action=consultRepairForm" id="btnReturnToRepairIndex" class="btn btn-default" >Volver</a>
    </div>
</div>
    </form>