<?php
$email =$_POST['email'];
$ident =$_POST['ident'];
session_start();
$_SESSION['ident'] = $ident;

$conexion = mysqli_connect("localhost", "root", "", "visual");

$consulta = "SELECT * FROM registro WHERE ident='$ident' AND email='$email'";

$resultado = mysqli_query($conexion, $consulta);
$fila = mysqli_num_rows($resultado);

if ($fila) {
    // Autenticación exitosa, guarda la identificación en una variable de sesión
    $_SESSION['ident'] = $ident;
    header("location: panel-control-usuario.php");
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
    include("login.php");
}

mysqli_free_result($resultado);
mysqli_close($conexion);
?>
