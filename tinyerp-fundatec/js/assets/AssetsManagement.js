/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var assetManagement = {
    controlsId: {
        dtpAcquisition: "#dtpAcquisition",
        ddlCodCategory: "#codCategory",        
        date: ".date",
        frmNewAsset: "#frmNewAsset",
        frmEditAsset: "#frmEditAsset",
        txtCode: "#code",
        txtBrand: "#brand",
        txtPrice: "#price",
        ddlProvider: "#provider",
        txtSerialNum: "#serialNum",
        txtPlateNum: "#plateNum",
        txtDescription: "#description",
        txtWarrantyTerms: "#terms",
        dtpWarrantyExpiration: "#dtpExpiration",
        warrantyFile: "#warrantyFile"
    },
    messages: {
        assetSaveSuccess: "Activo guardado correctamente.",
    },
    fnInitializer: function () {
        //se inicializa todos los datepicker con el selector date
       $(assetManagement.controlsId.date).datepicker();
        //carga la tabla de activos
        $(assetManagement.actions.fnLoadExistingAssest());
        $(assetManagement.actions.fnAssignIdAssetOnOpenDialogToDelete());
       
    },
    actions: {
        pages: {
            frmNewAssest: "frmActivos.php"
        },
        fnLoadExistingAssest: function () {
            /*
             * Carga la tabla inicial de activos 
             **/
            var proccessCallback = function (result)
            {
               $(assetManagement.actions.fnLoadAsssetsResultOnTable(result));
            };
            //llamamos la funcion ajax
            var parameters = {'action': "requestAssets"};
            executeAjax('index.php', parameters, proccessCallback);
        },
        fnLoadExistingAssestById: function () {
            /*
             * Carga la tabla inicial de activos 
             **/
            var proccessCallback = function (result)
            {
               fnPopulateAssetForEdition(result);
            };
            //llamamos la funcion ajax
            var parameters = {'action': "getAssetById"};
            executeAjax('index.php', parameters, proccessCallback);
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
        fnValidateFrmEditAsset: function () {
            /*
             * Realiza la validación de los campos al crear un nuevo activo
             * @param {type} result
             * @returns {undefined}
             */

            return fnRequiredFields(assetManagement.controlsId.frmEditAsset);
        }
        ,
        fnLoadAsssetsResultOnTable: function(result) {
            var table = $("#AssetsMainTable");

            $.each(result, function (i, assetRow) {
                var row = '<tr>';
                row += '<td><input type="radio" id="' + assetRow.IdActivo + '" name="assetRow"></input></td>';
                //row += '<td>' + assetRow.Codigo + '</td>';
                row += '<td>' + assetRow.Categoria + '</td>';
                row += '<td>' + assetRow.Marca + '</td>';
                row += '<td>' + assetRow.PrecioAdquisicion + '</td>';
                row += '<td>' + assetRow.Proveedor + '</td>';
                row += '<td>' + assetRow.NumeroPlaca + '</td>';
                //row += '<td>' + assetRow.DesActivo + '</td>';
                row += '<td>' + assetRow.Estado + '</td>';
                row += '<td>' + assetRow.NumeroSerie + '</td>';
               // row += '<td>' + assetRow.FechaAdqusicion + '</td>';
               // row += '<td>' + assetRow.FechaRegistro + '</td>';
                //row+='<td> <p data-placement="top" data-toggle="tooltip" title="Editar"><button class="btn btn-primary btn-xs" data-title="Editar" data-toggle="modal" data-target="#edit"><span class="glyphicon glyphicon-pencil"></span></button></p> </a>';
                row += '<td><p data-placement="top" data-toggle="tooltip" title="Editar"><a href="index.php?action=editAssetForm&IdActivo='+assetRow.IdActivo+'" class="btn btn-primary btn-xs"> <span class="glyphicon glyphicon-pencil"></span> </a></p></td>'
                row += '<td><p data-placement="top" data-toggle="tooltip" title="Eliminar"><button class="btn btn-danger btn-xs" data-target="#modalEliminar" data-idAsset="'+assetRow.IdActivo+'" data-title="Eliminar" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span></button></p></td>';
                row += '</tr>';
                table.append(row);
            });
            $(assetManagement.actions.fnOnCheckAsset());
        },
        fnRedirectToAssetsIndex: function(){
            window.location.replace("/module/assets/index/index.php");
        },
        fnAssignIdAssetOnOpenDialogToDelete: function(){
            $('#modalEliminar').on('show.bs.modal', function(e) {
            //get data-id attribute of the clicked element
            var assetId = $(e.relatedTarget).data('idasset');
            
            //populate the textbox
            $(e.currentTarget).find('#deleteAssetButton').attr('data-idasset',assetId);
            
            });
        },
        fnOnCheckAsset:function(){
           
            $("input[type=radio][name=assetRow]").change(function(){
                 var checked = $(this).is(":checked");
                 if(checked===false){
                    $(".btnMenuPrincipal").addClass("disabled");
                }else{
                    $(".btnMenuPrincipal").removeClass("disabled");
                        $("#btnRepair").attr("href","index.php?action=consultRepairForm&idAsset="+$(this).attr("id"));
//                        $("#btnQuote").attr("href","index.php?action=newAssetForm&idAsset="+$(this).attr("id"));
//                        $("#btnAssignment").attr("href","index.php?action=newAssetForm&idAsset="+$(this).attr("id"));
//                        $("#btnPhysicalInventory").attr("href","index.php?action=newAssetForm&idAsset="+$(this).attr("id"));
                }                
            });
        }
    }
};



function Guardar() {

    var parameters = {'codigo': $('#codigo').val(), 'action': "insertAssest"};
    var fnProcess = function (data) {
        var response = data;
        alertify.success(response.UserMsj);
    }
    executeAjax('index.php', parameters, fnProcess);
}



