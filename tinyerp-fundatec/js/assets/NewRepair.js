var newRepair = {
    fnInitializer: function () {
        //datepickers
         $(repairsManagement.controlsId.dtpDevolutionToShow).datepicker({ 
            dateFormat: 'dd/mm/yy',
            altField  : '#dtpDevolutionToSave',
            altFormat : 'yy/mm/dd'
         });

        var idAsset = $(repairsManagement.actions.fnGetAssetIdFromURL());
        idAsset = idAsset.selector;
         var buttonToIndex = $(repairsManagement.controlsId.btnReturnToRepairIndex);
         buttonToIndex = buttonToIndex.selector;
         $(repairsManagement.actions.fnSetIdAssetForRepairActions(buttonToIndex,idAsset));
    },
     actions:{
        fnSaveNewRepair: function () {
            /**
             * Envia a guardar un nuevo activo.
             * @param {type} result
             * @returns {undefined}
             */

            //validamos los campos requeridos
            //if (assetManagement.actions.fnValidateFrmNewAsset()) {
            var idAsset = $(repairsManagement.actions.fnGetAssetIdFromURL());
            var coveredByWarranty = 0;
             if($(repairsManagement.controlsId.radioCovert).is(':checked')) { 
                 coveredByWarranty = 1; 
             }         
                //obtenemoos los daos del activoa guardar
                var repair = {
                    AssetId: idAsset,
                    StudioName: $(repairsManagement.controlsId.txtStudioName).val(),
                    DevolutionDate: $(repairsManagement.controlsId.dtpDevolutionToSave).val(),
                    CoverByWarranty: coveredByWarranty,
                    Description: $(repairsManagement.controlsId.txtDescription).val()
                };
                
                
                //formamos los parametros a enviar
                var parameters = {'repair': repair, 'action': "createRepair"};
                var fnProcess = function (data) {
                    console.log(data);
                    alertify.success(assetManagement.messages.assetSaveSuccess);
                    var actionIndex = repairsManagement.controlsId.repairIndexAction;
                    $(repairsManagement.actions.fnRedirectToRepairsIndex(actionIndex,idAsset));
                };
                //se envia a guardar
                executeAjax('index.php', parameters, fnProcess);
            }     
    }
};