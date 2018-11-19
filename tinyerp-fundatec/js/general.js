/**
 * Funcion para redireccionar una página hacia otra
 * @param {string} path
 */
function redirect(path) {
    location.href = path;
}

/**
 * Funcion para obtener una variable de URL
 * @param {string} name
 * @returns {String}
 */
function getURLParameter(name) {
    var url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
    if (!results)
        return null;
    if (!results[2])
        return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}


function wordInString(s, word) {
    return new RegExp('\\b' + word + '\\b', 'i').test(s);
}


function fullscreen(divID) {

    var idfull = "fullscreen";

    var HTML = '<div id="bodyscreen">';
    HTML += '<div id="fullscreen">';
    HTML += '<div>';
    HTML += '<input type="button" value="X" class="btnCloseFull btn btn-sm btn-danger pull-right">';
    HTML += '</div>';
    var content = $("#" + divID).html();
    HTML += content;
    HTML += '</div>';
    HTML += '</div>';

    $("body").prepend(HTML);


    $("#bodyscreen").css({
        'position': 'absolute',
        'width': $(window).width(),
        'height': $(window).height(),
        'z-index': 9999
    });

    $("#" + idfull).css({
        'position': 'relative',
        'width': ($(window).width() - 42) + "px",
        'height': ($(window).height() - 35) + "px",
        'overflow': 'auto',
        'box-shadow': '2px 2px 5px #bbb',
        'border': '1px solid #888',
        'left': '20px',
        'top': '10px',
        'padding': '20px',
        'background': '#ffffff'
    });

    $(".btnCloseFull").click(function () {
        $("#bodyscreen").remove();
    });

}

function buscarGlobal(event) {
    if (event.keyCode === 13) {
        var query = $("#text-search").val();
        var path = "../buscar/index.php?q=" + query;
        location.href = path;
    }
}

function verSubMenu(divid) {
    var estado = $("#" + divid).css("display");
    if (estado === "block") {
        $("#" + divid).slideUp("500");
    } else {
        $("#" + divid).slideDown("500");
    }
}

/*
 * Realiza un llamado ajax de tipo post genérico.
 * @param {string} url
 * @param {object} parameters
 * @param {function} fnSuccess
 * @param {string} dataType
 * @returns {undefined}
 */
function executeAjax(url, parameters, fnProcessResponse, dataType) {

    //configuración
    if (dataType === undefined) {
        dataType = 'json';
    }

    //llamado ajax
    $.ajax({
        type: 'POST',
        url: url,
        dataType: 'json',
        data: parameters,
        success: function (result) {
            //se ejecuta la función que procesa la respuesta
            //en caso de que el llamado ajax sea exitoso
            fnProcessResponse(result);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.responseText);
            //se muestra mensaje de error genérico
            alertify.error(genericMessages.msjError);
        }
    });/*.fail(function (xhr) {
     //se muestra mensaje de error genérico
     alertify.error(genericMessages.msjError);
     });*/
}

/*
 * Valida los campos requeridos de un form
 * @param {string} frmName
 * @returns {Boolean}
 */
function fnRequiredFields(frmName, showAlert) {
    try {

        fnRemoveAlertRequiredFields(frmName);
        var hasError = true;
        //Validar inputs
        $(frmName + " :input.requerido").each(function () {
            if (jQuery.trim($(this).val()) == '') {
                var nombreAtributo = $(this).parent().parent().find('.control-label').text();
                if (nombreAtributo == "") {
                    nombreAtributo = $(this).parent().find('label').text();
                }
                //se le quita los 2 puntos si tiene
                nombreAtributo = nombreAtributo.replace(":", "");

                $(this)
                        .after('<span class="text-danger validationMessajeFor"> El campo ' +
                                nombreAtributo +
                                ' es requerido.</span>');
                this.style.border = "1px solid #b94a48";
                hasError = false;
            }
        });

        //Validar Combos
        $(frmName + " :input.requeridoCombo").each(function () {
            if (jQuery.trim($(this).val()) == "0" || jQuery.trim($(this).val()) == '') {
                var nombreAtributo = $(this).parent().parent().find('.control-label').text();
                if (nombreAtributo == "") {
                    nombreAtributo = $(this).parent().find('label').text();
                }

                //se le quita los 2 puntos si tiene
                nombreAtributo = nombreAtributo.replace(":", "");

                $(this)
                        .after('<span class="text-danger validationMessajeFor"> El campo ' +
                                nombreAtributo +
                                ' es requerido.</span>');
                this.style.border = "1px solid #b94a48";
                hasError = false;
            }
        });

        //Validar checkBox
        var validarChk = false;
        var chkRequerido = true;
        var controlChek = "";
        $(frmName + " :input.ChkListRequerido").each(function () {
            validarChk = true;
            controlChek = $(this);
            if ($(this).is(':checked')) {
                chkRequerido = false;
            }
        });
        if (validarChk) {
            if (chkRequerido) {
                var nombreEtiqueta = controlChek.parent().parent().parent().parent().parent().parent().find('.control-label').text();
                controlChek.parent().parent().parent().parent().after('<span class="text-danger validationMessajeFor">' + msjAplicacion.msjChckListRequerido + '</span>');
                hasError = false;
            }
        }
        
        var validarTabla = false;
        var tablaRequerido = true;
        var controlTabla = "";
        $(frmName + " .tablaRequerido").each(function () {
            var numeroDeFilas = $(this).find("tbody tr").length;
            validarTabla = true;
            controlTabla = $(this);
            if (numeroDeFilas > 0) {
                tablaRequerido = false;
            }
        });
        if (validarTabla) {
            if (tablaRequerido) {
                var nombreEtiqueta = $("#leyendaParaTabla").text();
                controlTabla.parent().parent().parent().after('<span class="text-danger validationMessajeFor">Debe agregar al menos un elemento a los ' + nombreEtiqueta + '</span>');
                hasError = false;
                //alert("tabla lenght ");
            }
        }
        
      


        if (hasError == false) {
            if (showAlert == undefined || showAlert) {
                //mostramos el mensaje de alerta
                alertify.error(genericMessages.msjRequiredFileds);
            }
        }
        return hasError;

    } catch (err) {
        alertify.error(genericMessages.msjError);
    }
}

/*
 * Quita el mensaje de alerta de los campos
 * @param {string} frmName
 * @returns {undefined}
 */
function fnRemoveAlertRequiredFields(frmName) {
    //constantes
    var cssLblMessageValidation = "validationMessajeFor";

    var formulario = document.getElementById(frmName.substring(1, frmName.lengh));
    if (formulario != null || formulario != undefined) {
        var span = formulario.getElementsByClassName(cssLblMessageValidation);
        if (span != null) {
            $(span).each(function () {
                //si es input
                var input = $(this).parent().find('input');
                //Si es dropdown
                if ($(this).parent().find('select').length > 0) {
                    input = $(this).parent().find('select');
                }

                input.css('border-color', '#bdbdbd');
                input.css('border-top', 'none');
                input.css('border-left', 'none');
                input.css('border-right', 'none');

                $(this).remove();
            });
        }
    }
}

/**
 * Funcion que inicializa un campo datepicker
 * @returns {undefined}
 */
function fnInitDatePicker() {
    //se inicializa todos los datepicker con el selector date
    $('.date').datepicker({
        dateFormat: 'dd/mm/yy',
        altFormat: 'yy/mm/dd'
    });
}


function fnGetDateFormatDB(dateValue) {
    /*
     * Obtiene una fecha en formato yyyy/mm/dd
     * dateValue Valor de la fecha
     */
if(dateValue != ""){
    var arrDate = dateValue.split('/');

    var dateFormated = arrDate[2] + '/' + arrDate[1] + '/' + arrDate[0];

    return dateFormated;
    }else{
        return "";
    }
}

function fnRedirectToAction(action) {
    /*
     * Función que redirecciona a una acción hacia el controller de activos.
     */
    if (action != '') {
        window.location.href = "index.php?action=" + action;
    } else {
        window.location.href = "index.php";
    }
}

/*
 * Variable que cuenta con mensajes genéricos que se le muestran al usuario
 */
var genericMessages = {
    msjError: "Ha ocurrido un error, por favor comuniquese con el administrador.",
    msjRequiredFileds: "Existen campos requeridos.",
}


$(document).ready(function () {
    //se inicializa las fechas
    fnInitDatePicker();
});

