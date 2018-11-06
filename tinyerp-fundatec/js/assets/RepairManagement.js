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
        btnReturnToRepairIndex: "#btnReturnToRepairIndex"
    },
    messages:{},
    fnInitializer: function(){
         //se cargan las reparaciones del activo
         $(repairsManagement.actions.fnLoadExistingRepairs());
        
        var addRepairButton = $(repairsManagement.controlsId.addRepairBtn);
         var urlParams = new URLSearchParams(window.location.search);
         var idAsset = urlParams.get('idAsset');
         $(repairsManagement.actions.fnSetIdAssetForRepairActions(addRepairButton,idAsset));
    },
     actions: {
        fnLoadExistingRepairs: function () {
            /*
             * Carga la tabla inicial de reparaciones de un activo 
             **/
             var urlParams = new URLSearchParams(window.location.search);
             var assetId = urlParams.get('idAsset');
             
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
                row += '<td>' + repairRow.FechaRegistro + '</td>'; 
                row += '<td>' + repairRow.FechaDevolucion + '</td>'; 
                row += '<td>' + repairRow.CubiertoPorGarantia + '</td>'; 
                row += '<td><p data-placement="top" data-toggle="tooltip" title="Editar"><a href="index.php?action=editRepairForm&IdRepair='+repairRow.IdReparacion+'&idAsset='+assetId+'" class="btn btn-primary btn-xs"> <span class="glyphicon glyphicon-pencil"></span> </a></p></td>';
                row += '<td><p data-placement="top" data-toggle="tooltip" title="Eliminar"><button class="btn btn-danger btn-xs" data-target="#modalEliminarReparacion" data-idAsset="'+repairRow.IdReparacion+'" data-title="Eliminar" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span></button></p></td>';
                row += '</tr>';
                table.append(row);
            });
        },
        fnSetIdAssetForRepairActions: function(targetButton, idAsset){
            var currentHref = $(targetButton).attr("href");
            var currentHrefModified = currentHref + "&idAsset=" + idAsset.toString();            
            $(targetButton).attr("href", currentHrefModified);
        },
         fnGetAssetIdFromURL: function(){
            var urlParams = new URLSearchParams(window.location.search);
            var idAsset = urlParams.get('idAsset');
            return idAsset;
        },
        fnRedirectToRepairsIndex: function(action, idAsset){
            window.location.replace("/module/assets/index/index.php?action="+action+"&idAsset="+idAsset.toString());
        }  
    }
};


