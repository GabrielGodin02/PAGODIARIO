
<?php 
include 'app\controllers\AuthController.php'; 
?>
<!DOCTYPE html>
<?php include_once('./app/componentes/head.php') // cabecera principal?>
<html lang="en">
<?php
// inicio de session
session_start();

require_once 'includes/utils/conexion.php';
$_SESSION["auth"] = false;
// extraccion de url
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// nav-bar
include_once('./app/componentes/user-header.php');
$auth = new AuthController();

// Router/body de la app 
switch ($uri) {
    case '/': $auth->showLoginForm(); break;
    case '/formulario-login': $auth->showLoginForm(); break;
    case '/login': $auth->loginUser(); break;
    case '/formulario-registro': $auth->showRegisterForm(); break;
    case '/registro':  $auth->registerUser(); break;
    case '/formulario-recuperacion':
        include_once('app/vistas/recuperar-contraseña.php');
        break;
    case '/recuperacion':
        include_once('app/vistas/recuperar-contraseña.php');
        break;
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

    default:
        http_response_code(404);
        include 'app/vistas/404.php';
        break;
}
?>

<footer class="fot">
    <label class="text">Copyright © Todos los derechos reservados</label>
</footer>

</html>