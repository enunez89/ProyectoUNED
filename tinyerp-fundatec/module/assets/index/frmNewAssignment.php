<script src="../../../js/general.js" type="text/javascript"></script>
<script type="text/javascript" src="../../../js/assets/URLSearchParams.js"></script>
<script type="text/javascript" src="../../../js/assets/moment.js"></script>
<script>
    $(document).ready(function () {
    });
</script> 
<div class="page-header">
    <h1>Agregar Asignación</h1>
</div>

<form id="frmNewAssignment" class="form-group">
    <div class="row">
        <div class="form-group col-lg-6">
            <label for="identification">Identificación Responsable</label>
            <input type="text" class="form-control requerido" name="identification" id="code" required="required" placeholder="Identificación Responsable">
        </div>

        <div class="form-group col-lg-6">
            <label for="dtpAssignment">Fecha asignación</label>
            <input type="text" class="form-control date requerido" name="dtpAssignment" id="dtpAssignmentToShow">
            <input type="hidden" class="form-control" name="dtpAssignment" id="dtpAssignmentToSave">
        </div>
    </div>

    <div class="row">
        <div class="form-group col-lg-6">
            <label for="stade">Estado</label>
            <select class="form-control requeridoCombo" id="stade" name="stade">
                <option value="0">Seleccione</option>
                <option value="0">Prestado</option>
                <option value="0">Asignado</option>
                <option value="0">Devuelto</option>
            </select>
        </div>

        <div class="form-group col-lg-6">
            <label for="dtpDevolution">Fecha devolución</label>
            <input type="text" class="form-control date requerido" name="dtpDevolution" id="dtpDevolutionToShow">
            <input type="hidden" class="form-control" name="dtpDevolution" id="dtpDevolutionToSave">
        </div>
    </div>

    <fieldset class="form-group">
        <legend>Boleta Solicitud</legend>

        <div class="row">
            <div class="form-group col-lg-12">
                <input type="file" class="custom-file-input" id="ticketFile">
                <label class="custom-file-label" for="ticketFile">Elija un archivo</label>                            
            </div>
        </div>
    </fieldset>

    <fieldset class="form-group">
        <legend>Activos Asignados</legend>
        <div class="row">
            <div class="form-group col-lg-12">
                <table class="table" id="AssetsAssignedTable">
                    <thead>
                        <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Desasignar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>AZR878</td>
                            <td>Computadora Laptop HP</td>
                            <td><input type="button" class="btn btn-danger" value="Desasignar" onclick=""></td>
                        </tr>
                        <tr>
                            <td>MUHH1233</td>
                            <td>Monitor AOC</td>
                            <td><input type="button" class="btn btn-danger" value="Desasignar" onclick=""></td>
                        </tr>
                    </tbody>
                </table>                         
            </div>
        </div>
    </fieldset>

    <fieldset class="form-group">
        <legend>Asignar Activo</legend>

        <div class="row">
            <div class="form-group col-lg-6">
                <label for="codeAsset">Código Activo</label>
                <input type="text" class="form-control requerido" name="codeAsset" id="codeAsset" required="required" placeholder="Código Activo">
            </div>

            <div class="form-group col-lg-6">
                <br>
                <input type="button" class="btn btn-primary" value="Buscar" onclick="">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-12">
                <table class="table" id="AssetsAssignedTable">
                    <thead>
                        <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Asignar</th>
                        </tr> 
                    </thead>
                    <tbody>
                        <tr>
                            <td>UHHBBSKJ989</td>
                            <td>Mouse Inalámbrico</td>
                            <td><input type="button" class="btn btn-primary" value="Asignar" onclick=""></td>
                        </tr>
                        <tr>
                            <td>HGDMBKD8887hhb</td>
                            <td>Escritorio grande de madera</td>
                            <td><input type="button" class="btn btn-primary" value="Asignar" onclick=""></td>
                        </tr>
                    </tbody>
                </table>                         
            </div>
        </div>
    </fieldset>


    <div class="row">
        <div class="form-group col-lg-12">
            <input type="button" class="btn btn-primary" value="Guardar" onclick="">
            <a href="index.php?action=listAssignment" class="btn btn-default">Volver</a>
        </div>
    </div>
</form>
