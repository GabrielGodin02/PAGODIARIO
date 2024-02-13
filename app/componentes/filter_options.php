<?php
function FilterOptionsComponent(){
    ?>
        <ul class="nav nav-tabs">
            <li class="nav-item"><button class="nav-link text-secondary <?php echo isset($_GET['state']) && $_GET['state'] == 'pendiente' ? 'active' : '' ?>" name="state" value="pendiente"  type="submit">Pendientes</button></li>
            <li class="nav-item"><button class="nav-link text-success <?php echo isset($_GET['state']) && $_GET['state'] == 'Aceptada' ? 'active' : '' ?>" name="state" value="Aceptada" type="submit">Aceptados</button></li>
            <li class="nav-item"><button class="nav-link text-danger <?php echo isset($_GET['state']) && $_GET['state'] == 'Rechazada' ? 'active' : '' ?>" name="state" value="Rechazada" type="submit">Rechazados</button></li>
            <li class="nav-item"><button class="nav-link text-info <?php echo isset($_GET['state']) && $_GET['state'] == 'Completado' ? 'active' : '' ?>" name="state" value="Completado" type="submit">Completados</button></li>
        </ul>
    <?php
}