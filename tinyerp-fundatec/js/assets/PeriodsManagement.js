var periodsManagement = {
    controlsId : {
        ddlStates : "#stade",
        frmNewPeriod : "#frmNewPeriod",
        frmEditPeriod: "#frmEditPeriod",
        txtDescription: "#description",
        dtpBegin: "#dtpBegin",
        dtpEnd: "#dtpEnd",
        periodIndexAction: "newPhysicalInventoryForm"
    },
     messages: {
        periodSavedSuccess: "Periodo guardado correctamente.",
        periodDeletedSuccess: "Periodo inactivado correctamente.",
        periodUpdatedSuccess: "Periodo editado correctamente."
    },
    fnIndexInitializer: function () {
        //carga la tabla de periodos
        $(periodsManagement.actions.fnLoadExistingPeriods());
       
    },
     fnAdditionInitializer: function () {

        //llenamos el combo de estados de los periodos
        $(periodsManagement.actions.fnFillPeriodStates());
    },
    fnEditionInitializer: function () {

        //llenamos el combo de estados de los periodos
        $(periodsManagement.actions.fnFillPeriodStates());
        
        //Se carga el objeto al formulario
         $(periodsManagement.actions.fnGetPeriodForEdition());
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
//                row += '<td><p data-placement="top" data-toggle="tooltip" title="Eliminar"><button class="btn btn-danger btn-xs" data-target="#modalEliminar" data-functiondelete="assetManagement.actions.fnDeleteAsset();" data-idtodelete="' + periodRow.IdPeriodo + '" data-idAsset="' + periodRow.IdPeriodo + '" data-title="Eliminar" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span></button></p></td>';
                row += '</tr>';
                table.append(row);
            });
            //$(assetManagement.actions.fnOnCheckAsset());
        },
        fnFillPeriodStates: function () {
            /*
             * Llena el combobox de categorias de activos.
             * @param {type} result
             * @returns {undefined}
             */

            //definimos la funcion luego del llamado ajax
            var proccessCallback = function (result)
            {
                //obtenemos el combo de categorias
                var selectControl = $(periodsManagement.controlsId.ddlStates);

                //recorremos el resultado y agregamos las opciones al comobo
                $.each(result, function (i, assetRow) {
                    var option = new Option(assetRow.Descripcion, assetRow.CodCatalogoValor);
                    selectControl.append(option);
                });
            };
            //llamamos la funcion ajax
            var parameters = {'action': "getAllPeriodStates"};
            executeAjax('index.php', parameters, proccessCallback);
        },
        fnValidateFrmNewPeriod: function () {
            /*
             * Realiza la validación de los campos al crear un nuevo periodo
             * @param {type} result
             * @returns {undefined}
             */

            return fnRequiredFields(periodsManagement.controlsId.frmNewPeriod);
        },
        fnValidateFrmEditPeriod: function () {
            /*
             * Realiza la validación de los campos al crear un nuevo periodo
             * @param {type} result
             * @returns {undefined}
             */

            return fnRequiredFields(periodsManagement.controlsId.frmEditPeriod);
        },
        fnSavePeriod: function () {
            if(periodsManagement.actions.fnValidateFrmNewPeriod()){
                
                var period = {
                    Description: $(periodsManagement.controlsId.txtDescription).val(),
                    EndDate: fnGetDateFormatDB($(periodsManagement.controlsId.dtpEnd).val()),
                    StartDate: fnGetDateFormatDB($(periodsManagement.controlsId.dtpBegin).val()),
                    StateCode: $(periodsManagement.controlsId.ddlStates).val()
                };
                
                 var parameters = {'period': period, 'action': "createPeriod"};
                var fnProcess = function (data) {
                    console.log(data);
                    alertify.success(periodsManagement.messages.periodSavedSuccess);
                    //assetManagement.actions.fnRedirectToAssetsIndex
                    //redirecciona a la pantalla de crear un nuevo activo por si 
                    //se quiere ingresar otro activo
                    fnRedirectToAction("frmListPeriod");
                }
                //se envia a guardar
                executeAjax('index.php', parameters, fnProcess);
            }
        },
        fnGetPeriodForEdition: function () {
            var urlParams = new URLSearchParams(window.location.search);
            var periodId = urlParams.get('IdPeriodo');

            var proccessCallback = function (result)
            {
                $(periodsManagement.actions.fnPopulatePeriodForEdition(result));
            };
            //llamamos la funcion ajax
            var parameters = {'action': "getPeriodById", 'IdPeriodo': periodId};
            executeAjax('index.php', parameters, proccessCallback);
        },
        fnPopulatePeriodForEdition: function (result) {
            result = result[0];
            $(periodsManagement.controlsId.txtDescription).val(result.Descripcion);
            $(periodsManagement.controlsId.ddlStates).val(result.CodEstadoPeriodo);        
            var fechaInicio = assetManagement.actions.fnFormatStringDateToCustomFormat(result.FechaInicio, "DD/MM/YYYY");
            $(periodsManagement.controlsId.dtpBegin).datepicker('setDate', fechaInicio);
            var fechaFin = assetManagement.actions.fnFormatStringDateToCustomFormat(result.FechaFinal, "DD/MM/YYYY");
            $(periodsManagement.controlsId.dtpEnd).datepicker('setDate', fechaFin);

        },
        fnEditPeriod: function(){
            var urlParams = new URLSearchParams(window.location.search);
            var IdPeriodo = urlParams.get('IdPeriodo');
            if (periodsManagement.actions.fnValidateFrmEditPeriod()) { 
            var period = {
                IdPeriod: IdPeriodo,
                Description: $(periodsManagement.controlsId.txtDescription).val(),
                StateCode: $(periodsManagement.controlsId.ddlStates).val(),
                StartDate: fnGetDateFormatDB($(periodsManagement.controlsId.dtpBegin).val()),
                EndDate: fnGetDateFormatDB($(periodsManagement.controlsId.dtpBegin).val())
            }

                //formamos los parametros a enviar
                var parameters = {'period': period, 'action': "editPeriod"};
                var fnProcess = function (data) {
                    console.log(data);
                    alertify.success(periodsManagement.messages.periodUpdatedSuccess);
                    var actionIndex = periodsManagement.controlsId.periodIndexAction;
                    $(periodsManagement.actions.fnRedirectToPeriodIndex(actionIndex));
                }
                //se envia a guardar
                executeAjax('index.php', parameters, fnProcess);
            }
        },
         fnRedirectToPeriodIndex: function(action){
            window.location.replace("/module/assets/index/index.php?action="+action);
        }
    }
};

