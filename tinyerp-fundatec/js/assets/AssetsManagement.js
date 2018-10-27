/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
//se inicializa el forms
    assestManagement.fnInitializer();
});

var assestManagement = {
    controlsId: {
        dtpAcquisition: "#dtpAcquisition",
        ddlCodCategory: "#codCategory",
        dtpExpiration: "#dtpExpiration",
        date: ".date",
    },
    fnInitializer: function () {
        //se inicializa todos los datepicker con el selector date
        $(assestManagement.controlsId.date).datepicker();
        
        //carga la tabla de activos
        $(assestManagement.actions.fnLoadExistingAssest());

        //llenamos el combo de categorias de activos
        //assestManagement.actions.fnFillCategoryAssest();

    },
    actions: {
        pages: {
            frmNewAssest: "frmActivos.php"
        },
        fnLoadFrmNewAssest: function () {
            /*
             * Carga el forms para crear un nuevo activo 
             **/

            $.ajax({
                type: 'POST',
                url: 'index.php',
                dataType: 'text',
                data: {'action': "nuevo"},
                success: function (result) {
                    $("body").empty();
                    $("body").append(result);
                },
                error: function (error) {
                    console.log(error.Message);
                    alertify.error(error);
                }
            });
        },
        fnLoadExistingAssest: function () {
            /*
             * Carga la tabla inicial de activos 
             **/

            $.ajax({
                type: 'POST',
                url: 'index.php',
                dataType: 'json',
                data: {'action': "requestAssets"},
                success: function (result) {
                   fnLoadAsssetsResultOnTable(result);
                },
                error: function (error) {
                     console.log(error.responseText);
                    alertify.error(error.responseText);
                }
            });
        },
        fnFillCategoryAssest: function(){
            /*
             * Llena el combobox de categorias de activos.
             * @param {type} result
             * @returns {undefined}
             */
            
            //definimos la funcion luego del llamado ajax
            var proccessCallback = function(result)
            {
                //obtenemos el combo de categorias
                var selectControl = $(assestManagement.controlsId.ddlCodCategory);
                
                //recorremos el resultado y agregamos las opciones al comobo
                $.each(result, function(i, assetRow) {
                    var option = new Option(DescCatalogoValor, assetRow.CodCatalogoValor);
                    selectControl.append(option);
                });                
            }
            
            
            //llamamos la funcion ajax
            var parameters = {'action': "getAllCategoryAssest"};
            executeAjax('index.php', parameters, proccessCallback );
            
            /*$.ajax({
                type: 'POST',
                url: 'index.php',
                dataType: 'json',
                data: parameters,
                success: function (result) {
                   proccessCallback(result);
                },
                error: function (error) {
                     console.log(error.responseText);
                    alertify.error(error.responseText);
                }
            });*/
            
            
        }
    }
}

function fnLoadAsssetsResultOnTable (result){
    var table= $("#AssetsMainTable");

    $.each(result, function(i, assetRow) {
        var row='<tr>';
        row+='<td><input type="checkbox" id=' + assetRow.IdActivo + '></input></td>';
        row+='<td>' + assetRow.Codigo + '</td>';
        row+='<td>' + assetRow.Categoria + '</td>';
        row+='<td>' + assetRow.Marca + '</td>';
        row+='<td>' + assetRow.PrecioAdquisicion + '</td>';
        row+='<td>' + assetRow.IdProveedor + '</td>';
        row+='<td>' + assetRow.NumeroPlaca + '</td>';
        row+='<td>' + assetRow.DesActivo + '</td>';
        row+='<td>' + assetRow.Estado + '</td>';
        row+='<td>' + assetRow.NumeroSerie + '</td>';
        row+='<td>' + assetRow.FechaAdqusicion + '</td>';
        row+='<td>' + assetRow.FechaRegistro + '</td>';
        //row+='<td> <p data-placement="top" data-toggle="tooltip" title="Editar"><button class="btn btn-primary btn-xs" data-title="Editar" data-toggle="modal" data-target="#edit"><span class="glyphicon glyphicon-pencil"></span></button></p> </a>';
        row+='<td><p data-placement="top" data-toggle="tooltip" title="Editar"><a href="index.php?action=editAsset" class="btn btn-primary btn-xs"> <span class="glyphicon glyphicon-pencil"></span> </a></p></td>'
        row+='<td><p data-placement="top" data-toggle="tooltip" title="Eliminar"><button class="btn btn-danger btn-xs" data-title="Eliminar" data-toggle="modal" data-target="#delete"><span class="glyphicon glyphicon-trash"></span></button></p></td>';
        row+='</tr>';
        table.append(row);
    });

}
        
function Guardar() {
    /*$.ajax({
        type: 'POST',
        url: 'index.php',
        dataType: 'json',
        data: {'codigo': $('#codigo').val(), 'action': "insertAssest"},
        success: function (result) {
            alertify.success("Guardado correctamente");
        },
        error: function (error) {
            alertify.error("Ha ocurrido un error");
        }
    });*/
    var parameters = {'codigo': $('#codigo').val(), 'action': "insertAssest"};
    var fnProcess = function(data){
        var response = data;
        alertify.success(response.UserMsj);
    }
    executeAjax('index.php', parameters, fnProcess );
}



