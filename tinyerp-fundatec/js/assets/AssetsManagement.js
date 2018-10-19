/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var assestManagement  = {
    button: {
        Guardar: function(){
            $.ajax({
            type: 'POST',
            url: 'index.php',
            dataType: 'json',
            data: {'codigo': $('#codigo').val().trim(), 'action': "insertAssest"},
            success: function (result) {
				alert("HOLA MUNDO" + result);
            }
        });
        }
    }
}

function Guardar() {
    $.ajax({
        type: 'POST',
        url: 'index.php',
        dataType: 'json',
        data: {'codigo': $('#codigo').val().trim(), 'action': "insertAssest"},
        success: function (result) {
            alertify.success("HOLA MUNDO" + result);
           window.location.href = "index.php";
        },
        error: function (error) {
            alertify.error(error);
        }
    });
}



