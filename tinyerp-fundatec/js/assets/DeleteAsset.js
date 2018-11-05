/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var deleteAsset= {
    actions:{
            fnDeleteAsset: function(){
            var idAsset = $("#deleteAssetButton").data('idasset');
            var proccessCallback = function (result)
            {
               $(assetManagement.actions.fnRedirectToAssetsIndex);
            };
            //llamamos la funcion ajax
            var parameters = {'action': "deleteAsset", 'IdAsset': idAsset};
            executeAjax('index.php', parameters, proccessCallback);
            }
    }  
};

