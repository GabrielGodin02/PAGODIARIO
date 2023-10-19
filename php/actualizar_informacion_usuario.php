<?php
    include 'conexion.php';
    $nombre =$_POST['nombre'];
    $apellidos =$_POST['apellidos'];
    $email =$_POST['email'];
    $fecha =$_POST['fecha'];


    $update_sql = "UPDATE registro SET nombre='$nombre', apellidos='$apellidos', email='$email', fecha='$fecha' WHERE nombre='$nombre'";
    $update_query = mysqli_query($conexion, $update_sql);

    if ($update_query) {
        echo '
        <script>
        alert("Informacion Actualizada");
        window.location="../perfil-usuario.php";
        </script>
        '; // Envía una respuesta al cliente para indicar que se guardó con éxito
    } else {
        echo '
        <script>
        alert("Informacion no Actualizada");
        window.location="../perfil-usuario.php";
        </script>
        ';
    }



 mysqli_close($conexion);
?>