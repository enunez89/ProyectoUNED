var newAsset = {
     fnInitializer: function () {
          
        //llenamos el combo de categorias de activos
        $(assetManagement.actions.fnFillCategoryAssest());
        //llenamos el combo de proveedores de activos
        $(assetManagement.actions.fnFillProvidersAssest());
        
        $( ".date" ).datepicker( "option", "altField", "#dtpAcquisitionToSave" );

     },
     actions:{
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
                    alertify.success(assetManagement.messages.assetSaveSuccess);
                    $(assetManagement.actions.fnRedirectToAssetsIndex);
                }
                //se envia a guardar
                executeAjax('index.php', parameters, fnProcess);
            }
        }
    }
};