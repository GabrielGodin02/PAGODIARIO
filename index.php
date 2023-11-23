
<!DOCTYPE html>
<?php include_once('./app/componentes/head.php') // cabecera principal?>
<html lang="en">
    <?php
// inicio de session
session_start();
// extraccion de url
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// nav-bar
include_once('./app/componentes/user-header.php'); 

// Router/body de la app 
switch ($uri) {
    case '/':
        include_once('app/vistas/login.php');
        break;
    case '/registro':
        include_once('app/vistas/registro.php');
        break;
    case '/recuperacion':
        include_once('app/vistas/recuperar-contraseña.php');
        break;
    case '/solicitar':
        include_once('app/vistas/deudor/panel-control-usuario.php');
        break;
    case '':
        include_once('app/vistas/login.php');
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