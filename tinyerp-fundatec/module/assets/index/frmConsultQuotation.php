<h4 class="text-primary">
GESTIÓN ACTIVOS
</h4>
<h5 class="text-primary">
Cotizaciones
</h5>

<a href="index.php" class="btn btn-primary" >Volver</a>
<a id="newQuotation" href="index.php?action=newQuotationForm" class="btn btn-success" >Registrar cotización</a>
<hr/>
        
<table class="table" id="QuotationsMainTable">
    <thead>
        <tr>
            <th scope="col" >Id de cotización</th>
            <th scope="col">Proveedor</th>
            <th scope="col">Monto</th>
            <th scope="col">Editar</th>
            <th scope="col">Eliminar</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<?php
include('deleteModal.php');
