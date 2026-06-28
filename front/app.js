const API = "http://localhost:8000";

$(function () {
    listarProductos();

    $("#formProducto").submit(function (e) {
        e.preventDefault();

        if ($("#id").val() == "")
            crearProducto();
        else
            actualizarProducto($("#id").val());
    });
});

function listarProductos() {

    $.get(API, function(productos) {

        let html = "";

        for (let i = 0; i < productos.length; i++) {

            html += `
                <tr>
                    <td>${productos[i].id}</td>
                    <td>${productos[i].nombre}</td>
                    <td>${productos[i].descripcion}</td>
                    <td>$${productos[i].precio}</td>
                    <td>USD ${productos[i].precio_usd}</td>
                    <td>
                        <button onclick="editar(${productos[i].id}, '${productos[i].nombre}', '${productos[i].descripcion}', ${productos[i].precio})">Editar</button>

                        <button onclick="eliminar(${productos[i].id})">Eliminar</button>
                    </td>
                </tr>
            `;
        }

        $("#tabla").html(html);
        $("#mensaje").hide();

    });

}

function crearProducto() {

    $.ajax({
        url: API,
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(obtenerDatos()),
        success: function () {
            limpiarFormulario();
            listarProductos();
        }
    });

}

function actualizarProducto(id) {

    $.ajax({
        url: API + "/" + id,
        type: "PUT",
        contentType: "application/json",
        data: JSON.stringify(obtenerDatos()),
        success: function () {
            limpiarFormulario();
            listarProductos();
        }
    });

}

function eliminar(id) {

    if (!confirm("¿Eliminar producto?"))
        return;
    $.ajax({
        url: API + "/" + id,
        type: "DELETE",
        dataType: "json",
       success: function (respuesta) {
            $("#mensaje").html(respuesta.mensaje).show();
            setTimeout(listarProductos,3000);
        }
    });

}

function editar(id, nombre, descripcion, precio) {

    $("#id").val(id);
    $("#nombre").val(nombre);
    $("#descripcion").val(descripcion);
    $("#precio").val(precio);

}

function obtenerDatos() {

    return {
        id: $("#id").val(),
        nombre: $("#nombre").val(),
        descripcion: $("#descripcion").val(),
        precio: $("#precio").val()
    };

}

function limpiarFormulario() {

    $("#id").val("");
    $("#nombre").val("");
    $("#descripcion").val("");
    $("#precio").val("");

}