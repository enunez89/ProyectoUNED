<script type="text/javascript" src="../../../js/assets/QuotationManagement.js"></script>
<script type="text/javascript" src="../../../js/assets/DeleteModalManagement.js"></script>
<script type="text/javascript" src="../../../js/assets/URLSearchParams.js"></script>
<script type="text/javascript" src="../../../js/assets/AssetsManagement.js"></script>
<script type="text/javascript" src="../../../js/assets/jquery.maskMoney.js"></script>
<script src="../../../js/general.js" type="text/javascript"></script>
<script>
$(document).ready(function () {
//se inicializa el forms
    quotationManagement.fnIndexInitializer();
});
</script>

<div class="page-header">
    <h1>Gestionar cotizaciones</h1>
</div>

<a href="index.php" class="btn btn-primary" >Volver</a>
<a id="newQuotation" href="index.php?action=newQuotationForm" class="btn btn-success" >Registrar cotización</a>
<hr/>
        
<table class="table" id="QuotationsMainTable">
    <thead>
        <tr>
            <th scope="col" >Id de cotización</th>
            <th scope="col">Proveedor</th>
            <th scope="col">Monto</th>
            <th scope="col">Fecha vencimiento</th>
            <th scope="col">Editar</th>
            <th scope="col">Eliminar</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<input type="hidden" id="maskMoneySetter" class="money"/>
<?php
include('deleteModal.php');
