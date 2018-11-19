var repairsManagement = {
    controlsId:{
        date:".date",
        txtStudioName: "#studioName",
        dtpDevolutionToShow: "#dtpDevolutionToShow",
        dtpDevolutionToSave: "#dtpDevolutionToSave",
        radioCovert: "#chkCovertTrue",
        radioCovertFalse: "#chkCovertFalse",
        txtDescription: "#descRepair",
        addRepairBtn:"#newRepair",
        repairIndexAction: "consultRepairForm",
        btnReturnToRepairIndex: "#btnReturnToRepairIndex",
        frmNewRepair:"#frmNewRepair",
        frmExistingRepair:"#frmExistingRepair"
    },
    messages:{
        repairSavedSuccess: "Reparación guardada correctamente.",
        repairDeletedSuccess: "Reparación eliminada correctamente.",
        repairUpdatedSuccess: "Reparación editada correctamente."
        
    },
    fnIndexInitializer: function(){
         //se cargan las reparaciones del activo
        $(repairsManagement.actions.fnLoadExistingRepairs());
        var addRepairButton = $(repairsManagement.controlsId.addRepairBtn);
        $(repairsManagement.actions.fnSetIdAssetForRepairActions(  addRepairButton,
                                                                    assetManagement.actions.fnGetAssetIdFromURL())
                                                                );
        $(deleteModalManagement.actions.fnAssignValueToDeleteOnOpenDeleteDialog());
    },
    fnAdditionInitializer: function () {
        //datePickers
        $(repairsManagement.actions.fnFormatDatetimePickerToAlternativeFieldRepairs());

        var idAsset = $(assetManagement.actions.fnGetAssetIdFromURL());
        idAsset = idAsset.selector;
         var buttonToIndex = $(repairsManagement.controlsId.btnReturnToRepairIndex);
         buttonToIndex = buttonToIndex.selector;
         $(repairsManagement.actions.fnSetIdAssetForRepairActions(buttonToIndex,idAsset));
    },
    fnEditionInitializer: function () {      
        $(repairsManagement.actions.fnGetRepairForEdition());
          //datePickers
        $(repairsManagement.actions.fnFormatDatetimePickerToAlternativeFieldRepairs());
        
        var idAsset = $(assetManagement.actions.fnGetAssetIdFromURL());
        idAsset = idAsset.selector;
         var buttonToIndex = $(repairsManagement.controlsId.btnReturnToRepairIndex);
         buttonToIndex = buttonToIndex.selector;
         $(repairsManagement.actions.fnSetIdAssetForRepairActions(buttonToIndex,idAsset));
     },
     actions: {
        /////////////////CONSULTA///////////////
        fnLoadExistingRepairs: function () {
            /*
             * Carga la tabla inicial de reparaciones de un activo 
             **/
            var assetId = $(assetManagement.actions.fnGetAssetIdFromURL());
            assetId = assetId.selector;
            var IdAsset = assetId;
            var proccessCallback = function (result)
            {
               $(repairsManagement.actions.fnLoadRepairsResultOnTable(result, assetId));
            };
            //llamamos la funcion ajax
            var parameters = {'action': "requestRepairs", 'IdAsset': IdAsset};
            executeAjax('index.php', parameters, proccessCallback);
        },
        fnLoadRepairsResultOnTable: function(result, assetId) {
            var table = $("#RepairsMainTable");

            $.each(result, function (i, repairRow) {
                if(repairRow.CubiertoPorGarantia ==="1"){
                    repairRow.CubiertoPorGarantia = "Sí";
                }else{
                    repairRow.CubiertoPorGarantia = "No";
                }
                var row = '<tr>';
                row += '<td>' + repairRow.IdReparacion + '</td>';  
                row += '<td>' + repairRow.DesReparacion + '</td>'; 
                row += '<td>' + repairRow.NombreTaller + '</td>'; 
                row += '<td>' + assetManagement.actions.fnFormatStringDateToCustomFormat(repairRow.FechaRegistro,"DD/MM/YYYY") + '</td>'; 
                row += '<td>' + assetManagement.actions.fnFormatStringDateToCustomFormat(repairRow.FechaDevolucion,"DD/MM/YYYY") + '</td>'; 
                row += '<td>' + repairRow.CubiertoPorGarantia + '</td>'; 
                row += '<td><p data-placement="top" data-toggle="tooltip" title="Editar"><a href="index.php?action=editRepairForm&IdRepair='+repairRow.IdReparacion+'&idAsset='+assetId+'" class="btn btn-primary btn-xs"> <span class="glyphicon glyphicon-pencil"></span> </a></p></td>';
                row += '<td><p data-placement="top" data-toggle="tooltip" title="Eliminar"><button class="btn btn-danger btn-xs" data-target="#modalEliminar" data-functiondelete="repairsManagement.actions.fnDeleteRepair();" data-idtodelete="'+repairRow.IdReparacion+'" data-title="Eliminar" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span></button></p></td>';
                row += '</tr>';
                table.append(row);
            });
        },
        /////////////////AGREGAR///////////////
        fnSaveNewRepair: function () {
            /**
             * Envia a guardar un nuevo activo.
             * @param {type} result
             * @returns {undefined}
             */

            //validamos los campos requeridos
            if (repairsManagement.actions.fnValidateFrmNewRepair()) {
                var idAsset = $(assetManagement.actions.fnGetAssetIdFromURL());
                idAsset = idAsset.selector;
                var coveredByWarranty = 0;
                 if($(repairsManagement.controlsId.radioCovert).is(':checked')) { 
                     coveredByWarranty = 1; 
                 }         
                    //obtenemoos los daos del activoa guardar
                    var repair = {
                        AssetId: idAsset,
                        StudioName: $(repairsManagement.controlsId.txtStudioName).val(),
                        DevolutionDate: fnGetDateFormatDB($(repairsManagement.controlsId.dtpDevolutionToShow).val()),
                        CoverByWarranty: coveredByWarranty,
                        Description: $(repairsManagement.controlsId.txtDescription).val(),
                        FileName: $(fileManagement.fnControlsId.hddFileName).val(),
                        FileType: $(fileManagement.fnControlsId.hddFileType).val()
                    };


                    //formamos los parametros a enviar
                    var parameters = {'repair': repair, 'action': "createRepair"};
                    var fnProcess = function () {
                        alertify.success(repairsManagement.messages.repairSavedSuccess);
                        var actionIndex = repairsManagement.controlsId.repairIndexAction;
                        $(repairsManagement.actions.fnRedirectToRepairsIndex(actionIndex,idAsset));
                    };
                    //se envia a guardar
                    executeAjax('index.php', parameters, fnProcess);
                }
            },
        ////////////////EDITAR/////////////////
        fnGetRepairForEdition: function(){
             var urlParams = new URLSearchParams(window.location.search);
             var IdRepair = urlParams.get('IdRepair');
             
            var proccessCallback = function (result)
            {
               $(repairsManagement.actions.fnPopulateRepairForEdition(result));
            };
            //llamamos la funcion ajax
            var parameters = {'action': "getRepairById", 'IdRepair': IdRepair};
            executeAjax('index.php', parameters, proccessCallback);
         },
        fnPopulateRepairForEdition: function(result){
             result = result[0];            
            $(repairsManagement.controlsId.txtStudioName).val(result.NombreTaller);
            $(repairsManagement.controlsId.dtpDevolutionToShow).val(assetManagement.actions.fnFormatStringDateToCustomFormat(result.FechaDevolucion,"DD/MM/YYYY"));
            $(repairsManagement.controlsId.txtDescription).val(result.DesReparacion);
           if(result.CubiertoPorGarantia === "1"){
                $(repairsManagement.controlsId.radioCovert).prop("checked", true);
            }else{
                $(repairsManagement.controlsId.radioCovertFalse).prop("checked", true);
            }
            
             //validamos si existe archivo
            if (result.URL !== '' && result.Extension !== '') {
                //enviamos a setear el href del boton para descargar el archivo
                fileManagement.fnDownloadFile(result.URL, result.Extension);
            }
             
         },
        fnSaveEditedRepair: function () {
            /**
             * Envia a guardar un nuevo activo.
             * @param {type} result
             * @returns {undefined}
             */

            //validamos los campos requeridos
            //if (assetManagement.actions.fnValidateFrmEditAsset()) {               
                var urlParams = new URLSearchParams(window.location.search);
                var IdRepair = urlParams.get('IdRepair');
                var idAsset = $(assetManagement.actions.fnGetAssetIdFromURL());
                idAsset = idAsset.selector;
                  //obtenemoos los daos del activoa guardar
                  if (repairsManagement.actions.fnValidateFrmExistingRepair()) {
                var coveredByWarranty = 0;
                if($(repairsManagement.controlsId.radioCovert).is(':checked')) { 
                    coveredByWarranty = 1; 
                }         
                //obtenemoos los daos del activoa guardar
                var repair = {
                    RepairId: IdRepair,
                    AssetId: idAsset,
                    StudioName: $(repairsManagement.controlsId.txtStudioName).val(),
                    DevolutionDate: $(repairsManagement.controlsId.dtpDevolutionToSave).val(),
                    CoverByWarranty: coveredByWarranty,
                    Description: $(repairsManagement.controlsId.txtDescription).val(),
                    FileName: $(fileManagement.fnControlsId.hddFileName).val(),
                    FileType: $(fileManagement.fnControlsId.hddFileType).val()
                };                
                //formamos los parametros a enviar
            var parameters = {'repair': repair, 'action': "editRepair"};
            var fnProcess = function (data) {
                console.log(data);
                alertify.success(repairsManagement.messages.repairUpdatedSuccess);
                var actionIndex = repairsManagement.controlsId.repairIndexAction;
                $(repairsManagement.actions.fnRedirectToRepairsIndex(actionIndex,idAsset));
            };
                //se envia a guardar
            executeAjax('index.php', parameters, fnProcess);
                  }
        },
        /////////////////ELIMINAR//////////////////////
        fnDeleteRepair: function(){
           var idRepair = $("#valueToDelete").val();
           var proccessCallback = function (result)
           {
                alertify.success(repairsManagement.messages.repairDeletedSuccess);
                window.location.reload();


           };
           //llamamos la funcion ajax
           var parameters = {'action': "deleteRepair", 'IdRepair': idRepair};
           executeAjax('index.php', parameters, proccessCallback);
        },
        /////////////////UTILITARIOS///////////
        fnSetIdAssetForRepairActions: function(targetButton, idAsset){
            var currentHref = $(targetButton).attr("href");
            var currentHrefModified = currentHref + "&idAsset=" + idAsset;            
            $(targetButton).attr("href", currentHrefModified);
        },
        fnRedirectToRepairsIndex: function(action, idAsset){
           // window.location.replace("/module/assets/index/index.php?action="+action+"&idAsset="+idAsset.toString());
            window.location.href = "index.php?action=" +action+"&idAsset="+idAsset.toString();
        },
        fnFormatDatetimePickerToAlternativeFieldRepairs: function(){
         $(repairsManagement.controlsId.dtpDevolutionToShow).datepicker({ 
            dateFormat: 'dd/mm/yy',
            altField  : '#dtpDevolutionToSave',
            altFormat : 'yy/mm/dd'
         });
     },
      fnValidateFrmNewRepair: function () {
            /*
             * Realiza la validación de los campos al crear un nuevo activo
             * @param {type} result
             * @returns {undefined}
             */

            return fnRequiredFields(repairsManagement.controlsId.frmNewRepair);
        },        
        fnValidateFrmExistingRepair: function () {
            /*
             * Realiza la validación de los campos al crear un nuevo activo
             * @param {type} result
             * @returns {undefined}
             */

            return fnRequiredFields(repairsManagement.controlsId.frmExistingRepair);
        }

    }
};


