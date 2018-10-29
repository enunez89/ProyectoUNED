/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
//se inicializa el forms
    assetManagement.fnInitializer();
});

var assetManagement = {
    controlsId: {
        dtpAcquisition: "#dtpAcquisition",
        ddlCodCategory: "#codCategory",        
        date: ".date",
        frmNewAsset: "#frmNewAsset",
        txtCode: "#code",
        txtBrand: "#brand",
        txtPrice: "#price",
        ddlProvider: "#provider",
        txtSerialNum: "#serialNum",
        txtPlateNum: "#plateNum",
        txtDescription: "#description",
        txtWarrantyTerms: "#terms",
        dtpWarrantyExpiration: "#dtpExpiration",
        warrantyFile: "#warrantyFile",
    },
    messages: {
        assetSaveSuccess: "Activo guardado correctamente.",
    },
    fnInitializer: function () {
        //se inicializa todos los datepicker con el selector date
        $(assetManagement.controlsId.date).datepicker();

        //carga la tabla de activos
        $(assetManagement.actions.fnLoadExistingAssest());

        //llenamos el combo de categorias de activos
        $(assetManagement.actions.fnFillCategoryAssest());
        
        //llenamos el combo de proveedores de activos
        $(assetManagement.actions.fnFillProvidersAssest());

    },
    actions: {
        pages: {
            frmNewAssest: "frmActivos.php"
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

        fnFillCategoryAssest: function () {
            /*
             * Llena el combobox de categorias de activos.
             * @param {type} result
             * @returns {undefined}
             */
                       
            //definimos la funcion luego del llamado ajax
            var proccessCallback = function (result)
            {
                //obtenemos el combo de categorias
                var selectControl = $(assetManagement.controlsId.ddlCodCategory);

                //recorremos el resultado y agregamos las opciones al comobo
                $.each(result, function (i, assetRow) {
                    var option = new Option(assetRow.DescCatalogoValor, assetRow.CodCatalogoValor);
                    selectControl.append(option);
                });
            };
            //llamamos la funcion ajax
            var parameters = {'action': "getAllCategoryAssest"};
            executeAjax('index.php', parameters, proccessCallback);
        },
        fnFillProvidersAssest: function () {
            /*
             * Llena el combobox de proveedores de activos.
             * @param {type} result
             * @returns {undefined}
             */
                       
            //definimos la funcion luego del llamado ajax
            var proccessCallback = function (result)
            {
                //obtenemos el combo de categorias
                var selectControl = $(assetManagement.controlsId.ddlProvider);

                //recorremos el resultado y agregamos las opciones al comobo
                $.each(result, function (i, assetRow) {
                    var option = new Option(assetRow.Nombre, assetRow.IdProveedor);
                    selectControl.append(option);
                });
            };
            //llamamos la funcion ajax
            var parameters = {'action': "getAllProviders"};
            executeAjax('index.php', parameters, proccessCallback);
        },

        fnValidateFrmNewAsset: function () {
            /*
             * Realiza la validación de los campos al crear un nuevo activo
             * @param {type} result
             * @returns {undefined}
             */

            return fnRequiredFields(assetManagement.controlsId.frmNewAsset);
        },

        fnSaveAsset: function () {
            /**
             * Envia a guardar un nuevo activo.
             * @param {type} result
             * @returns {undefined}
             */

            //validamos los campos requeridos
            if (assetManagement.actions.fnValidateFrmNewAsset()) {
                
                //obtenemos los datos de la garantia
                var warranty = {
                    FechaVencimiento: $(assetManagement.controlsId.dtpWarrantyExpiration).val(),
                    Condiciones: $(assetManagement.controlsId.txtWarrantyTerms).val(),                    
                }
                
                //obtenemoos los daos del activoa guardar
                var asset = {
                    Codigo: $(assetManagement.controlsId.txtCode).val().trim(),
                    CodCategoria: $(assetManagement.controlsId.ddlCodCategory).val(),
                    Marca: $(assetManagement.controlsId.txtBrand).val(),
                    PrecioAdquisicion: $(assetManagement.controlsId.txtPrice).val(),
                    IdProveedor: $(assetManagement.controlsId.ddlProvider).val(),
                    NumeroSerie: $(assetManagement.controlsId.txtSerialNum).val(),
                    NumeroPlaca: $(assetManagement.controlsId.txtPlateNum).val(),
                    DesActivo: $(assetManagement.controlsId.txtDescription).val(),
                    FechaAdqusicion: $(assetManagement.controlsId.dtpAcquisition).val(),
                    Garantia: warranty
                }
                
                
                //formamos los parametros a enviar
                var parameters = {'asset': asset, 'action': "creatAsset"};
                var fnProcess = function (data) {
                    var response = data;
                    alertify.success(assetManagement.messages.assetSaveSuccess);
                }
                //se envia a guardar
                executeAjax('index.php', parameters, fnProcess);
            }
        }
    }
}

function fnLoadAsssetsResultOnTable(result) {
    var table = $("#AssetsMainTable");

    $.each(result, function (i, assetRow) {
        var row = '<tr>';
        row += '<td><input type="checkbox" id=' + assetRow.IdActivo + '></input></td>';
        row += '<td>' + assetRow.Codigo + '</td>';
        row += '<td>' + assetRow.Categoria + '</td>';
        row += '<td>' + assetRow.Marca + '</td>';
        row += '<td>' + assetRow.PrecioAdquisicion + '</td>';
        row += '<td>' + assetRow.IdProveedor + '</td>';
        row += '<td>' + assetRow.NumeroPlaca + '</td>';
        row += '<td>' + assetRow.DesActivo + '</td>';
        row += '<td>' + assetRow.Estado + '</td>';
        row += '<td>' + assetRow.NumeroSerie + '</td>';
        row += '<td>' + assetRow.FechaAdqusicion + '</td>';
        row += '<td>' + assetRow.FechaRegistro + '</td>';
        //row+='<td> <p data-placement="top" data-toggle="tooltip" title="Editar"><button class="btn btn-primary btn-xs" data-title="Editar" data-toggle="modal" data-target="#edit"><span class="glyphicon glyphicon-pencil"></span></button></p> </a>';
        row += '<td><p data-placement="top" data-toggle="tooltip" title="Editar"><a href="index.php?action=editAsset" class="btn btn-primary btn-xs"> <span class="glyphicon glyphicon-pencil"></span> </a></p></td>'
        row += '<td><p data-placement="top" data-toggle="tooltip" title="Eliminar"><button class="btn btn-danger btn-xs" data-title="Eliminar" data-toggle="modal" data-target="#delete"><span class="glyphicon glyphicon-trash"></span></button></p></td>';
        row += '</tr>';
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
    var fnProcess = function (data) {
        var response = data;
        alertify.success(response.UserMsj);
    }
    executeAjax('index.php', parameters, fnProcess);
}



