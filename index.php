<?php
require __DIR__ . '/vendor/autoload.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Establecer la zona horaria a la hora local
date_default_timezone_set('America/Bogota');  // Cambia 'America/Bogota' según tu ubicación
// variables de entorno
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="/public/css/index.css">
    <title>pagodiarios - pide tu prestamo hoy</title>
</head>
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
    case '/reset-password': $auth->showResetPasswordForm(); break;
    case '/deudor': $soli->showPrestamoForm(); break;
    case '/deudor/mi-perfil':$user->showUpdateUserForm(); break;
    case '/deudor/cambiar-contrasenia': $auth->showUpdatePasswordForm(); break;
    case '/deudor/mis-solicitudes':$soli->showSolicitudesUser(); break;
    case '/deudor/mis-solicitudes/delete': $soli->deletePrestamo(); break;
    case '/admin':$soli->showCobrosDelDia(); break;
    case '/admin/abonar': $soli->payPrestamo(); $soli->showCobrosDelDia(); break;
    case '/admin/excusar': $soli->excusePrestamo(); $soli->showCobrosDelDia(); break;
    case '/admin/mi-perfil': $user->showUpdateUserForm(); break;
    case '/admin/cambiar-contrasenia': $auth->showUpdatePasswordForm(); break;
    case '/admin/reporte': $soli->showReporte($user); break;
    case '/admin/control-solicitudes': $soli->showSolicitudes($user); break;
    case '/admin/control-solicitudes/update': $soli->updatePrestamoStatus(); $soli->showSolicitudes($user); break;
    case '/admin/control-solicitudes/complete': $soli->completePrestamo(); $soli->showSolicitudes($user); break;
    //case '/admin/control-solicitudes/abonar': $soli->payPrestamo(); $soli->showSolicitudes(); break;
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>