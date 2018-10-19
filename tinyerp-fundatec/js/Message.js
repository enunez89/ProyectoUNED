var DIV_PARENT = ".main-content";
var AlertaSesion = (function() {

    function removeAlert() {
        $(".alertMsj").remove();
    }

    function crear(msj) {
        removeAlert();
        var alert = '<div class="alert alert-success alert-dismissable alertMsj"><button type="button" class="close" data-dismiss="alert">&times;</button>' + msj + '</div>';
        $(DIV_PARENT).prepend(alert);
        return true;
    }

    function autoHide() {
        setTimeout(removeAlert, 1500);
    }

    function setParent(parent) {
        if (parent !== undefined) {
            DIV_PARENT = parent;
        }else{
            DIV_PARENT = ".main-content";
        }
    }

    return {
        mostrar: function(msj, parent) {
            setParent(parent);
            crear(msj);
        },
        mostrarAutoHide: function(msj, parent) {
            setParent(parent);
            crear(msj);
            autoHide();
        },
        mostrarError: function(msj, parent) {
            setParent(parent);
            crear(msj);
            $(".alertMsj").attr("class", "alert alert-danger alert-dismissable alertMsj");
        }
    };
})();