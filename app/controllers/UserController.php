<?php


class UsersController extends Controller
{
    public $currentUser;
    public function showUpdateUserForm()
    {
        $this->updateUser();
        $this->readCurrentUser();
        include 'app/vistas/auth/perfil-usuario.php';
    }
    public function readUserById($id)
    {
        $consulta = "SELECT * FROM registro WHERE ident= ?";
        $resultado = hacerConsulta($consulta, [$id]);
        return mysqli_fetch_array($resultado);
    }
    public function readCurrentUser()
    {
        $ident =  $_SESSION['user']['ident'];
        $_SESSION['user'] =  $this->readUserById($ident);
        $this->currentUser = $_SESSION['user'];
        return $this->currentUser;
    }
    public function updateUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ident =  $_SESSION['user']['ident'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];
            $profesion = $_POST['profesion'];
            $estado = $_POST['estado'];

            $update_sql =
                "UPDATE registro 
                SET direccion = (?) , email = (?) , profesion = (?) , estado = (?) , telefono = (?)
                WHERE ident = (?)";
            $update_query = hacerConsulta($update_sql, [$direccion, $email, $profesion, $estado, $telefono, $ident]);

            showResult($update_query, showSuccess: true);
        }
    }
    public function readReporte() {
        $time = new DateTime();
        $mes = isset($_GET["date_month"]) ? $_GET["date_month"] : $time->format('m');
        $anio = isset($_GET["date_year"]) ? $_GET["date_year"] : $time->format('Y');
        $fecha = "$anio-$mes";
        $pagodiario = $_SESSION["user"]["ident"];
    
        $query = "SELECT *, 
        (SELECT CONCAT(nombre,' ',apellidos) FROM registro WHERE ident = reportes.id_pagodiario) as pagodiario 
        FROM reportes, registro 
        WHERE id_pagodiario = ? 
        AND DATE_FORMAT(create_time, '%Y-%m') = ?";
        
        $resultado = false;
        
        if ($_SESSION["user"]["admin"]) {
            $resultado = hacerConsulta($query, [$pagodiario, $fecha]);
        }
    
        return mysqli_fetch_assoc($resultado);
    }
    
}
