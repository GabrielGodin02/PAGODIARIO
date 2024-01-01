<?php
require "app/models/Controller.php";

class AuthController extends Controller
{
    public $helpers;
    public function generateToken($length = 16)
    {
        $stringSpace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $pieces = [];
        $max = mb_strlen($stringSpace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces[] = $stringSpace[random_int(0, $max)];
        }
        $_SESSION['token'] = implode('', $pieces);
        return implode('', $pieces);
    }
    public function saveToken()
    {
        $token = $this->generateToken(42);
        $id_user = $_SESSION['user']['ident'];
        $query = "INSERT INTO inicio_sesion (id_usuario, token) VALUES ($id_user, '$token')";
        $result = hacerConsulta($query);
        if (!$result) $this->logoutUser();
        return $result;
    }
    public function showLoginForm()
    {
        $this->loginUser();
        include_once 'app/vistas/login.php';
    }
    public function showRegisterForm()
    {
        $this->registerUser();
        include 'app/vistas/registro.php';
    }
    public function showRecoveryForm()
    {
        include 'app/vistas/recuperar-contrasenia.php';
    }
    public function showUpdatePasswordForm()
    {
        $this->updateUserPassword();
        include 'app/vistas/auth/update-password.php';
    }
    public function loginUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $passw = $_POST['passw'];
            $consulta = "SELECT * FROM registro WHERE password=PASSWORD(?) AND email = ?";

            $resultado = hacerConsulta($consulta, [$passw, $email]);
            $fila = mysqli_num_rows($resultado);

            showResult($fila);
            if ($fila) {
                // Autenticación exitosa, guarda la identificación en una variable de sesión
                $_SESSION['user'] = mysqli_fetch_array($resultado);
                $_SESSION['auth'] = true;
                $_SESSION['admin'] = $_SESSION['user']['admin'];
                $this->saveToken();

                if (isset($_SESSION['token'])) {
                    if ($_SESSION['admin']) header("location: /admin");
                    else header("location: /deudor");
                } else $this->logoutUser();
            }
            //mysqli_free_result($resultado);
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
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];
            $passw = $_POST['passw'];
            $estado = $_POST['estado'];
            $profesion = $_POST['profesion'];
            $fecha = $_POST['fecha'];

            // Guarda los datos en la base de datos (deberías usar sentencias preparadas)";
            $query = "INSERT INTO registro (nombre, apellidos, direccion, telefono, ident, email, password, estado, profesion, fecha) 
            VALUES (?, ?, ?, ?, ?, ?, PASSWORD(?), ?, ?, ?)";

            // Ejecuta la consulta (deberías manejar errores y excepciones aquí)
            $ejecucion = hacerConsulta($query, [
                $nombre, $apellidos, $direccion, $telefono, $ident, $email, $passw, $estado, $profesion, $fecha
            ]);
            // devolver reultados
            if ($ejecucion) header('location: /');
            showResult(($ejecucion));
            // Redirecciona a la página de inicio de sesión u otra página
            //exit();
        }
    }
    public function recoverUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        }
    }
    public function updateUserPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ident =  $_SESSION['user']['ident'];
            $password = $_POST['old'];
            $new_password = $_POST['new'];
            $cnew_password = $_POST['confirm_new'];

            $token = $_SESSION['token'];
            $update_sql =
                "UPDATE registro 
            SET password=PASSWORD(?)
            WHERE ident=(?)
             AND EXISTS (SELECT 1 FROM inicio_sesion WHERE token = ? AND id_usuario = ident) 
             AND password=PASSWORD(?)";

            $update_query = false;

            if ($new_password == $cnew_password) {
                $update_query = hacerConsulta($update_sql, [$new_password, $ident, $token, $password]);
            }

            showResult($update_query, showSuccess: true);
        }
    }
    public function logoutUser()
    {
        $token =  $_SESSION['token'];
        $query = "DELETE FROM inicio_sesion WHERE token = ?";
        hacerConsulta($query, [$token]);
        session_destroy();
        header('location: /');
        die();
    }
}
