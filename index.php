<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// extraccion de url
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
session_start(); // inicio de sesion
// controladores - configuracion - helpers - componentes - base de datos
require 'includes/utils/conexion.php';
require 'app/config/index.php';
require 'app/helpers/index.php';
require 'app/controllers/index.php';
require 'app/componentes/index.php';
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/public/css/index.css">
    <title>pagodiarios - pide tu prestamo hoy</title>
</head>
<html lang="en">
<?php
$auth = new AuthController();
$user = new UsersController();
$soli = new PrestamosController();
include_once('app/componentes/nav_bar.php'); // nav-bar
switch ($uri) { // Router/body de la app 
    case '/': $auth->showLoginForm(); break;
    case '/login': $auth->showLoginForm(); break;
    case '/registro': $auth->showRegisterForm(); break;
    case '/recuperacion': $auth->showRecoveryForm(); break;
    case '/deudor': $soli->showPrestamoForm(); break;
    case '/deudor/mi-perfil':$user->showUpdateUserForm(); break;
    case '/deudor/cambiar-contrasenia': $auth->showUpdatePasswordForm(); break;
    case '/deudor/mis-solicitudes':$soli->showSolicitudesUser(); break;
    case '/deudor/mis-solicitudes/delete': $soli->deletePrestamo(); break;
    case '/admin':$soli->showCobrosDelDia(); break;
    case '/admin/mi-perfil': $user->showUpdateUserForm(); break;
    case '/admin/cambiar-contrasenia': $auth->showUpdatePasswordForm(); break;
    case '/admin/reporte': $soli->showReporte(); break;
    case '/admin/control-solicitudes':$soli->showSolicitudes(); break;
    case '/admin/control-solicitudes/update': $soli->updatePrestamoStatus(); redirect('/admin/control-solicitudes'); break;
    case '/admin/control-solicitudes/delete': $soli->deletePrestamo(); break;
    case '/admin/prestamos/abonar': $soli->payPrestamo(); break;
    case '/admin/prestamos/excusar': $soli->excusePrestamo(); break;
    case '/logout': $auth->logoutUser(); break;
    default:
        http_response_code(404);
        include 'app/vistas/404.php';
        break;
}
?>
<footer class="fot">
    <span class="text">Copyright © Todos los derechos reservados</span>
</footer>
<script src="/public/js/modals.js"></script>
<script src="/public/js/java.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>