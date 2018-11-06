var editRepair = {
     fnInitializer: function () {      
        $(editRepair.actions.fnGetRepairForEdition());
         $(repairsManagement.controlsId.dtpDevolutionToShow).datepicker({ 
            dateFormat: 'dd/mm/yy',
            altField  : '#dtpDevolutionToSave',
            altFormat : 'yy/mm/dd'
         });
     },
     actions:{
         fnGetRepairForEdition: function(){
             var urlParams = new URLSearchParams(window.location.search);
             var IdRepair = urlParams.get('IdRepair');
             
            var proccessCallback = function (result)
            {
               $(editRepair.actions.fnPopulateRepairForEdition(result));
            };
            //llamamos la funcion ajax
            var parameters = {'action': "getRepairById", 'IdRepair': IdRepair};
            executeAjax('index.php', parameters, proccessCallback);
         },
        fnPopulateRepairForEdition: function(result){
             result = result[0];            
            $(repairsManagement.controlsId.txtStudioName).val(result.NombreTaller);
            $(repairsManagement.controlsId.dtpDevolutionToShow).val(result.FechaDevolucion);
            $(repairsManagement.controlsId.txtDescription).val(result.DesReparacion);
           if(result.CubiertoPorGarantia === "1"){
                $(repairsManagement.controlsId.radioCovert).prop("checked", true);
            }else{
                $(repairsManagement.controlsId.radioCovertFalse).prop("checked", true);
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
                var idAsset = $(repairsManagement.actions.fnGetAssetIdFromURL());
                idAsset = idAsset.selector;
                  //obtenemoos los daos del activoa guardar
                
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
                    Description: $(repairsManagement.controlsId.txtDescription).val()
                };                
                //formamos los parametros a enviar
                var parameters = {'repair': repair, 'action': "editRepair"};
                var fnProcess = function (data) {
                    console.log(data);
                    alertify.success(assetManagement.messages.assetSaveSuccess);
                    var actionIndex = repairsManagement.controlsId.repairIndexAction;
                    $(repairsManagement.actions.fnRedirectToRepairsIndex(actionIndex,idAsset));
                };
                //se envia a guardar
                executeAjax('index.php', parameters, fnProcess);
            }
        //}
     }
};
