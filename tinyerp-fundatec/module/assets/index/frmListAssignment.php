<div class="page-header">
    <h1>Gestionar asignaciones de activos</h1>
</div>

<a href="index.php" class="btn btn-primary" >Volver</a>
<a id="btnAssignment" href="index.php?action=newAssignmentForm" class="btn btn-primary btnMenuPrincipal" >Registrar Asignación</a>
<hr/>
        
<table class="table" id="AssignmentMainTable">
    <thead>
        <tr>
            <th scope="col" >Responsable</th>
            <th scope="col">Fecha Asignación</th>
            <th scope="col">Estado</th>
            <th scope="col">Editar</th>
            <th scope="col">Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>José Perez Picón</td>
            <td>23/09/2018</td>
            <td>Asignado</td>
            <td><p data-placement="top" data-toggle="tooltip" title="Editar"><a href="" class="btn btn-primary btn-xs"> <span class="glyphicon glyphicon-pencil"></span> </a></p></td>
            <td><p data-placement="top" data-toggle="tooltip" title="Eliminar"><button class="btn btn-danger btn-xs" data-target="#modalEliminar" data-functiondelete="" data-idtodelete="" data-idAsset="" data-title="Eliminar" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span></button></p></td>
        </tr>
        <tr>
            <td>Andres Rodriguez Obando</td>
            <td>20/07/2018</td>
            <td>Prestado</td>
            <td><p data-placement="top" data-toggle="tooltip" title="Editar"><a href="" class="btn btn-primary btn-xs"> <span class="glyphicon glyphicon-pencil"></span> </a></p></td>
            <td><p data-placement="top" data-toggle="tooltip" title="Eliminar"><button class="btn btn-danger btn-xs" data-target="#modalEliminar" data-functiondelete="" data-idtodelete="" data-idAsset="" data-title="Eliminar" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span></button></p></td>
        </tr>
        <tr>
            <td>Brian Ruiz Gonzales</td>
            <td>09/11/2018</td>
            <td>Devuelto</td>
            <td><p data-placement="top" data-toggle="tooltip" title="Editar"><a href="" class="btn btn-primary btn-xs"> <span class="glyphicon glyphicon-pencil"></span> </a></p></td>
            <td><p data-placement="top" data-toggle="tooltip" title="Eliminar"><button class="btn btn-danger btn-xs" data-target="#modalEliminar" data-functiondelete="" data-idtodelete="" data-idAsset="" data-title="Eliminar" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span></button></p></td>
        </tr>
    </tbody>
</table>
<?php
include('deleteModal.php');
