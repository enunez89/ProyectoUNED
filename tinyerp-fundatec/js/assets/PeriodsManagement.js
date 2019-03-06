var periodsManagement = {
    controlsId : {},
    fnIndexInitializer: function () {
        //carga la tabla de periodos
        $(periodsManagement.actions.fnLoadExistingPeriods());
    },
    actions: {
        /////////////////CONSULTA//////////////////////
        fnLoadExistingPeriods: function () {
            /*
             * Carga la tabla inicial de periodos 
             **/
            var proccessCallback = function (result)
            {
                $(periodsManagement.actions.fnLoadPeriodsResultOnTable(result));
            };
            var parameters = {
                'action': "getAllPeriods"
            };
            executeAjax('index.php', parameters, proccessCallback);
        },
         fnLoadPeriodsResultOnTable: function (result) {
            /* 
             * funcion para cargar el resultado del ajax en tabla HTML
             */
            var table = $("#PeriodMainTable");

            $.each(result, function (i, periodRow) {
                var row = '<tr>';
//                row += '<td><input type="radio" id="' + assetRow.IdActivo + '" name="assetRow"></input></td>';
                row += '<td>' + periodRow.Descripcion + '</td>';
                row += '<td>' + assetManagement.actions.fnFormatStringDateToCustomFormat(periodRow.FechaInicio,"DD/MM/YYYY") + '</td>'; 
                row += '<td>' + assetManagement.actions.fnFormatStringDateToCustomFormat(periodRow.FechaFinal,"DD/MM/YYYY") + '</td>'; 
                row += '<td>' + periodRow.Estado + '</td>';
                row += '<td><p data-placement="top" data-toggle="tooltip" title="Editar"><a href="index.php?action=editPeriodForm&IdPeriodo=' + periodRow.IdPeriodo + '" class="btn btn-primary btn-xs"> <span class="glyphicon glyphicon-pencil"></span> </a></p></td>'
                row += '<td><p data-placement="top" data-toggle="tooltip" title="Eliminar"><button class="btn btn-danger btn-xs" data-target="#modalEliminar" data-functiondelete="assetManagement.actions.fnDeleteAsset();" data-idtodelete="' + periodRow.IdPeriodo + '" data-idAsset="' + periodRow.IdPeriodo + '" data-title="Eliminar" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span></button></p></td>';
                row += '</tr>';
                table.append(row);
            });
            //$(assetManagement.actions.fnOnCheckAsset());
        }
    }
};

