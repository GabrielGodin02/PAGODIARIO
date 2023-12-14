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
        } else { 
            ?>
            <script>
                alert('<?php echo $errorMessage ?>');
            </script>
<?php
        }
    }
}
