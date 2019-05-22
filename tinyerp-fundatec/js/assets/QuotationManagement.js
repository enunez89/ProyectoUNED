var quotationManagement = {
    controlsId: {
        mainTable: "#QuotationsMainTable",
        addQuotationBtn: "#newQuotation",
        ddlProvider:"#ddlProvider",
        tableAssignedAssets: "#AssetsAssignedTable",
        tableAssetsSearchResults:"#AssetsSearchResult",
        codeAsset :"#codeAsset",
        txtAmount :"#txtAmount",
        quotationIndexAction: "consultQuotationForm",
        dtpDueDate: "#dtpDueDate",
        btnReturnToQuotationIndex : "#btnReturnToQuotationIndex",
        frmNewQuotation: "#frmNewQuotation",
        frmExistingtQuotation:"#frmExistingtQuotation"
    },
    messages: {
        quotationSavedSuccess: "Cotización de activo guardada correctamente.",
        quotationDeletedSuccess: "Cotización de activo eliminada correctamente.",
        quotationUpdatedSuccess: "Cotización de activo editada correctamente."
    },
    fnIndexInitializer: function () {
        
        //carga la tabla de activos
        $(quotationManagement.actions.fnLoadExistingQuotations());
        //se asgina el IdASset para las cotizaciones nevas
//         var addQuotationButton = $(quotationManagement.controlsId.addQuotationBtn);
//        $(quotationManagement.actions.fnSetIdAssetForQuotationActions(  addQuotationButton,
//                                                                    assetManagement.actions.fnGetAssetIdFromURL())
//                                                                );
       $(deleteModalManagement.actions.fnAssignValueToDeleteOnOpenDeleteDialog());
       $(assetManagement.actions.fnFormatMoney());  
    },
    fnAdditionInitializer: function () {
                //llenamos el combo de proveedores de activos
        $(quotationManagement.actions.fnFillProvidersQuotation());
        $(assetManagement.actions.fnFormatMoneyEdit());
        
    },
    fnEditionInitializer: function () {      
        $(quotationManagement.actions.fnFillProvidersQuotation());
        $(quotationManagement.actions.fnGetQuotationForEdition());
        $(assetManagement.actions.fnFormatMoneyEdit());
     },
    actions: {
        fnLoadExistingQuotations: function () {
            /*
             * Carga la tabla inicial de activos 
             **/
            var IdAsset = $(assetManagement.actions.fnGetAssetIdFromURL());
            IdAsset = IdAsset.selector;
            var proccessCallback = function (result)
            {
               $(quotationManagement.actions.fnLoadQuotationsResultOnTable(result));
            };
            var parameters = {
                'action': "requestQuotations",
                'IdAsset': IdAsset
            };
            executeAjax('index.php', parameters, proccessCallback);
        },
        fnLoadQuotationsResultOnTable: function(result) {
            /* 
            * funcion para cargar el resultado del ajax en tabla HTML
            */
            var table = $(quotationManagement.controlsId.mainTable);
            var idAsset = $(assetManagement.actions.fnGetAssetIdFromURL());
            idAsset = idAsset.selector;
            $.each(result, function (i, resultRow) {
                var row = '<tr>';
                row += '<td>' + resultRow.IdCotizacion + '</td>';
                row += '<td>' + resultRow.NombreProveedor + '</td>';
                row += '<td>' + assetManagement.actions.fnMaskMoneyToText(resultRow.Monto) + '</td>';
                row += '<td>' + assetManagement.actions.fnFormatStringDateToCustomFormat(resultRow.FechaVencimiento,"DD/MM/YYYY") + '</td>'; 
                row += '<td><p data-placement="top" data-toggle="tooltip" title="Editar"><a href="index.php?action=editQuotationForm&IdCotizacion='+resultRow.IdCotizacion+'&idAsset='+idAsset+'" class="btn btn-primary btn-xs"> <span class="glyphicon glyphicon-pencil"></span> </a></p></td>'
                row += '<td><p data-placement="top" data-toggle="tooltip" title="Eliminar"><button class="btn btn-danger btn-xs" data-target="#modalEliminar" data-functiondelete="quotationManagement.actions.fnDeleteQuotation();" data-idtodelete="'+resultRow.IdCotizacion+'" data-idAsset="'+idAsset+'" data-title="Eliminar" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span></button></p></td>';
                row += '</tr>';
                table.append(row);
            });
            $(assetManagement.actions.fnFormatMoney());
            $(assetManagement.controlsId.moneyField).trigger("mask");
        },
        fnSetIdAssetForQuotationActions: function(targetButton, idAsset){
            var currentHref = $(targetButton).attr("href");
            var currentHrefModified = currentHref + "&idAsset=" + idAsset.toString();            
            $(targetButton).attr("href", currentHrefModified);
        },
        fnFillProvidersQuotation: function () {
            /* 
             * funcion para cargar todos los proveedores
             */
            //definimos la funcion luego del llamado ajax
            var proccessCallback = function (result)
            {
                //obtenemos el combo de categorias
                var selectControl = $(quotationManagement.controlsId.ddlProvider);

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
        fnFindAssetsByValue: function () {
            /* 
             * funcion para cargar todos los activos por criterios
             */
            //valor a buscar:
             var valuetosearch = $(quotationManagement.controlsId.codeAsset).val();
             
            //definimos la funcion luego del llamado ajax
            var proccessCallback = function (result)
            {
                //obtenemos el combo de categorias
                var resultsTable = $(quotationManagement.controlsId.tableAssetsSearchResults);
               resultsTable.find("tbody").empty();
                $.each(result, function (i, assetRow) {
                var row = '<tr>';
                row += '<td>' + assetRow.IdActivo + '</td>';
                row += '<td>' + assetRow.Codigo + '</td>';
                row += '<td>' + assetRow.DesActivo + '</td>';
                row += '<td><input type="button" class="btn btn-primary" value="Asignar"';
                row+=  'onclick="quotationManagement.actions.fnAssignAsset('+ assetRow.IdActivo +','.concat("'")+ assetRow.Codigo.concat("','")+ assetRow.DesActivo.concat("'")+ ');"></td>';
                row += '</tr>';
                resultsTable.append(row);
            });
            
            };
             //llamamos la funcion ajax
            var parameters = {'action': "getAssetsToAssign", 'valuetosearch': valuetosearch};
            executeAjax('index.php', parameters, proccessCallback);
        },
        fnAssignAsset: function(id,codigo,descripcion){
            //alert("asignando: " +id +','+ codigo +','+descripcion);
            var encontrado = quotationManagement.actions.fnValidateIfAssignedAssetExists(id);
            if(!encontrado){
            var assignedAssetsTable = $(quotationManagement.controlsId.tableAssignedAssets);
            var row = '<tr>';
            row += '<td>' + id + '</td>';
            row += '<td>' + codigo + '</td>';
            row += '<td>' + descripcion + '</td>';
            row += '<td><input type="button" class="btn btn-danger" value="Desasignar"';
            row+=  'onclick="quotationManagement.actions.fnUnassignAsset(this);"></td>';
            row += '</tr>';
            assignedAssetsTable.append(row);
        }else{
                 alertify.error("El activo ya se encuentra asignado");
        }
            
        },
        fnValidateIfAssignedAssetExists:function(id){
           var idsEncontrados = [];
            quotationManagement.actions.fnGetIdsFromTableAssignedAssets(idsEncontrados);
            var resultado= $.inArray(id.toString(),idsEncontrados);
            if (resultado != -1){
                return true;
            }else{
                return false;
            }    
        },
        fnUnassignAsset: function(btn){
            //alert("asignando: " +id +','+ codigo +','+descripcion);
           var row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);
        },
        fnGetIdsFromTableAssignedAssets: function(idsEncontrados){
        var filas= $(quotationManagement.controlsId.tableAssignedAssets + " tr ");
            if(filas.length > 1){
                $.each(filas, function (index) {
                    var columnas = $(this).children("td");
                    $.each(columnas, function (indexcolumnas, elemento) {
                        if(indexcolumnas == 0){
                            idsEncontrados.push($(elemento).text());
                        }
                    });
                });
            }
            return idsEncontrados;
        },
        fnSaveNewQuotation: function(){
            var idsEncontrados = [];
            var idActivosAsignados = quotationManagement.actions.fnGetIdsFromTableAssignedAssets(idsEncontrados);
            if (quotationManagement.actions.fnValidateFrmNewQuotation()) {
             var quotation = {
                    Id: 0,
                    Monto: $(quotationManagement.controlsId.txtAmount).maskMoney('unmasked')[0],
                    IdProveedor: $(quotationManagement.controlsId.ddlProvider).val(),
                    FechaVencimiento: fnGetDateFormatDB($(quotationManagement.controlsId.dtpDueDate).val()),
                    IdArchivoAdjunto : "0",
                    Assets: idActivosAsignados
                }

                //formamos los parametros a enviar
                var parameters = {'quotation': quotation, 'action': "createQuotation"};
                var fnProcess = function (data) {
                    console.log(data);
                    alertify.success(quotationManagement.messages.quotationSavedSuccess);
//                    var idAsset = $(assetManagement.actions.fnGetAssetIdFromURL());
//                    idAsset = idAsset.selector;
                    var actionIndex = quotationManagement.controlsId.quotationIndexAction;
                    $(quotationManagement.actions.fnRedirectToQuotationIndex(actionIndex));
                }
                //se envia a guardar
                executeAjax('index.php', parameters, fnProcess);
            }
        },
        fnRedirectToQuotationIndex: function(action){
            window.location.replace("/module/assets/index/index.php?action="+action);
        },
        fnGetQuotationForEdition: function(){
             var urlParams = new URLSearchParams(window.location.search);
             var IdCotizacion = urlParams.get('IdCotizacion');
             
            var proccessCallback = function (result)
            {
               $(quotationManagement.actions.fnPopulateQuotationForEdition(result));
            };
            //llamamos la funcion ajax
            var parameters = {'action': "getQuotationById", 'IdCotizacion': IdCotizacion};
            executeAjax('index.php', parameters, proccessCallback);
         },
        fnPopulateQuotationForEdition: function(result){
             var encabezado = result[0];            
            $(quotationManagement.controlsId.txtAmount).val(encabezado.Monto).trigger('mask');
            $(quotationManagement.controlsId.ddlProvider).val(encabezado.IdProveedor);
             var fechaEdicion = assetManagement.actions.fnFormatStringDateToCustomFormat(encabezado.FechaVencimiento, "DD/MM/YYYY");
            $(quotationManagement.controlsId.dtpDueDate).datepicker('setDate', fechaEdicion);
                       
             $.each(result, function (i, resultRow) {
               quotationManagement.actions.fnAssignAsset(resultRow.IdActivo, resultRow.Codigo, resultRow.DesActivo);
            });
            
             
                         
         },
        fnEditQuotation: function(){
            var idsEncontrados = [];
            var urlParams = new URLSearchParams(window.location.search);
            var IdCotizacion = urlParams.get('IdCotizacion');
            if (quotationManagement.actions.fnValidateFrmExistingQuotation()) { 
            var quotation = {
                Id: IdCotizacion,
                Monto: $(quotationManagement.controlsId.txtAmount).maskMoney('unmasked')[0],
                IdProveedor: $(quotationManagement.controlsId.ddlProvider).val(),
                IdArchivoAdjunto : 0,
                Assets: quotationManagement.actions.fnGetIdsFromTableAssignedAssets(idsEncontrados),
                FechaVencimiento: fnGetDateFormatDB($(quotationManagement.controlsId.dtpDueDate).val())
            }

                //formamos los parametros a enviar
                var parameters = {'quotation': quotation, 'action': "editQuotation"};
                var fnProcess = function (data) {
                    console.log(data);
                    alertify.success(quotationManagement.messages.quotationUpdatedSuccess);
                    var idAsset = $(assetManagement.actions.fnGetAssetIdFromURL());
                    idAsset = idAsset.selector;
                    var actionIndex = quotationManagement.controlsId.quotationIndexAction;
                    $(quotationManagement.actions.fnRedirectToQuotationIndex(actionIndex,idAsset));
                }
                //se envia a guardar
                executeAjax('index.php', parameters, fnProcess);
            }
        },
        fnDeleteQuotation: function(){
            
           var IdCotizacion = $("#valueToDelete").val();
           var proccessCallback = function (result)
           {
                alertify.success(quotationManagement.messages.quotationDeletedSuccess);
                window.location.reload();
           };
           //llamamos la funcion ajax
           var parameters = {'action': "deleteQuotation", 'IdCotizacion': IdCotizacion};
           executeAjax('index.php', parameters, proccessCallback);
        },
         fnValidateFrmNewQuotation: function () {
            /*
             * Realiza la validación de los campos al crear un nuevo activo
             * @param {type} result
             * @returns {undefined}
             */

            return fnRequiredFields(quotationManagement.controlsId.frmNewQuotation);
        },
         fnValidateFrmExistingQuotation: function () {
            /*
             * Realiza la validación de los campos al crear un nuevo activo
             * @param {type} result
             * @returns {undefined}
             */

            return fnRequiredFields(quotationManagement.controlsId.frmExistingtQuotation);
        },
    }    
};