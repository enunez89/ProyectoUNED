<h4 class="text-primary">
GESTIÓN PERIODO TOMA FISICA
</h4>
<h5 class="text-primary">
Lista de Periodos de Toma Física
</h5>

<a href="index.php" class="btn btn-primary" >Volver</a>
<a id="btnPeriod" href="index.php?action=newPeriodForm" class="btn btn-primary btnMenuPrincipal" >Registrar Periódo</a>
<hr/>
        
<table class="table" id="PeriodMainTable">
    <thead>
        <tr>
            <th scope="col">Descripción</th>
            <th scope="col">Fecha Inicio</th>
            <th scope="col">Fecha Fin</th>
            <th scope="col">Editar</th>
            <th scope="col">Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Toma Física I trimestre 2017</td>
            <td>01/01/2017</td>
            <td>31/03/2017</td>
            <td><p data-placement="top" data-toggle="tooltip" title="Editar"><a href="" class="btn btn-primary btn-xs"> <span class="glyphicon glyphicon-pencil"></span> </a></p></td>
            <td><p data-placement="top" data-toggle="tooltip" title="Eliminar"><button class="btn btn-danger btn-xs" data-target="#modalEliminar" data-functiondelete="" data-idtodelete="" data-idAsset="" data-title="Eliminar" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span></button></p></td>
        </tr>
        <tr>
            <td>Toma Física II trimestre 2017</td>
            <td>01/04/2017</td>
            <td>30/05/2017</td>
            <td><p data-placement="top" data-toggle="tooltip" title="Editar"><a href="" class="btn btn-primary btn-xs"> <span class="glyphicon glyphicon-pencil"></span> </a></p></td>
            <td><p data-placement="top" data-toggle="tooltip" title="Eliminar"><button class="btn btn-danger btn-xs" data-target="#modalEliminar" data-functiondelete="" data-idtodelete="" data-idAsset="" data-title="Eliminar" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span></button></p></td>
        </tr>
       <tr>
            <td>Toma Física Extraordinaria</td>
            <td>01/06/2017</td>
            <td>09/07/2017</td>
            <td><p data-placement="top" data-toggle="tooltip" title="Editar"><a href="" class="btn btn-primary btn-xs"> <span class="glyphicon glyphicon-pencil"></span> </a></p></td>
            <td><p data-placement="top" data-toggle="tooltip" title="Eliminar"><button class="btn btn-danger btn-xs" data-target="#modalEliminar" data-functiondelete="" data-idtodelete="" data-idAsset="" data-title="Eliminar" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span></button></p></td>
        </tr>
    </tbody>
</table>
<?php
include('deleteModal.php');