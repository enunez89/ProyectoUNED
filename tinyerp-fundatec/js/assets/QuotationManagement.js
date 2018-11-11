var quotationManagement = {
    controlsId: {
        mainTable: "#QuotationsMainTable",
        addQuotationBtn: "#newQuotation",
        ddlProvider:"#ddlProvider",
        tableAssignedAssets: "#AssetsAssignedTable",
        tableAssetsSearchResults:"#AssetsSearchResult",
        codeAsset :"#codeAsset",
        txtAmount :"#txtAmount"
    },
    messages: {
        quotationSavedSuccess: "Cotización de activo guardado correctamente.",
        quotationDeletedSuccess: "Cotización de activo eliminada correctamente.",
        quotationUpdatedSuccess: "Cotización de activo editada correctamente."
    },
     fnIndexInitializer: function () {
        
        //carga la tabla de activos
        $(quotationManagement.actions.fnLoadExistingQuotations());
        //se asgina el IdASset para las cotizaciones nevas
         var addQuotationButton = $(quotationManagement.controlsId.addQuotationBtn);
        $(quotationManagement.actions.fnSetIdAssetForQuotationActions(  addQuotationButton,
                                                                    assetManagement.actions.fnGetAssetIdFromURL())
                                                                );
//        $(assetManagement.actions.fnFillProvidersAssest());
//        //asigna valores para el modal de eliminar
//        $(deleteModalManagement.actions.fnAssignValueToDeleteOnOpenDeleteDialog());
       $(assetManagement.actions.fnFormatMoney());  
    },
    fnAdditionInitializer: function () {
                //llenamos el combo de proveedores de activos
        $(quotationManagement.actions.fnFillProvidersQuotation());
        $(assetManagement.actions.fnFormatMoney());
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

            $.each(result, function (i, resultRow) {
                var row = '<tr>';
                row += '<td>' + resultRow.IdCotizacion + '</td>';
                row += '<td>' + assetManagement.actions.fnMaskMoneyToText(resultRow.Monto) + '</td>';
                row += '<td>' + resultRow.NombreProveedor + '</td>';
                row += '<td><p data-placement="top" data-toggle="tooltip" title="Editar"><a href="index.php?action=editAssetForm&IdActivo='+resultRow.IdCotizacion+'" class="btn btn-primary btn-xs"> <span class="glyphicon glyphicon-pencil"></span> </a></p></td>'
                row += '<td><p data-placement="top" data-toggle="tooltip" title="Eliminar"><button class="btn btn-danger btn-xs" data-target="#modalEliminar" data-functiondelete="quotationManagement.actions.fnDeleteQuotation();" data-idtodelete="'+resultRow.IdCotizacion+'" data-idAsset="'+resultRow.IdCotizacion+'" data-title="Eliminar" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span></button></p></td>';
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
             var quotation = {
                    Id: 0,
                    Monto: $(quotationManagement.controlsId.txtAmount).maskMoney('unmasked')[0],
                    IdProveedor: $(quotationManagement.controlsId.ddlProvider).val(),
                    IdArchivoAdjunto : 5,
                    Assets: quotationManagement.actions.fnGetIdsFromTableAssignedAssets(idsEncontrados)
                }

                //formamos los parametros a enviar
                var parameters = {'quotation': quotation, 'action': "createQuotation"};
                var fnProcess = function (data) {
                    console.log(data);
                    alertify.success(quotationManagement.messages.quotationSavedSuccess);
                    //$(assetManagement.actions.fnRedirectToAssetsIndex);
                }
                //se envia a guardar
                executeAjax('index.php', parameters, fnProcess);
        }
    }    
};