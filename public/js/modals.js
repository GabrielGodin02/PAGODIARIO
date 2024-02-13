function abrirModalAbono(id_prestamo) {
    let modal = document.getElementById("modalAbono");
    let usuarioIdInput = document.getElementById("abonar_prestamo_id");
    usuarioIdInput.value = id_prestamo;
    modal.style.display = "block";
}

function cerrarModalAbono() {
    let modal = document.getElementById("modalAbono");
    modal.style.display = "none";
}

function abrirModalExcusa(id_prestamo) {
    let modal = document.getElementById("modalExcusa");
    let usuarioIdInput = document.getElementById("excusar_prestamo_id");
    usuarioIdInput.value = id_prestamo;
    modal.style.display = "block";
}

function cerrarModalExcusa() {
    let modal = document.getElementById("modalExcusa");
    modal.style.display = "none";
}

function setConfirmCompleteId(id_prestamo) {
    let usuarioIdInput = document.getElementById("confirm_complete_id");
    usuarioIdInput.value = id_prestamo;
    modal.style.display = "block";
}
function setConfirmRejectId(id_prestamo) {
    let usuarioIdInput = document.getElementById("confirm_reject_id");
    usuarioIdInput.value = id_prestamo;
    modal.style.display = "block";
}