/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var deleteModalManagement={
    actions:{
        fnAssignValueToDeleteOnOpenDeleteDialog: function(){
            $('#modalEliminar').on('show.bs.modal', function(e) {
                var idToDelete = $(e.relatedTarget).data('idtodelete');
                var functionDelete = $(e.relatedTarget).data('functiondelete');
//                //populate the textbox
                $('#valueToDelete').val(idToDelete);
                $(e.currentTarget).find('#deleteButton').attr('onclick',functionDelete);
            });
        }
    }
};