/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
//se inicializa el forms
    assestManagement.fnInitializer();
});

var assestManagement = {
    controlsId: {
        dtpAcquisition: "#dtpAcquisition",
    },
    fnInitializer: function () {
        //se inicializa el datepicker fecha adquisicion
        $(assestManagement.controlsId.dtpAcquisition).datepicker();


    },
    actions: {
        pages: {
            frmNewAssest: "frmActivos.php"
        },
        fnLoadFrmNewAssest: function () {
            /*
             * Carga el forms para crear un nuevo activo 
             **/

            //redirecciona a la pagina del form nuevo activo
            //window.location.href = assestManagement.actions.pages.frmNewAssest;

            $.ajax({
                type: 'POST',
                url: 'index.php',
                dataType: 'json',
                data: {'action': "nuevo"},
                success: function (result) {
                },
                error: function (error) {
                    console.log(error);
                    alertify.error(error);
                }
            });
        }
    }
}


function Guardar() {
    /*$.ajax({
        type: 'POST',
        url: 'index.php',
        dataType: 'json',
        data: {'codigo': $('#codigo').val(), 'action': "insertAssest"},
        success: function (result) {
            alertify.success("Guardado correctamente");
        },
        error: function (error) {
            alertify.error("Ha ocurrido un error");
        }
    });*/
    var parameters = {'codigo': $('#codigo').val(), 'action': "insertAssest"};
    var fnProcess = function(data){
        var response = data;
        alertify.success(response.UserMsj);
    }
    executeAjax('index.php', parameters, fnProcess );
}



