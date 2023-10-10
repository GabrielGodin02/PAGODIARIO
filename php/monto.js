document.addEventListener('DOMContentLoaded', function () {
    const cantidaPrestamoInput = document.getElementById('cantida_prestamo');
    
    // Simulamos que el usuario ya ha solicitado un préstamo, por lo que desactivamos el campo.
    // En tu caso, debes verificar esta condición en PHP y luego generar el JavaScript correspondiente.
     const usuarioYaSolicitóPrestamo = true;

    if (usuarioYaSolicitóPrestamo) {
        cantidaPrestamoInput.disabled = true;
    }
});




