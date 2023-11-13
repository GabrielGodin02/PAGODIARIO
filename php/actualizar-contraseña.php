<?php
    include 'conexion.php';
    $ident =$_POST['ident'];
    $id =$_POST['id'];

    $update_sql = "UPDATE registro SET  ident='$ident' WHERE ident ='$id'";
    $update_query = mysqli_query($conexion, $update_sql);

    if ($update_query) {
        echo '
        <script>
        alert("Solicitud Aceptada");
        window.location="../admin.php";
        </script>
        '; // Envía una respuesta al cliente para indicar que se guardó con éxito
    } else {
        echo '
        <script>
        alert("Solicitud no Aceptada");
        window.location="../admin.php";
        </script>
        ';
    }



 mysqli_close($conexion);
?>