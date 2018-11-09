var quotationManagement = {
    controlsId: {
        mainTable: "#QuotationsMainTable",
        addQuotationBtn: "#newQuotation"
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
    }
};