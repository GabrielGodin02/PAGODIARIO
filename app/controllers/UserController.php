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
    public function showUpdatePasswordForm()
    {
        include 'app/vistas/auth/update-password.php';
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
    public function updateUserPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ident =  $_SESSION['user']['ident'];
            $password = $_POST['passw'];
            $new_password = $_POST['n-passw'];
            $cnew_password = $_POST['cn-passw'];

            $update_sql =
                "UPDATE registro 
            SET password=PASSWORD(?)
            WHERE ident=(?)";

            $update_query = false;

            if ($new_password == $cnew_password) {
                $update_query = hacerConsulta($update_sql, [$password, $ident]);
            }

            $this->showResult($update_query, showSuccess: true);
        }
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

            $this->showResult($update_query, showSuccess: true);
        }
    }
}
