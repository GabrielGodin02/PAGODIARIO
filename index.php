<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// extraccion de url
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
session_start(); // inicio de sesion
// controladores - configuracion - base de datos
require 'includes/utils/conexion.php';
require 'app/config/index.php';
require 'app/controllers/index.php';
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="/public/js/monto.js"></script>
    <script src="/public/js/java.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/public/css/index.css">
    <title>pagodiarios - pide tu prestamo hoy</title>
</head>
<html lang="en">
<?php
$auth = new AuthController();
include_once('app/componentes/nav_bar.php'); // nav-bar
switch ($uri) { // Router/body de la app 
    case '/': $auth->showLoginForm(); break;
    case '/login': $auth->showLoginForm(); break;
    case '/registro': $auth->showRegisterForm(); break;
    case '/recuperacion': $auth->showRecoveryForm(); break;
    case '/deudor':
        include_once('app/vistas/deudor/panel-control-usuario.php');
        break;
    case '/deudor/mi-perfil':
        include_once('app/vistas/perfil-usuario.php');
        break;
    case '/deudor/mis-solicitudes':
        include_once('app/vistas/deudor/solicitudes-deudor.php');
        break;
    case '/admin':
        include_once('app/vistas/admin/cobros-hoy.php');
        break;
    case '/admin/mi-perfil':
        include_once('app/vistas/perfil-usuario.php');
        break;
    case '/admin/reporte':
        include_once('app/vistas/admin/reporte.php');
        break;
    case '/admin/control-solicitudes':
        include_once('app/vistas/admin/admin.php');
        break;
    case '/logout': $auth->logoutUser(); break;
    default:
        http_response_code(404);
        include 'app/vistas/404.php';
        break;
}
?>
<footer class="fot">
    <label class="text">Copyright © Todos los derechos reservados</label>
</footer>
</body>

</html>