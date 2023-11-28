<?php


class UsersController
{
    public $currentUser;
    public function showUpdateUserForm()
    {
        $this->updateUser();
        include 'app/vistas/perfil-usuario.php';
    }
    public function getUserById($id)
    {
        $consulta = "SELECT * FROM registro WHERE ident='$id'";
        $resultado = hacerConsulta($consulta);
        return mysqli_fetch_array($resultado);
    }
    public function getCurrentUser()
    {
        $ident =  $_SESSION['user']['ident'];
        $_SESSION['user'] =  $this->getUserById($ident);
        $this->currentUser = $_SESSION['user'];
        return $this->currentUser;
    }
    public function updateUserPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ident =  $_SESSION['user']['ident'];
            $password = $_POST['passw'];

            $update_sql =
                "UPDATE registro 
            SET password='$password'
            WHERE ident='$ident'";
            $update_query = hacerConsulta($update_sql);

            if ($update_query) {
                $this->getCurrentUser() ?>
                <script>
                    alert("Informacion Actualizada");
                </script>
            <?php // Envía una respuesta al cliente para indicar que se guardó con éxito
            } else { ?>
                <script>
                    alert("Informacion no Actualizada");
                </script>
<?php
            }
        }
    }
    public function updateUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ident =  $_SESSION['user']['ident'];
            $direccion = $_POST['direccion'];
            $email = $_POST['email'];
            $profesion = $_POST['profesion'];
            $estado = $_POST['estado'];

            $update_sql =
                "UPDATE registro 
                SET direccion='$direccion', email='$email', profesion='$profesion', estado='$estado' 
                WHERE ident='$ident'";
            $update_query = hacerConsulta($update_sql);

            if ($update_query) {
                $this->getCurrentUser() ?>
                <script>
                    alert("Informacion Actualizada");
                </script>
            <?php // Envía una respuesta al cliente para indicar que se guardó con éxito
            } else { ?>
                <script>
                    alert("Informacion no Actualizada");
                </script>
<?php
            }
        }
    }
}
