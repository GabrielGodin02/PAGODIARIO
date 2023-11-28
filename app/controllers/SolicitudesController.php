<?php

class SolicitudesController
{
    public function showSolicitudForm()
    {
        $this->registerSolicitud();
        include 'app/vistas/deudor/panel-control-usuario.php';
    }
    public function showCobrosDeldia()
    {
        $cobros = $this->getCobrosDelDia();
        include 'app/vistas/admin/cobros-hoy.php';
    }
    public function getCobrosDelDia()
    {
        $sql =
            "SELECT id_prestamo, id_usuario, email,
             prestamo.direccion as direccion, 
            nombre, apellidos, telefono,dia_solicitado, hora, cantida_prestamo, 
            prestamo.estado as p_estado, cantidad
            FROM registro, prestamo 
            WHERE id_usuario = ident 
            AND prestamo.estado = 'Aceptada'";

        $query = hacerConsulta($sql);
        $cobros = $query->fetch_all(MYSQLI_ASSOC);
        return $cobros;
    }
    public function changeSolicitudStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_prestamo = $_POST['id_prestamo'];
            $estado = $_POST['estado'];

            $update_sql = "UPDATE prestamo SET estado ='$estado' WHERE id_prestamo ='$id_prestamo'";
            $update_query = hacerConsulta($update_sql);

            if ($update_query) { ?>
                <script>
                    alert("Solicitud <?php echo $estado ?>");
                </script>
            <?php // Envía una respuesta al cliente para indicar que se guardó con éxito
            } else { ?>
                <script>
                    alert("No se pudo hacer el cambio");
                </script>
            <?php
            }
            ?>
            <script>
                window.location = "/admin/control-solicitudes";
            </script>
            <?php
        }
    }
    public function registerSolicitud()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_usuario = $_POST['id_usuario'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $dia_solicitado = $_POST['dia_solicitado'];
            $hora = $_POST['hora'];
            $cantidad = $_POST['cantida_prestamo'];
            $cantida_prestamo = $_POST['cantida_prestamo'];

            $cantidad = $cantidad;
            // Calcular el monto total del préstamo (incluyendo el 20% de interés)
            $tasaInteres = 0.20;
            $cantida_prestamo = $cantida_prestamo * (1 + $tasaInteres);

            $query =
                "INSERT INTO prestamo (id_usuario,direccion, 
                telefono,dia_solicitado, hora, cantidad, cantida_prestamo) 
                VALUES ('$id_usuario','$direccion', '$telefono',
                '$dia_solicitado','$hora','$cantidad', '$cantida_prestamo')";


            $ejecutar = hacerConsulta($query);
            if ($ejecutar) { ?>
                <script>
                    alert("Solicitud de prestamo envianda");
                    window.location = "/deudor";
                </script>
            <?php
            } else { ?>
                <script>
                    alert("Datos no Guardados");
                    window.location = "/deudor/mis-solicitudes";
                </script>
<?php
            }
        }
    }
}
