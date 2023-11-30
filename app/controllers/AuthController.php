<?php
require "app/helpers/Helpers.php";

class AuthController
{
    public $helpers;

    public function __construct()
    {
        $this->helpers = new Helpers();
    }
    public function showLoginForm()
    {
        // Muestra el formulario de registro
        $this->loginUser();
        include_once 'app/vistas/login.php';
    }
    public function showRegisterForm()
    {
        // Muestra el formulario de registro
        $this->registerUser();
        include 'app/vistas/registro.php';
    }
    public function showRecoveryForm()
    {
        // Muestra el formulario de registro
        include 'app/vistas/recuperar-contrasenia.php';
    }
    public function loginUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $passw = $_POST['passw'];
            $consulta = "SELECT * FROM registro WHERE password='$passw' AND email='$email'";

            $resultado = hacerConsulta($consulta);
            $fila = mysqli_num_rows($resultado);

            if ($fila) {
                // Autenticación exitosa, guarda la identificación en una variable de sesión
                $_SESSION['user'] =   mysqli_fetch_array($resultado);
                $_SESSION['auth'] = true;
                $_SESSION['admin'] = $_SESSION['user']['admin'];

                if ($_SESSION['admin']) header("location: /admin");
                else header("location: /deudor");
            }
            $this->helpers->showResult($fila, true);
            mysqli_free_result($resultado);
        }
    }
    public function registerUser()
    {
        // Procesa la solicitud de registro
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ident = $_POST['ident'];
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $direccion = $_POST['direccion'];
            $email = $_POST['email'];
            $passw = $_POST['passw'];
            $estado = $_POST['estado'];
            $profesion = $_POST['profesion'];
            $fecha = $_POST['fecha'];

            // Guarda los datos en la base de datos (deberías usar sentencias preparadas)";
            $query = "INSERT INTO registro (nombre, apellidos, direccion, ident, email, password, estado, profesion, fecha) 
            VALUES ('$nombre', '$apellidos', '$direccion', '$ident', '$email', '$passw', '$estado', '$profesion', '$fecha')";

            // Ejecuta la consulta (deberías manejar errores y excepciones aquí)
            $ejecucion = hacerConsulta($query);
            // devolver reultados
            if ($ejecucion) { 
                header('location: /');
            }
            $this->helpers->showResult(($ejecucion));
            // Redirecciona a la página de inicio de sesión u otra página
            //exit();
        }
    }
    public function recoverUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        }
    }
    public function logoutUser()
    {
        session_destroy();
        header('location: /');
        die();
    }
}
