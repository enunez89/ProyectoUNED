<script src="../../../js/general.js" type="text/javascript"></script>
<script type="text/javascript" src="../../../js/assets/AssetsManagement.js"></script>

<div class="page-header">
    <h1>Agregar Reparación</h1>
    <a href="index.php?action=consultRepair" class="btn btn-primary" >Volver</a>
</div>

<form class="form-group">
    <fieldset class="form-group">
        <div class="row">
            <div class="form-group col-lg-4">
                <label for="studioName">Nombre Taller</label>
                <input type="text" class="form-control" name="studioName" id="studioName" required="required" placeholder="Nombre Taller">
            </div>

            <div class="form-group col-lg-4">
                <label for="dtpDevolution">Fecha devolución</label>
                <input type="text" class="form-control date" name="dtpDevolution" id="dtpAcquisition">
            </div>

            <div class="form-group col-lg-4">
                <label>Cubierto por garantía</label>
                <div class="radio">
                    <label><input type="radio" name="covert" value="1">Si</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="covert" value="0">No</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-12">
                <label for="descRepair">Descripción</label>
                <textarea class="form-control" rows="3" name="descRepair" id="descRepair"></textarea>
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
            <input type="button" class="btn btn-primary" value="Guardar" onclick="Guardar();">
            <a href="index.php" class="btn btn-default">Volver</a>
        </div>
    </div>