<?php
require "app/models/Controller.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

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
        $this->sendUserPasswordCode();
        include 'app/vistas/recuperar-contrasenia.php';
    }
    public function showUpdatePasswordForm()
    {
        $this->updateUserPassword();
        include 'app/vistas/auth/update-password.php';
    }
    public function showResetPasswordForm()
    {
        $this->recoverUserPassword();
        include 'app/vistas/reset-password.php';
    }
    public function loginUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $passw = $_POST['passw'];
            $consulta = "SELECT * FROM registro WHERE password=PASSWORD(?) AND email = ?";

            $resultado = hacerConsulta($consulta, [$passw, $email]);
            $fila = mysqli_num_rows($resultado);

            showResult($fila, showSuccess: false);
            if ($fila) {
                // Autenticación exitosa, guarda la identificación en una variable de sesión
                $_SESSION['user'] = mysqli_fetch_array($resultado);
                $_SESSION['auth'] = true;
                $_SESSION['admin'] = $_SESSION['user']['admin'];
                $this->saveToken();

                if (isset($_SESSION['token'])) {
                    if ($_SESSION['admin']) redirect("/admin");
                    else redirect("/deudor");
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

            $check_query = "SELECT 1 FROM registro WHERE ident = ?";
            $ejecucion = hacerConsulta($check_query, [$ident]);
            $error_message = "Usuario ya existente";
            if (mysqli_num_rows($ejecucion) <= 0) {
                // Guarda los datos en la base de datos (deberías usar sentencias preparadas)";
                $query = "INSERT INTO registro (nombre, apellidos, direccion, telefono, ident, email, password, estado, profesion, fecha) 
                VALUES (?, ?, ?, ?, ?, ?, PASSWORD(?), ?, ?, ?)";

                // Ejecuta la consulta (deberías manejar errores y excepciones aquí)
                $ejecucion = hacerConsulta($query, [
                    $nombre, $apellidos, $direccion, $telefono, $ident, $email, $passw, $estado, $profesion, $fecha
                ]);
                // devolver reultados
                if ($ejecucion) redirect('/');
                $error_message = "No se pudo hacer el registro, intentelo más tarde.";
            } else $ejecucion = false;
            showResult($ejecucion, true, true, errorMessage: $error_message);
            // Redirecciona a la página de inicio de sesión u otra página
            //exit();
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
    public function sendUserPasswordCode()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ident =  $_POST['ident'];
            $getEmail = mysqli_fetch_array(hacerConsulta("SELECT email, nombre, apellidos FROM registro WHERE ident = ?", [$ident]));
            $email = $getEmail["email"];
            $error_message = "Usuario no encontrado";

            if ($email != null) {
                require 'vendor/autoload.php';
                $token = $this->generateToken();
                $current_time = time(); // Obtener la fecha y hora actuales
                $expiry_time = $current_time + (15 * 60); // Sumar 15 minutos (60 segundos por minuto * 15 minutos)
                $expiry_date = date("Y-m-d H:i:s", $expiry_time); // Formatear la nueva fecha y hora
                $query = "UPDATE registro set reset_token=?, expiry_date=? WHERE email=?";
                $usuario = $getEmail["nombre"] . " " . $getEmail["apellidos"];
                $domain = $_ENV['APP_DOMAIN'];
                $result = hacerConsulta($query, [$token, $expiry_date, $email]);

                $parrafo1 = "
                    <p>
                        Hola <b>$usuario</b>, se solicito la recupercion de contraseña para tu cuenta de <b>pagodiario.online</b>. 
                    </p>
                ";
                $parrafo2 = "
                    <p>
                        Si no fuiste tu, ignora este mensaje.
                    </p>
                ";
                $link = "
                    <a 
                        href ='http://$domain/reset-password?email=" . urlencode($email) . "&token=" . urlencode($token) . "'
                        style=
                        '
                        background-color: blue;
                        color: white;
                        border-radius: 10px;
                        padding: 10px;
                        text-decoration: none;
                        '
                        class='' 
                    >
                        Presiona aqui para recuperar tu contraseña
                    </a>
                ";
                $mensaje = "
                    <main>
                        <h2>Recuperación de contraseña</h2>
                        $parrafo1
                        $link
                        $parrafo2
                    </main>
                ";

                //Email send code
                $to_email = $email;
                $mail_subject = "Recuperar contraseña";
                $mail_content = $mensaje;

                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                // More headers
                $headers .= "From: no-reply@test.com" . "\r\n";

                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    $mail->isSMTP();
                    $mail->Host = 'sandbox.smtp.mailtrap.io';
                    $mail->SMTPAuth = true;
                    $mail->Port = 2525;
                    $mail->Username = $_ENV['MAILTRAP_ID'];
                    $mail->Password = $_ENV['MAILTRAP_PW'];        // Set the SMTP server to send through

                    //Recipients
                    $mail->setFrom('codelivejunior@gmail.com', 'Pagodiario.online');
                    $mail->addAddress($to_email);     //Add a recipient

                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = $mail_subject;
                    $mail->Body    = $mail_content;
                    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                    $mail->send();
                } catch (Exception $e) {
                    $error_message = "No se pudo enviar el mensaje";
                    $email = false;
                }
            }
            showResult($email ?? false, true, true, "Revisa tu direccion de correo electronico", $error_message);
        }
    }
    public function recoverUserPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email =  $_GET['email'];
            $token =  $_GET['token'];
            $new_password = $_POST['new'];
            $cnew_password = $_POST['confirm_new'];
            $update_query = false;

            $errorMessage = "Las contraseñas no coinciden";
            if ($new_password == $cnew_password = $_POST['confirm_new']) {
                $checkUser = hacerConsulta('SELECT * FROM registro WHERE email = ? AND reset_token = ?', [$email, $token]);
                $current_date = date("Y-m-d H:i:s");
                $expiry_date = mysqli_fetch_array($checkUser)['expiry_date'];

                $errorMessage = "Token expirado";
                if (mysqli_num_rows($checkUser) > 0 && $current_date <= $expiry_date) {
                    $update_sql =
                        "UPDATE registro 
                        SET password=PASSWORD(?), expiry_date = NULL, reset_token = NULL
                        WHERE email=(?)
                        AND reset_token = ?";

                    $update_query = hacerConsulta($update_sql, [$new_password, $email, $token]);
                }
            }

            showResult($update_query, showSuccess: true, errorMessage: $errorMessage);
        }
    }
    public function logoutUser()
    {
        $token =  $_SESSION['token'];
        $query = "DELETE FROM inicio_sesion WHERE token = ?";
        hacerConsulta($query, [$token]);
        session_destroy();
        redirect('/');
        die();
    }
}
