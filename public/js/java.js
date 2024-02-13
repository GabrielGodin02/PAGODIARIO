function toggleList() {
    var container = document.querySelector(".container");
    container.classList.toggle("active");
}
function guardarSeleccion(usuarioId, estado) {
    // Realiza una solicitud AJAX para enviar la selección al servidor
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./php/guardar_seleccion.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var respuesta = xhr.responseText;
            var mensajeElement = document.getElementById("mensaje_" + usuarioId);

            if (respuesta === "ok") {
                mensajeElement.textContent = "Selección guardada con éxito";
            } else {
                mensajeElement.textContent = "Error al guardar la selección";
            }
        }
    };

    // Envía la selección al servidor
    xhr.send("usuario_id=" + usuarioId + "&seleccion=" + estado);
}
