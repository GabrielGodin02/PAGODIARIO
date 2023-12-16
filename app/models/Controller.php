<?php
class Controller
{
    public function showResult(
        bool|mysqli_result $result,
        bool $showError = true,
        bool $showSuccess = false,
        String $successMessage = "Operacion completada exitosamente",
        String $errorMessage =  "Error En la Autenticacion!"

    ) {
        if ($result) {
?>
            <script>
                alert('<?php echo $successMessage ?>');
            </script>
        <?php
            return true;
        } else {
        ?>
            <script>
                alert('<?php echo $errorMessage ?>');
            </script>
<?php
            return false;
        }
    }
    public function checkToken()
    {
        $token =$_SESSION["token"];
        $user = $_SESSION["user"]["ident"];
        $query = "SELECT * FROM inicio_sesion WHERE token = '$token' AND id_usuario = '$user'";

        $resultado = hacerConsulta($query);
        return $resultado;
    }
}
