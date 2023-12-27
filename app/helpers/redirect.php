<?php
function redirect($route) {
    ?>
        <script>
            window.location = '<?php echo $route ?>';
        </script>
    <?php
}
?>
