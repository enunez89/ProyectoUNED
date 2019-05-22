var assignmentsManagement = {
    controlsId: {
        mainTable: "#AssignmentMainTable",
        txtId: "#txtId",
        lblPersona: "#lblPersona",
        ddlStates:"#ddlStates",
        dtpAssignmentStartDate: "#dtpAssignmentStartDate",
        dtpAssignmentDevolutionDate: "#dtpAssignmentDevolutionDate",
        assignmentIndexAction: "listAssignment",
        frmNewAssignment: "#frmNewAssignment"
    },
    messages: {
        assigmentSavedSuccess: "Asignación de activo guardada correctamente.",
        assigmentDeletedSuccess: "Asignación de activo eliminada correctamente.",
        assigmentUpdatedSuccess: "Asignación de activo editada correctamente."
    },
    fnIndexInitializer: function () {
          $(assignmentsManagement.actions.fnLoadExistingAssignments());
        
    },
    fnAdditionInitializer: function () {
                //llenamos el combo de proveedores de activos
        $(assignmentsManagement.actions.fnFillCategoriesAssignment());
        $(assignmentsManagement.controlsId.txtId).on("change",function(){
            $(assignmentsManagement.controlsId.lblPersona).val("");            
        });
    },
    actions: {
        fnLoadExistingAssignments: function () {
            /*
             * Carga la tabla inicial de activos 
             **/
            var proccessCallback = function (result)
            {
               $(assignmentsManagement.actions.fnLoadAssignmentsResultOnTable(result));
            };
            var parameters = {
                'action': "requestAssignments"
            };
            executeAjax('index.php', parameters, proccessCallback);
        },
        fnLoadAssignmentsResultOnTable: function(result) {
            /* 
            * funcion para cargar el resultado del ajax en tabla HTML
            */
            var table = $(assignmentsManagement.controlsId.mainTable);
            $.each(result, function (i, resultRow) {
                var row = '<tr>';
                row += '<td>' + resultRow.IdAsignacion + '</td>';
                row += '<td>' + assetManagement.actions.fnFormatStringDateToCustomFormat(resultRow.FechaAsignacion,"DD/MM/YYYY") + '</td>'; 
                row += '<td>' + resultRow.identificacion + '</td>';
                row += '<td>' + resultRow.nombrecompleto + '</td>';
                row += '<td>' + resultRow.CategoriaDevolucion + '</td>';
                row += '<td>' + assetManagement.actions.fnFormatStringDateToCustomFormat(resultRow.FechaDevolucion,"DD/MM/YYYY") + '</td>'; 
                row += '<td><p data-placement="top" data-toggle="tooltip" title="Editar"><a href="index.php?action=editAssignmentForm&IdAsignacion='+resultRow.IdAsignacion+'" class="btn btn-primary btn-xs"> <span class="glyphicon glyphicon-pencil"></span> </a></p></td>'
                row += '</tr>';
                table.append(row);
            });
        },
         fnFillCategoriesAssignment: function () {
            /* 
             * funcion para cargar todos los proveedores
             */
            //definimos la funcion luego del llamado ajax
            var proccessCallback = function (result)
            {
                //obtenemos el combo de categorias
                var selectControl = $(assignmentsManagement.controlsId.ddlStates);
                //recorremos el resultado y agregamos las opciones al comobo
                $.each(result, function (i, assetRow) {
                    var option = new Option(assetRow.DescCatalogoValor,assetRow.CodCatalogoValor);
                    selectControl.append(option);
                });
            };
             //llamamos la funcion ajax
            var parameters = {'action': "getAllCategoriesAssignment"};
            executeAjax('index.php', parameters, proccessCallback);
        },
         fnFindResponsable: function () {
            /*
             * Carga la tabla inicial de activos 
             **/
            var identificacionDigitada = $(assignmentsManagement.controlsId.txtId).val();
            
             $(assignmentsManagement.controlsId.lblPersona).text("");
             $("#MensajeResponsable").remove();
             
             if(identificacionDigitada === ""){
                 assignmentsManagement.actions.fnMarkFieldAsRequired(assignmentsManagement.controlsId.txtId,"Debe digitar una identificación. ");
             }else{
                    var proccessCallback = function (result){
                        if (result === null){
                            assignmentsManagement.actions.fnMarkFieldAsRequired(assignmentsManagement.controlsId.txtId,"Responsable no encontrado. ");
                        }else{
                            $(assignmentsManagement.controlsId.lblPersona).val(result.nombrecompleto);
                            $(assignmentsManagement.controlsId.txtId).css('border','1px solid #ccc');
                        }
                    };
                    var parameters = {
                        'action': "findResponsableById",
                        'Id':identificacionDigitada
                    };
                    executeAjax('index.php', parameters, proccessCallback);
                }
        },
        fnMarkFieldAsRequired: function(field,textoError){
            $(field).css('border','1px solid rgb(185, 74, 72)');
            $(field).after('<span class="text-danger validationMessajeFor" id="MensajeResponsable"> ' + textoError + '</span>');
            
        },
        fnSaveNewAssignment: function(){
            var idsEncontrados = [];
            var idActivosAsignados = quotationManagement.actions.fnGetIdsFromTableAssignedAssets(idsEncontrados);
            if (assignmentsManagement.actions.fnValidateFrmNewAssignment()) {
             var newAssignment = {
                    Id: 0,
                    IdentificacionResponsable: $(assignmentsManagement.controlsId.txtId).val(),
                    FechaAsignacion: fnGetDateFormatDB($(assignmentsManagement.controlsId.dtpAssignmentStartDate).val()),
                    FechaVencimiento: fnGetDateFormatDB($(assignmentsManagement.controlsId.dtpAssignmentDevolutionDate).val()),
                    IdArchivoAdjunto : "0",
                    Estado: $(assignmentsManagement.controlsId.ddlStates).val(),
                    Assets: idActivosAsignados
                };

                //formamos los parametros a enviar
                var parameters = {'assignment': newAssignment, 'action': "createAssignment"};
                var fnProcess = function (data) {
                    console.log(data);
                    alertify.success(assignmentsManagement.messages.assigmentSavedSuccess);
                    var actionIndex = assignmentsManagement.controlsId.assignmentIndexAction;
                    $(assignmentsManagement.actions.fnRedirectToIndex(actionIndex));
                }
                //se envia a guardar
                executeAjax('index.php', parameters, fnProcess);
            }
        },
        fnValidateFrmNewAssignment: function () {
            /*
             * Realiza la validación de los campos al crear un nuevo activo
             * @param {type} result
             * @returns {undefined}
             */
             
            return fnRequiredFields(assignmentsManagement.controlsId.frmNewAssignment);
        },
        fnRedirectToIndex: function(action){
            window.location.replace("/module/assets/index/index.php?action="+action);
        },
    }
};