<script src="../../../js/general.js" type="text/javascript"></script>
<script type="text/javascript" src="../../../js/assets/AssetsManagement.js"></script>

<div class="page-header">
    <h1>Editar Activo</h1>
</div>

<form class="form-group">
    <fieldset class="form-group">
        <legend>Información Activo</legend>
        <div class="row">
            <div class="form-group col-lg-6">
                <label for="code">Código</label>
                <input type="text" class="form-control" name="code" id="code" required="required" placeholder="Código">
            </div>

            <div class="form-group col-lg-6">
                <label for="codCategory">Categoría</label>
                <select class="form-control" id="codCategory" name="codCategory">
                </select>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-6">
                <label for="brand">Marca</label>
                <input type="text" class="form-control" name="brand" id="brand" required="required" placeholder="Marca">
            </div>

            <div class="form-group col-lg-6">
                <label for="price">Precio Adquisición</label>
                <input type="number" class="form-control" name="price" id="price" required="required" placeholder="Precio Adquisición">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-6">
                <label for="provider">Proveedor</label>
                <select class="form-control" id="provider" name="provider">
                    <option>Seleccione</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
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
                <input type="text" class="form-control date" name="dtpAcquisition" id="dtpAcquisition">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-12">
                <label for="description">Descripción</label>
                <textarea class="form-control" rows="3" name="description" id="description"></textarea>
            </div>
        </div>

    </fieldset>


    <div class="row">
        <div class="form-group col-lg-12">
            <input type="button" class="btn btn-primary" value="Guardar" onclick="Guardar();">
            <a href="index.php" class="btn btn-default">Volver</a>
        </div>
    </div>
</form>