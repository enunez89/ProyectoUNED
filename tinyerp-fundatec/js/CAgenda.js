    function refrescar() {
        window.location.reload();
    }

    function actualizarFunciones() {
        $(".task").mouseenter(function () {
            $(this).find(".btnEdittask").css({opacity: 1});
        }).mouseleave(function () {
            $(this).find(".btnEdittask").css({opacity: 0});
        });
    }

    function openConvocatoria() {
        $("#modalConvocatoria").modal();
    }

    function enviarConvocatoria() {

        var id = $("#idsesion").val();
        var msj = $("#txtMensaje").val();
        $.ajax({
            url: 'index.php',
            type: 'post',
            data: {action: 'enviarConvocatoria', id: id, msj: msj},
            beforeSend: function () {
                $("#btnEnviarConvocatoria").attr("disabled", "disabled");
                $("#btnEnviarConvocatoria").html("Enviando...");
            },
            success: function (response) {
                if ($.trim(response) === '1') {
                    location.reload();
                }
            },
            error: function () {
                alert("Error al enviar la convocatoria");
            }
        });
    }
    
    function openInciso(ahref, id) {
        $(".tasksInciso *").remove();
        $("#modalArticulo").modal();
        var title = $(ahref).find(".txtArticulo").html();
        $("#txtEditArticulo").val(title);
        $("#modal-title-incisos").html("Articulo - " + title);
        $.ajax({
            url: 'index.php',
            type: 'post',
            dataType: 'json',
            data: {action: 'buscarIncisos', idArticulo: id},
            success: function (response) {
                var input = document.createElement("input");
                input.setAttribute("type", "hidden");
                input.setAttribute("id", "idArticulo");
                input.setAttribute("value", id);
                $(".tasksInciso").append(input);
                for (var i in response) {
                    $(".tasksInciso").append(crearLiInciso(response[i].id, response[i].nombre));
                    actualizarFunciones();
                }
            },
            error: function () {
                alert("Error al buscar los incisos");
            }
        });
    }

    function crearLiInciso(id, valor) {
        var li = document.createElement("li");
        li.setAttribute('class', 'task');
        var label = document.createElement("label");
        var hidden = document.createElement("input");
        hidden.setAttribute("type", "hidden");
        hidden.setAttribute("class", "idInciso");
        hidden.setAttribute("value", id);

        label.setAttribute('class', 'txtInciso');
        label.innerHTML = valor;
        var a = document.createElement("a");
        a.setAttribute('class', 'btnEdittask btn btn-default btn-xs pull-right');
        var onclick = "deleteInciso($(this)," + id + ")";
        a.setAttribute('onclick', onclick);
        var span = document.createElement("span");
        span.setAttribute('class', 'glyphicon glyphicon-trash');
        li.appendChild(label);
        li.appendChild(hidden);
        li.appendChild(a);
        a.appendChild(span);
        li.appendChild(a);
        return li;
    }

    function deleteInciso(ahref, id) {
        $.ajax({
            url: 'index.php',
            type: 'post',
            data: {action: 'eliminarInciso', idInciso: id},
            success: function (response) {
                if ($.trim(response) == 1) {
                    $(ahref).parent().css("display", "none");
                } else {
                    alert("Error al eliminar el inciso");
                }
            },
            error: function(xhr, status, error) {
                var err = JSON.parse(xhr.responseText);
                alert(err.Message);
            }
        });
    }
    
    function deleteArticulo(ahref, id) {
        $.ajax({
            url: 'index.php',
            type: 'post',
            data: {action: 'eliminarArticulo', idArticulo: id},
            success: function (response) {
                if ($.trim(response) == 1) {
                    $(ahref).parent().css("display", "none");
                } else {
                    alert("ERROR");
                }
            },
            error: function(xhr, status, error) {
                var err = JSON.parse(xhr.responseText);
                alert(err.Message);
            }
        });
    }
    
    $(function () {
        $('.task').dblclick(function () {
            var id = $(this).find(".idArticulo").val();
            openInciso(this, id);
        });

        var txtArticulo = document.getElementById("txtAddarticulo");
        txtArticulo.maxLength = 500;
        actualizarFunciones();
        
        $(".tasksInciso").sortable({
            connectWith: ".tasksInciso",
            cursor: "grabbing"
        });
        $(".tasksInciso").on("sortbeforestop", function (event, ui) {
            var arrayOrden = new Array();
            var order = 0;
            $(".tasksInciso li").each(function () {
                var id = $(this).find('.idInciso').val();
                if (id !== undefined) {
                    order++;
                    var ordenamiento = {
                        id: id,
                        order: order
                    };
                    arrayOrden.push(ordenamiento);
                }
            });
            console.log(JSON.stringify(arrayOrden));
            $.ajax({
                url: 'index.php',
                type: 'post',
                dataType: 'json',
                data: {action: 'actualizarOrdenInciso', array: JSON.stringify(arrayOrden)},
                success: function (response) {
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    var err = JSON.parse(xhr.responseText);
                    alert(err.Message);
                }
            });
        });
        $(".tasksInciso").on("sortcreate", function (event, ui) {
            alert("create");
        });
        $('#btnAddInciso').click(function () {
            var txt = $("#txtAddInciso").val();
            var idArticulo = $("#idArticulo").val();
            if (txt !== "") {
                $.ajax({
                    url: 'index.php',
                    type: 'post',
                    data: {action: 'guardarInciso', value: txt, idArticulo: idArticulo},
                    success: function (response) {
                        console.log(response);
                        if (response) {
                            $(".tasksInciso").append(crearLiInciso($.trim(response), txt));
                            $("#txtAddInciso").val("");
                            actualizarFunciones();
                        } else {
                            alert("ERROR");
                        }
                    },
                    error: function () {
                        alert("ERROR");
                    }
                });
            }
        });
        
        $(".tasksArticle").sortable({
            connectWith: ".tasksArticle",
            cursor: "grabbing"
        });
        $(".tasksArticle").on("sortbeforestop", function (event, ui) {
            var arrayOrden = new Array();
            var order = 0;
            $(".tasksArticle li").each(function () {
                var id = $(this).find('.idArticulo').val();
                if (id !== undefined) {
                    order++;
                    var ordenamiento = {
                        id: id,
                        order: order
                    };
                    arrayOrden.push(ordenamiento);
                }
            });
            console.log(JSON.stringify(arrayOrden));
            $.ajax({
                url: 'index.php',
                type: 'post',
                dataType: 'json',
                data: {action: 'actualizarOrdenArticulo', array: JSON.stringify(arrayOrden)},
                success: function (response) {
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    var err = JSON.parse(xhr.responseText);
                    alert(err.Message);
                }
            });
        });
        $(".tasksArticle").on("sortcreate", function (event, ui) {
            alert("create");
        });
        $('#btnAddArticulo').click(function () {
            var txt = $("#txtAddarticulo").val();
            var idAgenda = $("#idAgenda").val();
            if (txt !== "") {
                $.ajax({
                    url: 'index.php',
                    type: 'post',
                    data: {action: 'guardarArticulo', txt: txt, idAgenda: idAgenda},
                    success: function (response) {
                        if (response) {
                            var li = document.createElement("li");
                            li.setAttribute('class', 'task');
                            var hidden = document.createElement("input");
                            hidden.setAttribute("type", "hidden");
                            hidden.setAttribute("class", "idArticulo");
                            hidden.setAttribute("value", $.trim(response));

                            var label = document.createElement("label");
                            label.setAttribute('class', 'txtArticulo');
                            label.innerHTML = txt;
                            var a = document.createElement("a");
                            a.setAttribute('class', 'btnEdittask btn btn-default btn-xs pull-right');

                            var span = document.createElement("span");
                            span.setAttribute('class', 'glyphicon glyphicon-trash');
                            li.appendChild(hidden);
                            li.appendChild(label);
                            li.appendChild(a);
                            a.appendChild(span);
                            var onclick = "deleteArticulo($(this)," + $.trim(response) + ")";
                            a.setAttribute('onclick', onclick);
                            li.appendChild(a);
                            $(".tasksArticle").append(li);
                            $("#txtAddarticulo").val("");
                            //alert(response);
                            //refrescar();
                        } else {
                            alert("Error al guardar el articulo");
                        }
                    },
                    error: function () {
                        alert("Error al guardar el articulo");
                    }
                });
            }
        });
        
        $('#btnActualizarArticulo').click(function () {
        var txt = $("#txtEditArticulo").val();
        var idArticulo = $("#idArticulo").val();
        if (txt !== "") {
            $.ajax({
                url: 'index.php',
                type: 'post',
                dataType: 'json',
                data: {action: 'actualizarArticulo', txt: txt, idArticulo: idArticulo},
                success: function (response) {
                    if ($.trim(response) == 1) {
                        location.reload();
                    } else {
                        alert("ERROR");
                    }
                },
                error: function () {
                    alert("ERROR DE CONEXIÓN");
                }
            });
        }
    });
        
    });
