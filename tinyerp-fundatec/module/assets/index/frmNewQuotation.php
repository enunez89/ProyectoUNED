<script src="../../../js/general.js" type="text/javascript"></script>
<script type="text/javascript" src="../../../js/assets/AssetsManagement.js"></script>
<script type="text/javascript" src="../../../js/assets/QuotationManagement.js"></script>
<script type="text/javascript" src="../../../js/assets/jquery.maskMoney.js"></script>
<script type="text/javascript" src="../../../js/assets/URLSearchParams.js"></script>
<script>
    $(document).ready(function () {
    //se inicializa el forms
        quotationManagement.fnAdditionInitializer();
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
    
    <fieldset class="form-group">
        <legend>Activos cotizados</legend>
        <div class="row">
            <div class="form-group col-lg-12" style="height:200px;overflow-y: scroll;">
                <table class="table" id="AssetsAssignedTable">
                    <thead>
                        <tr>
                            <th scope="col" id="AssetIdColumn">Id activo</th>
                            <th scope="col" style="display: none"/>
                            <th scope="col">Código</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Desasignar</th>
                        </tr>
                    </thead>
                </table>                         
            </div>
        </div>
    </fieldset>

    <fieldset class="form-group">
        <legend>Buscar activo</legend>

        <div class="row">
            <div class="form-group col-lg-6">
                <label for="codeAsset">Código Activo</label>
                <input type="text" class="form-control requerido" name="codeAsset" id="codeAsset" required="required" placeholder="Código, número de placa, descripción de activo, o vacío para obtener todos los activos">
            </div>

            <div class="form-group col-lg-6">
                <br>
                <input type="button" class="btn btn-primary" value="Buscar" onclick="quotationManagement.actions.fnFindAssetsByValue();">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-12" style="height:200px;overflow-y: scroll;">
                <table class="table" id="AssetsSearchResult">
                    <thead>
                        <tr>
                            <th scope="col">Id activo</th>
                            <th scope="col">Código</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Asignar</th>
                        </tr> 
                    </thead>
                </table>                         
            </div>
        </div>
    </fieldset>

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
            <input type="button" class="btn btn-primary" value="Guardar" onclick="$(quotationManagement.actions.fnSaveNewQuotation());">
            <a href="index.php?action=consultQuotation" id="btnReturnToRepairIndex" class="btn btn-default" >Volver</a>
        </div>
    </div>