var editAsset = {
     fnInitializer: function () {
          
        //llenamos el combo de categorias de activos
        $(assetManagement.actions.fnFillCategoryAssest());
        
        //llenamos el combo de proveedores de activos
        $(assetManagement.actions.fnFillProvidersAssest());
        
        $(editAsset.actions.fnGetAssetForEdition());

     },
     actions:{
         fnGetAssetForEdition: function(){
             var urlParams = new URLSearchParams(window.location.search);
             var assetId = urlParams.get('IdActivo');
             
            var proccessCallback = function (result)
            {
               $(editAsset.actions.fnPopulateAssetForEdition(result));
            };
            //llamamos la funcion ajax
            var parameters = {'action': "getAssetById", 'IdAsset': assetId};
            executeAjax('index.php', parameters, proccessCallback);
         },
        fnPopulateAssetForEdition: function(result){
             result = result[0];            
            $(assetManagement.controlsId.txtCode).val(result.Codigo);
            $(assetManagement.controlsId.ddlCodCategory).val(result.IdCategoria);
            $(assetManagement.controlsId.txtBrand).val(result.Marca);
            $(assetManagement.controlsId.txtPrice).val(result.PrecioAdquisicion);
            $(assetManagement.controlsId.ddlProvider).val(result.IdProveedor);
            $(assetManagement.controlsId.txtSerialNum).val(result.NumeroSerie);
            $(assetManagement.controlsId.txtPlateNum).val(result.NumeroPlaca);
            $(assetManagement.controlsId.dtpAcquisition).val(result.FechaAdqusicion);
            $(assetManagement.controlsId.txtDescription).val(result.DesActivo);

         },
        fnSaveEditedAsset: function () {
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
                
                var urlParams = new URLSearchParams(window.location.search);
                var assetId = urlParams.get('IdActivo');
             
                  //obtenemoos los daos del activoa guardar
                
                var asset = {
                    IdActivo: assetId,
                    Codigo: $(assetManagement.controlsId.txtCode).val().trim(),
                    CodCategoria: $(assetManagement.controlsId.ddlCodCategory).val(),
                    Marca: $(assetManagement.controlsId.txtBrand).val(),
                    PrecioAdquisicion: $(assetManagement.controlsId.txtPrice).val(),
                    IdProveedor: $(assetManagement.controlsId.ddlProvider).val(),
                    NumeroSerie: $(assetManagement.controlsId.txtSerialNum).val(),
                    NumeroPlaca: $(assetManagement.controlsId.txtPlateNum).val(),
                    DesActivo: $(assetManagement.controlsId.txtDescription).val(),
                    FechaAdqusicion: $(assetManagement.controlsId.dtpAcquisition).val(),
                    Garantia: warranty
                }
                
                
                //formamos los parametros a enviar
                var parameters = {'asset': asset, 'action': "editAsset"};
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
