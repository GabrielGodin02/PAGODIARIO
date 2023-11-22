
<!DOCTYPE html>
<html lang="en">
<?php include_once('./public/componentes/head.php') // cabecera principal?>
<?php
// inicio de session
session_start();
// verificacion de url
$_url = $_SERVER["REQUEST_URI"];
$split_url = explode("/", $_url);
$current_dir =  end($split_url);
in_array("admin", $split_url);
// Router de la app 
switch ($current_dir) {
    case '':
        include_once('app/vistas/login.php');
        break;
    case 'registro':
        include_once('app/vistas/registro.php');
        break;
    case 'recuperacion':
        include_once('app/vistas/recuperar-contraseña.php');
        break;
    case 'solicitar':
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


<!-- <footer>
    <label class="text">Copyright © Todos los derechos reservados</label>
</footer> -->
</html>