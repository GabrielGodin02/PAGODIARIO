<?php
    include 'conexion.php';
    $nombre =$_GET['nombre'];
    $apellidos =$_GET['apellidos'];
    $email =$_GET['email'];
    $fecha =$_POST['fecha'];


    $update_sql = "UPDATE registro SET nombre=?, apellidos=?, email=?, fecha=? WHERE ident=?";
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