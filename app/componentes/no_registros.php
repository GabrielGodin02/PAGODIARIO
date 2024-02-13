<?php

function NoRegistrosComponent($message = false){
    ?>
    <div class="d-flex justify-content-center align-items-center h-200 container">
        <h2 class="no-registros text-secondary"><?php echo is_string($message) ? $message : "No hay registros disponibles"?></h2>
    </div>
    <?php
}