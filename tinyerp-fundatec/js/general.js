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
    if (dataType == undefined) {
        dataType = 'json';
    }

    //llamado ajax
    $.ajax({
        type: 'POST',
        url: url,
        traditional: true,
        data: JSON.stringify(parameters),
        contentType: 'application/json;',
        dataType: dataType,
        cache: false,
        enctype: "multipart/form-data",
        converters: {'text json': true},
        success: function (data) {
            //se ejecuta la función que procesa la respuesta
            //en caso de que el llamado ajax sea exitoso
            fnProcessResponse(data);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            //se muestra mensaje de error genérico
            alertify.error(genericMessages.msjError);
        }
    }).fail(function (xhr) {
        //se muestra mensaje de error genérico
        alertify.error(genericMessages.msjError);
    });
}

/*
 * Variable que cuenta con mensajes genéricos que se le muestran al usuario
 */
var genericMessages = {
    msjError: "Ha ocurrido un error, por favor comuniquese con el administrados."
}     