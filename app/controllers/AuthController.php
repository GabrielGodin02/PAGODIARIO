<?php
// /app/controllers/AuthController.php

class AuthController
{
    public function showLoginForm()
    {
        // Muestra el formulario de registro
        include_once 'app/vistas/login.php';
    }
    public function showRegisterForm()
    {
        // Muestra el formulario de registro
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
            $ident = $_POST['ident'];
            $consulta = "SELECT * FROM registro WHERE ident='$ident' AND email='$email'";

            $resultado = hacerConsulta($consulta);
            $fila = mysqli_num_rows($resultado);

            if ($fila) {
                // Autenticación exitosa, guarda la identificación en una variable de sesión
                $_SESSION['user'] =  mysqli_fetch_array($resultado);
                $_SESSION['auth'] = true;
                $_SESSION['admin'] = mysqli_fetch_array($resultado)['admin'];
                header("location: /deudor");
            } else {
                echo (
                    '
            <html lang="en">
            <head>
            </head>
            <body>
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                Swal.fire({
                    icon: "error",
                    title: "Algo Salio Mal",
                    text: "Error En la Autenticacion!",
                  })
                </script>
            </body>
            </html>
           '
                );
                $this->showLoginForm();
            }
        }

        mysqli_free_result($resultado);
    }
    public function registerUser()
    {
        // Procesa la solicitud de registro
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $ident = $_POST['ident'];
            $email = $_POST['email'];
            $estado = $_POST['estado'];
            $fecha = $_POST['fecha'];

            // Guarda los datos en la base de datos (deberías usar sentencias preparadas)";
            $query = "INSERT INTO registro (nombre, apellidos, ident, email, estado, fecha) VALUES ('$nombre', '$apellidos', '$ident', '$email', '$estado', '$fecha')";

            // Ejecuta la consulta (deberías manejar errores y excepciones aquí)
            $ejecucion = hacerConsulta($query);

            // devolver reultados
            if ($ejecucion) {
                echo '
                <script>
                alert("Datos Guardados");
                window.location="/";
                </script>
                ';
            } else {
                echo '
                <script>
                alert("Datos no Guardados");
                window.location="/formulario-registro";
                </script>
                ';
            }
            // Redirecciona a la página de inicio de sesión u otra página
            exit();
        }
        header("Location: /");
    }
    public function recoverUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        }
    }
    public function logoutUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        }
    }
}
