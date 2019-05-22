<script src="../../../js/general.js" type="text/javascript"></script>
<script type="text/javascript" src="../../../js/assets/AssetsManagement.js"></script>
<script type="text/javascript" src="../../../js/assets/QuotationManagement.js"></script>
<script type="text/javascript" src="../../../js/assets/AssignmentManagement.js"></script>
<script type="text/javascript" src="../../../js/assets/URLSearchParams.js"></script>
<script type="text/javascript" src="../../../js/assets/moment.js"></script>
<script>
    $(document).ready(function () {
        assignmentsManagement.fnAdditionInitializer();
    });
</script> 
<div class="page-header">
    <h1>Agregar Asignación</h1>
</div>

<form id="frmNewAssignment" class="form-group">
    <fieldset id="Responsable"  class="form-group">
        <legend>Responsable</legend>
        <div class="row">
            <div class="form-group col-lg-6">
                <label for="identification">Identificación Responsable</label>
                <input type="text" class="form-control requerido" name="identification" id="txtId" required="required" placeholder="Digite la identificación del responsable">
            </div>
            <div class="form-group col-lg-6">
                <label for="lblPersona">Nombre del responsable</label>
                <input class="form-control requerido" name="lblPersona" id="lblPersona">
            </div>
        </div>
        <div class="row col-lg-6">
            <input type="button" class="btn btn-primary" value="Buscar" onclick="assignmentsManagement.actions.fnFindResponsable()">
        </div>
    </fieldset>
     <fieldset id="Responsable"  class="form-group">
        <legend>Datos de la asignación</legend>
        <div class="row">
             <div class="form-group col-lg-6">
                <label for="dtpAssignment">Fecha asignación</label>
                <input type="text" class="form-control date requerido" name="dtpAssignment" id="dtpAssignmentStartDate">
            </div>
            <div class="form-group col-lg-6">
                <label for="stade">Estado</label>
                <select class="form-control requeridoCombo" id="ddlStates" name="ddlStates">
                     <option value="0">Seleccione</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-6">
                <label for="dtpDevolution">Fecha devolución</label>
                <input type="text" class="form-control date requerido" name="dtpDevolution" id="dtpAssignmentDevolutionDate">
            </div>
        </div>
    </fieldset>
       <br/>
    <fieldset class="form-group">
        <legend id="leyendaParaTabla">Activos asignados</legend>
        <div class="row">
            <div class="form-group col-lg-12" style="height:200px;overflow-y: scroll;">
                <table class="table tablaRequerido" id="AssetsAssignedTable">
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
    <hr/>
   <fieldset class="form-group">
        <legend>Buscar activo</legend>

        <div class="row">
            <div class="form-group col-lg-6">
                <label for="codeAsset">Activo</label>
                <input type="text" class="form-control" name="codeAsset" id="codeAsset" required="required" placeholder="Código, número de placa, descripción de activo, o vacío para obtener todos los activos">
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
        <legend>Boleta Solicitud</legend>

        <div class="row">
            <div class="form-group col-lg-12">
                <input type="file" class="custom-file-input" id="ticketFile">
                <label class="custom-file-label" for="ticketFile">Elija un archivo</label>                            
            </div>
        </div>
    </fieldset>

    <div class="row">
        <div class="form-group col-lg-12">
            <input type="button" class="btn btn-primary" value="Guardar" onclick="assignmentsManagement.actions.fnSaveNewAssignment();">
            <a href="index.php?action=listAssignment" class="btn btn-default">Volver</a>
        </div>
    </div>
</form>
