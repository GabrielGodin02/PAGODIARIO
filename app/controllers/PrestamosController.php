<?php
/*
    show: conjunta el include de la vista y las peticiones que se deben hacer en la misma
    crud: los metodos que ejecutan 1 consulta empiezan por la palabra del C.R.U.D que la describe
*/
class PrestamosController extends Controller
{
    public bool $tiene_pendientes; // solo aplica al deudor
    public array $cobros; // solo aplica al pagodiario
    public array $solicitudes;
    public function showPrestamoForm()
    {
        $this->createPrestamo();
        $this->readPrestamosPendientesUser();
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
        $idc = isset($_GET["search"]) ? $_GET["search"] : false;
        $condicion = "prestamo.estado = 'pendiente'";
        if ($idc && is_numeric($idc)) $condicion = $condicion . " AND CAST(prestamo.id_usuario as CHAR) like '%$idc%'";
        $this->readPrestamos($condicion);
        $soli = $this;
        include 'app/vistas/auth/admin/solicitudes.php';
    }
    public function showSolicitudesUser()
    {
        $prestamos = $this->readPrestamosUser();
        include 'app/vistas/auth/deudor/solicitudes-deudor.php';
    }
    public function showReporte()
    {
        include 'app/vistas/auth/admin/reporte.php';
    }
    public function readCobrosDelDia()
    {
        $sql =
            "SELECT id_prestamo, id_usuario, email, direccion, 
            nombre, apellidos, telefono, fecha_solicitud, deuda,
            prestamo.estado as p_estado, cantidad
            FROM registro, prestamo 
            WHERE id_usuario = ident 
            AND id_pagodiario = ?
            AND prestamo.estado = 'Aceptada'";

        $query = hacerConsulta($sql, [$_SESSION['user']['ident']]);
        $cobros = $query->fetch_all(MYSQLI_ASSOC);
        return $cobros;
    }
    public function readPrestamosUser()
    {
        $userIdent = $_SESSION['user']['ident'];
        $sql = "SELECT  id_prestamo, cantidad, deuda, fecha_solicitud, prestamo.estado, 
            (SELECT CONCAT(nombre,' ',apellidos) FROM registro WHERE ident = prestamo.id_pagodiario) as pagodiario
            FROM prestamo 
            WHERE id_usuario = ?";
        $resultado = hacerConsulta($sql, [$userIdent]);
        $prestamos = $resultado->fetch_all(MYSQLI_ASSOC);
        return $prestamos;
    }
    public function readPrestamos($condicion = null)
    {
        $and = "";
        if (is_string($condicion)) {
            $and = " AND $condicion";
        }
        $query =
            "SELECT *
                FROM registro, prestamo 
                WHERE registro.ident = prestamo.id_usuario
                AND prestamo.id_pagodiario = ?".
            $and;
        $resultado = hacerConsulta($query, [$_SESSION['user']['ident']]);
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
        $query = "SELECT * FROM prestamo WHERE id_usuario= ? AND (estado='pendiente' OR estado='Aceptada')";
        $prestamos = hacerConsulta($query, [$id_user]);
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
            $result = false;
            $err_msg = "Estado Invalido";
            if ($estado === 'Aceptada' || $estado === 'Rechazada') {
                $query_solicitud = "SELECT * FROM prestamo WHERE id_prestamo = ?";
                $ejecutar_query_solicitud = hacerConsulta($query_solicitud, [$id_prestamo]);
                $monto_solicitado = mysqli_fetch_array($ejecutar_query_solicitud)["cantidad"];

                $err_msg = "No tienes suficiente capital para hacer este prestamo";
                if ($estado == "Rechazada" || $_SESSION['user']['capital'] >= $monto_solicitado) {
                    $update_sql = "UPDATE prestamo SET estado = ? WHERE id_prestamo = ?";
                    $update_query = hacerConsulta($update_sql, [$estado, $id_prestamo]);
                    $result = $update_query;
                    $err_msg = "No se pudo hacer el cambio";
                }
            }
        }
        $this->showResult(
            $result,
            showSuccess: true,
            successMessage: "Solicitud $estado",
            errorMessage: $err_msg
        );
?>
        <script>
            window.location = "/admin/control-solicitudes"
        </script>
<?php
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

            $check_user = "SELECT * FROM registro WHERE ident = ? AND password=PASSWORD(?)";
            $resultado  = false;
            $check_result = hacerConsulta($check_user, [$user, $password]);
            $error_message = "Contraseña incorrecta.";
            if ($check_result && mysqli_num_rows($check_result) == 1) {
                $error_message = "Ya tienes un prestamo aceptado.";
                if (!($this->readPrestamosPendientesUser())) 
                {
                    $error_message = "Error al registrar tu solicitud, intentelo mas tarde.";
                    $query =
                        "INSERT INTO prestamo (id_usuario, id_pagodiario, cantidad, deuda) 
                        VALUES (?, ?, ?, ?)";
                    $resultado = hacerConsulta($query, [$user, $pagodiario, $cantidad, $cantida_prestamo]);
                }
            }
            $this->showResult($resultado, errorMessage: $error_message);
        }
    }
    public function deletePrestamo()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id = $_GET['soli'];

            $ejecutar = false;
            if ($this->checkToken()) {
                $query = "DELETE FROM prestamo WHERE id_prestamo= ?";
                if (!$_SESSION["user"]["admin"]) {
                    $query = $query . " AND estado != 'Aceptada'";
                }
                $ejecutar = hacerConsulta($query, [$id]);
            }
            $this->showResult(
                $ejecutar,
                true,
                true,
                errorMessage: "No se pudo eliminar la solicitud",
                successMessage: "Solicitud eliminada correctamente",
            );
        }
        $this->showSolicitudesUser();
    }
}
