<?php

class PrestamosController extends Controller
{
    public bool $tiene_pendientes;
    public array $cobros;
    public array $solicitudes;
    public function showPrestamoForm()
    {
        $this->createPrestamo();
        $this->readPrestamosPendientesUser();
        $this->readPagodiarios();
        $soli = $this;
        include 'app/vistas/auth/deudor/panel-control-usuario.php';
    }
    public function showCobrosDeldia()
    {
        $cobros = $this->readCobrosDelDia();
        include 'app/vistas/auth/admin/cobros-hoy.php';
    }
    public function showSolicitudes()
    {
        $this->readPrestamos();
        $soli = $this;
        include 'app/vistas/auth/admin/solicitudes.php';
    }
    public function showSolicitudesUser()
    {
        include 'app/vistas/auth/deudor/solicitudes-deudor.php';
    }
    public function showReporte()
    {
        include 'app/vistas/auth/admin/reporte.php';
    }
    public function readCobrosDelDia()
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
        $this->$cobros = $cobros;
        return $cobros;
    }
    public function readPrestamosUser()
    {
        $id_user = $_SESSION["user"]["ident"];
        $query = "SELECT * FROM prestamo WHERE id_usuario = '$id_user'";
        $prestamos = hacerConsulta($query);
    }
    public function readPrestamos()
    {
        $query =
            "SELECT *
                FROM registro, prestamo 
                WHERE registro.ident = prestamo.id_usuario
                AND prestamo.id_pagodiario = " . $_SESSION['user']['ident'];
        $resultado = hacerConsulta($query);
        if ($resultado) {
            $this->solicitudes = $resultado->fetch_all(MYSQLI_ASSOC);
        } else {
            $this->solicitudes = [];
        }
        return $this->solicitudes;
    }

    public function readPrestamosPendientesUser()
    {
        $id_user = $_SESSION["user"]["ident"];
        $query = "SELECT * FROM prestamo WHERE id_usuario='$id_user' AND (estado='pendiente' OR estado='Aceptada')";
        $prestamos = hacerConsulta($query);
        $cantidad_prestamos = mysqli_num_rows($prestamos);
        $this->tiene_pendientes = $cantidad_prestamos > 0;
        return $this->tiene_pendientes;
    }
    public function readPagodiarios(): array
    {
        $query = "SELECT ident, nombre, apellidos FROM registro WHERE admin = 1";
        $result = hacerConsulta($query);
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }
    public function updatePrestamoStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_prestamo = $_POST['id_prestamo'];
            $estado = $_POST['estado'];
            $query_solicitud = "SELECT * 
                        FROM prestamo 
                        WHERE id_prestamo = $id_prestamo";
            $ejecutar_query_solicitud = hacerConsulta($query_solicitud);
            $monto_solicitado = mysqli_fetch_array($ejecutar_query_solicitud)["cantidad"];

            if ($estado != "Aceptada" || $_SESSION['user']['capital'] >= $monto_solicitado) {

                $update_sql = "UPDATE prestamo SET estado ='$estado' WHERE id_prestamo ='$id_prestamo'";
                $update_query = hacerConsulta($update_sql);

                $this->showResult(
                    $update_query,
                    showSuccess: true,
                    successMessage: "Prestamo $estado",
                    errorMessage: "No se pudo hacer el cambio"
                );
            } else {
                $this->showResult(false, errorMessage: "No tienes suficiente capital para hacer este prestamo");
            } ?>
            <script>
                window.location = "/admin/control-solicitudes"
            </script>
<?php
        }
    }
    public function createPrestamo()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $_SESSION["user"]["ident"];
            $pagodiario = $_POST['pagodiario'];
            $password = $_POST['passw'];
            $cantidad = $_POST['cantida_prestamo'];

            // Calcular el monto total del préstamo (incluyendo el 20% de interés)
            $tasaInteres = 0.20;
            $cantida_prestamo = $cantidad * (1 + $tasaInteres);

            $check_user = "SELECT * FROM registro WHERE ident='$user' AND password='$password'";
            $ejecutar  = false;
            $check_result = hacerConsulta($check_user);
            if ($check_result && mysqli_num_rows($check_result) == 1) {
                echo "asd";
                /*if (
                    !$this->readPrestamosPendientesUser()
                ) {
                    $direccion = $_SESSION["user"]["direccion"];
                    $telefono = $_SESSION["user"]["telefono"];
                    $query =
                        "INSERT INTO prestamo (id_usuario, id_pagodiario, direccion, telefono, cantidad, deuda) 
                        VALUES ('$user', '$pagodiario','$direccion', '$telefono','$cantidad', '$cantida_prestamo')";

                    $ejecutar = hacerConsulta($query);
                }*/
            }
            $this->showResult($ejecutar);
        }
    }
}
