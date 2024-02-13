<?php
// Agrega las rutas que requieren inicio de sesión
function uriRequiresLogin($dir) {
    return in_array('deudor',  explode('/', $dir)) ||
    in_array('admin', explode('/', $dir)); 
}
function uriRequiresDeudor($dir) {
    return in_array('deudor',  explode('/', $dir));
}
function uriRequiresAdmin($dir) {
    return in_array('admin', explode('/', $dir)); 
}

// Verifica la autenticación si es necesario
if (uriRequiresLogin($uri) && !isset($_SESSION['auth'])) {
    // Redirecciona a la página de inicio de sesión
    header("Location: /login");
    exit();
} 
if (uriRequiresLogin($uri) && isset($_SESSION['auth'])) {
    # code...
    if (uriRequiresAdmin($uri) && !$_SESSION['admin']) {
        // Redirecciona a la página de inicio de sesión
        header("Location: /deudor");
        exit();
    } 
    if (uriRequiresDeudor($uri) && $_SESSION['admin']) {
        // Redirecciona a la página de inicio de sesión
        header("Location: /admin");
        exit();
    } 
}
