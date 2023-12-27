<?php

function NoRegistrosComponent($message = false){
    ?>
        <h2 class="no-registros"><?php echo is_string($message) ? $message : "No hay registros disponibles"?></h2>
    <?php
}