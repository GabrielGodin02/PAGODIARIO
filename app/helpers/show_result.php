<?php

function showResult(
    bool|mysqli_result $result,
    bool $showError = true,
    bool $showSuccess = false,
    String $successMessage = "Operacion completada exitosamente",
    String $errorMessage =  "Error En la Autenticacion!"

) {
    if ($result) {
?>
        <script>
            Swal.fire({
                title: "Exito",
                text: "<?php echo $successMessage ?>",
                icon: "success"
            })
        </script>
    <?php
        return true;
    } else {
    ?>
        <script>
            Swal.fire({
                title: "Error",
                text: "<?php echo $errorMessage ?>",
                icon: "error"
            })
        </script>
<?php
        return false;
    }
}