<?php
 include 'conexion.php';
 $usuario_id =$_POST['usuario_id'];
 $monto_abono =$_POST['monto'];

 $sql = "SELECT cantida_prestamo FROM prestamo WHERE id_usuario = $usuario_id";
 $query = mysqli_query($conexion, $sql);
 $row = mysqli_fetch_array($query);
 if ($row) {
    $cantidad_prestamo_actual = $row['cantida_prestamo'];

    // Realizar el abono restando el monto ingresado
    $cantidad_prestamo_actual -= $monto_abono;

    // Actualizar la cantidad_prestamo en la base de datos
    $update_sql = "UPDATE prestamo SET cantida_prestamo = $cantidad_prestamo_actual WHERE id_usuario = $usuario_id";
    $update_query = mysqli_query($conexion, $update_sql);

    if ($row) {
        $cantidad_prestamo_actual = $row['cantida_prestamo'];

        // Realizar el abono restando el monto ingresado
        $cantidad_prestamo_actual -= $monto_abono;

        // Actualizar la cantidad_prestamo en la base de datos
        $update_sql = "UPDATE prestamo SET cantida_prestamo = $cantidad_prestamo_actual WHERE id_usuario = $usuario_id";
        $update_query = mysqli_query($conexion, $update_sql);

        if ($update_query) {
            // Verificar si la cantidad_prestamo llegó a cero y eliminar el registro si es así
            if ($cantidad_prestamo_actual <= 0) {
                $delete_sql = "DELETE FROM prestamo WHERE id_usuario = $usuario_id";
                $delete_query = mysqli_query($conexion, $delete_sql);
                if ($delete_query) {
                    echo '
                    <script>
                        alert("Abono Realizado con exito y llego a cero");
                        window.location="../index.php";
                    </script>
                    ';
                } else {
                    echo '
                    <script>
                        alert("Abono realizado con éxito. Error al eliminar el registro");
                        window.location="../index.php";
                    </script>
                    ';
                }
            } else {
                echo '
                <script>
                    alert("Abono realizado con éxito. Cantidad prestamo actualizada");
                    window.location="../index.php";
                </script>
                ';
            }
        } else {
            // Error al actualizar la cantidad_prestamo
            echo "Error al actualizar la cantidad prestamo.";
        }
    } else {
        // No se encontró al usuario
        echo "Usuario no encontrado.";
    }
 }                                                                                     
                                      

 mysqli_close($conexion);                                                             
?>