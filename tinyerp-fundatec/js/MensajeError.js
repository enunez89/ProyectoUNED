var MensajeError = (function() {
    var CLASE_ERROR = "error-actual";
    var contador = 0;
    var campos = [];
    function darFocusCampo(selector) {
        $(selector).addClass(CLASE_ERROR);
        $(selector).focus();
    }

    function crearVentana(texto, selector) {
        if (texto.length === 0) {
            return;
        }
        var idVentana = "mensaje-error-" + contador;
        var ventanaHTML = "<div id='" + idVentana + "' class='alert alert-danger' role='alert'>" + texto + "</div>";
        $(selector).parent().after(ventanaHTML);
        contador++;
        guardarIdVentana(idVentana);
    }

    function guardarIdVentana(idventana) {
        campos.push(idventana);
    }

    function darFormatoSelector(selector) {
        var nuevoSelector = selector;
        if (nuevoSelector.indexOf("#") !== 0 && nuevoSelector.indexOf(".") !== 0) {
            nuevoSelector = "#" + selector; //asumir que es el id
        }

        return nuevoSelector;
    }

    return {
        mostrar: function(opciones) {
            $(".alert").remove();
            opciones = opciones || {};
            opciones.mensaje = opciones.mensaje || "";
            opciones.id = opciones.id || "";

            if (opciones.id === "") {
                return;
            }
            opciones.id = darFormatoSelector(opciones.id);
            crearVentana(opciones.mensaje, opciones.id);
            darFocusCampo(opciones.id);
        },
        limpiar: function() {
            for (var i = 0; i < campos.length; i++) {
                $("#" + campos[i]).remove();
            }

            $("." + CLASE_ERROR).each(function() {
                $(this).removeClass(CLASE_ERROR);
            });

            campos = [];
        }
    };
})();
