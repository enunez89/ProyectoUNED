//Administracion de Activos

var assetManagement = {
    controlsId: {
        dtpAcquisition: "#dtpAcquisition",
        dtpAcquisitionToSave : "#dtpAcquisitionToSave",
        ddlCodCategory: "#codCategory",        
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
        warrantyFile: "#warrantyFile",
        moneyField: ".money"
    },
    messages: {
        assetSavedSuccess: "Activo guardado correctamente.",
        assetDeletedSuccess: "Activo inactivado correctamente.",
        assetUpdatedSuccess: "Activo editado correctamente."
    },
    fnIndexInitializer: function () {
        
        //carga la tabla de activos
        $(assetManagement.actions.fnLoadExistingAssest());
        //
        $(assetManagement.actions.fnFillProvidersAssest());
        //asigna valores para el modal de eliminar
        $(deleteModalManagement.actions.fnAssignValueToDeleteOnOpenDeleteDialog());
    },
    fnEditionInitializer: function () {
          
        //llenamos el combo de categorias de activos
        $(assetManagement.actions.fnFillCategoryAssest());
        
        //llenamos el combo de proveedores de activos
        $(assetManagement.actions.fnFillProvidersAssest());
        //Carga el activo por Id (URL)
        $(assetManagement.actions.fnGetAssetForEdition());
        //formato de dtp
        $(assetManagement.actions.fnFormatDatetimePickerToAlternativeFieldAssets());
        //mascaraDeMontos
        $(assetManagement.actions.fnFormatMoneyEdit()); 
     },
    fnAdditionInitializer: function () {
          
        //llenamos el combo de categorias de activos
        $(assetManagement.actions.fnFillCategoryAssest());
        //llenamos el combo de proveedores de activos
        $(assetManagement.actions.fnFillProvidersAssest());
        //formato de dtp
        $(assetManagement.actions.fnFormatDatetimePickerToAlternativeFieldAssets());
        //mascaraDeMontos
        $(assetManagement.actions.fnFormatMoney());       
     },
    actions: {
        pages: {
            frmNewAssest: "frmActivos.php"
        },
        /////////////////CONSULTA//////////////////////
        fnLoadExistingAssest: function () {
            /*
             * Carga la tabla inicial de activos 
             **/
            var proccessCallback = function (result)
            {
               $(assetManagement.actions.fnLoadAsssetsResultOnTable(result));
            };
            var parameters = {
                'action': "requestAssets"
            };
            executeAjax('index.php', parameters, proccessCallback);
        },
        fnLoadAsssetsResultOnTable: function(result) {
            /* 
            * funcion para cargar el resultado del ajax en tabla HTML
            */
            var table = $("#AssetsMainTable");

            $.each(result, function (i, assetRow) {
                var row = '<tr>';
                row += '<td><input type="radio" id="' + assetRow.IdActivo + '" name="assetRow"></input></td>';
                row += '<td>' + assetRow.Categoria + '</td>';
                row += '<td>' + assetRow.Marca + '</td>';
                row += '<td>' + assetRow.PrecioAdquisicion + '</td>';
                row += '<td>' + assetRow.Proveedor + '</td>';
                row += '<td>' + assetRow.NumeroPlaca + '</td>';
                row += '<td>' + assetRow.Estado + '</td>';
                row += '<td>' + assetRow.NumeroSerie + '</td>';
                row += '<td>' + $(assetManagement.actions.fnFormatStringDateToCustomFormat(assetRow.FechaAdqusicion,"DD/MM/YYYY")) + '</td>';
                row += '<td><p data-placement="top" data-toggle="tooltip" title="Editar"><a href="index.php?action=editAssetForm&IdActivo='+assetRow.IdActivo+'" class="btn btn-primary btn-xs"> <span class="glyphicon glyphicon-pencil"></span> </a></p></td>'
                row += '<td><p data-placement="top" data-toggle="tooltip" title="Eliminar"><button class="btn btn-danger btn-xs" data-target="#modalEliminar" data-functiondelete="assetManagement.actions.fnDeleteAsset();" data-idtodelete="'+assetRow.IdActivo+'" data-idAsset="'+assetRow.IdActivo+'" data-title="Eliminar" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span></button></p></td>';
                row += '</tr>';
                table.append(row);
            });
            $(assetManagement.actions.fnOnCheckAsset());
        },
        /////////////////AGREGAR//////////////////////
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
                    FechaAdqusicion: $(assetManagement.controlsId.dtpAcquisitionToSave).val(),
                    Garantia: warranty
                }
                
                
                //formamos los parametros a enviar
                var parameters = {'asset': asset, 'action': "createAsset"};
                var fnProcess = function (data) {
                    console.log(data);
                    alertify.success(assetManagement.messages.assetSavedSuccess);
                    $(assetManagement.actions.fnRedirectToAssetsIndex);
                }
                //se envia a guardar
                executeAjax('index.php', parameters, fnProcess);
            }
        },
        /////////////////EDITAR//////////////////////
        fnLoadExistingAssestById: function () {
            /*
             * Carga un activo por Id
             **/
            var proccessCallback = function (result)
            {
               fnPopulateAssetForEdition(result);
            };
            //llamamos la funcion ajax
            var parameters = {'action': "getAssetById"};
            executeAjax('index.php', parameters, proccessCallback);
        },
        fnValidateFrmEditAsset: function () {
            /*
             * Realiza la validación de los campos al crear un nuevo activo
             * @param {type} result
             * @returns {undefined}
             */

            if (assetManagement.actions.fnValidateFrmEditAsset()) {

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
                console.log(asset.FechaAdqusicion);
                //formamos los parametros a enviar
                var parameters = {'asset': asset, 'action': "createAsset"};
                var fnProcess = function (data) {
                    console.log(data);
                    alertify.success(assetManagement.messages.assetSaveSuccess);

                }
                //se envia a guardar
                executeAjax('index.php', parameters, fnProcess);
            }
            return fnRequiredFields(assetManagement.controlsId.frmEditAsset);
        },
        fnGetAssetForEdition: function(){
             var urlParams = new URLSearchParams(window.location.search);
             var assetId = urlParams.get('IdActivo');
             
            var proccessCallback = function (result)
            {
               $(assetManagement.actions.fnPopulateAssetForEdition(result));
            };
            //llamamos la funcion ajax
            var parameters = {'action': "getAssetById", 'IdAsset': assetId};
            executeAjax('index.php', parameters, proccessCallback);
         },
        fnPopulateAssetForEdition: function(result){
             result = result[0];            
            $(assetManagement.controlsId.txtCode).val(result.Codigo);
            $(assetManagement.controlsId.ddlCodCategory).val(result.IdCategoria);
            $(assetManagement.controlsId.txtBrand).val(result.Marca);
            $(assetManagement.controlsId.txtPrice).val(result.PrecioAdquisicion).trigger('mask');
            $(assetManagement.controlsId.ddlProvider).val(result.IdProveedor);
            $(assetManagement.controlsId.txtSerialNum).val(result.NumeroSerie);
            $(assetManagement.controlsId.txtPlateNum).val(result.NumeroPlaca);
            var fechaEdicion = assetManagement.actions.fnFormatStringDateToCustomFormat(result.FechaAdqusicion,"DD/MM/YYYY");
            $(assetManagement.controlsId.dtpAcquisition).val(fechaEdicion);
            //formato de dtp
        $(assetManagement.actions.fnFormatDatetimePickerToAlternativeFieldAssets());
            $(assetManagement.controlsId.txtDescription).val(result.DesActivo);

         },
        fnSaveEditedAsset: function () {
            /**
             * Envia a guardar un nuevo activo.
             * @param {type} result
             * @returns {undefined}
             */

            //validamos los campos requeridos
           // if (assetManagement.actions.fnValidateFrmEditAsset()) {
                
                //obtenemos los datos de la garantia
                var warranty = {
                    FechaVencimiento: $(assetManagement.controlsId.dtpWarrantyExpiration).val(),
                    Condiciones: $(assetManagement.controlsId.txtWarrantyTerms).val(),                    
                }
                
                var urlParams = new URLSearchParams(window.location.search);
                var assetId = urlParams.get('IdActivo');
                  //obtenemoos los daos del activoa guardar
                 var fechaFormateada = assetManagement.actions.fnFormatStringDateToCustomFormat($(assetManagement.controlsId.dtpAcquisition).val(),"YYYY-MM-DD");
                
                var asset = {
                    IdActivo: assetId,
                    Codigo: $(assetManagement.controlsId.txtCode).val().trim(),
                    CodCategoria: $(assetManagement.controlsId.ddlCodCategory).val(),
                    Marca: $(assetManagement.controlsId.txtBrand).val(),
                    PrecioAdquisicion: $(assetManagement.controlsId.txtPrice).val(),
                    IdProveedor: $(assetManagement.controlsId.ddlProvider).val(),
                    NumeroSerie: $(assetManagement.controlsId.txtSerialNum).val(),
                    NumeroPlaca: $(assetManagement.controlsId.txtPlateNum).val(),
                    DesActivo: $(assetManagement.controlsId.txtDescription).val(),
                    FechaAdqusicion:fechaFormateada,
                    Garantia: warranty
                }
                
                
                //formamos los parametros a enviar
                var parameters = {'asset': asset, 'action': "editAsset"};
                var fnProcess = function (data) {
                    console.log(data);
                    alertify.success(assetManagement.messages.assetUpdatedSuccess);
                    $(assetManagement.actions.fnRedirectToAssetsIndex);
                }
                //se envia a guardar
                executeAjax('index.php', parameters, fnProcess);
           // }
        },
        
        /////////////////ELIMINAR//////////////////////
        fnDeleteAsset: function(){
           var idAsset = $("#valueToDelete").val();
           var proccessCallback = function (result)
           {
                alertify.success(assetManagement.messages.assetDeletedSuccess);
              $(assetManagement.actions.fnRedirectToAssetsIndex);
           };
           //llamamos la funcion ajax
           var parameters = {'action': "deleteAsset", 'IdAsset': idAsset};
           executeAjax('index.php', parameters, proccessCallback);
        },
        /////////////////UTILITARIOS//////////////////////
        fnFormatDatetimePickerToAlternativeFieldAssets(){
            $(assetManagement.controlsId.dtpAcquisition).datepicker({ 
            dateFormat: 'dd/mm/yy',
            altField  : assetManagement.controlsId.dtpAcquisitionToSave,
            altFormat : 'yy/mm/dd'
         });
        },
        fnRedirectToAssetsIndex: function(){
            window.location.replace("/module/assets/index/index.php");
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
            * funcion para cargar todos los proveedores
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
            var parameters = {'action': "getAllProviders"};
            executeAjax('index.php', parameters, proccessCallback);
        },
        fnOnCheckAsset:function(){
        /* 
        * funcion para asignar el action y el id de activo a los botones del menu
        */
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
        },
        fnFormatMoney: function(){
         $(assetManagement.controlsId.moneyField).maskMoney({
            thousands:'.', 
            decimal:',', 
            allowZero:false,
            allowNegative:false
        });
        },
        fnFormatMoneyEdit: function(){
         $(assetManagement.controlsId.moneyField).maskMoney({
            thousands:'.', 
            decimal:',', 
            allowZero:false,
            allowNegative:false
        });
        },
        fnFormatStringDateToCustomFormat: function(dateString, format){
        return moment(dateString).format(format);
        }
    }
};



