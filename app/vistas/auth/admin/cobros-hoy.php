<main class="main">
    <h3 class="vista-titulo">Cobros del dia</h3>
    <?php
    if (count($cobros)) {
        foreach ($cobros as $key => $cobro) {
    ?>
            <div class="card mini-deuda">
                <div class="card-header">
                    <span class="fw-bold fs-4"><?php echo $cobro["nombre"] . ' ' . $cobro["apellidos"] ?></span>
                    <div><span class="card-data"><?php echo $cobro["direccion"] ?></span></div>
                    <div><span class="card-data"><?php echo $cobro["telefono"] ?></span></div>
                </div>
                <div class="card-body">
                    <div class="card-data">Solicitó: $<?php echo $cobro["cantidad"] ?></div>
                    <div class="card-data">Debe: $<?php echo $cobro["deuda"] ?></div>
                    <div class="card-data">Hoy paga: $<?php echo ((float) $cobro["cantidad"]) * 0.20 ?></div>
                </div>
                <div class="card-footer ">
                    <button class="btn btn-secondary" onclick="abrirModalAbono(<?php echo $cobro['id_prestamo'] ?>)">Abonar</button>
                    <button class="btn btn-danger" onclick="abrirModalExcusa(<?php echo $cobro['id_prestamo'] ?>)">Hoy no abona</button>
                </div>
            </div>
    <?php
        }
    } else {
        NoRegistrosComponent("No quedan cobros para hoy");
    }
    ?>
</main>
<?php include 'app/componentes/modals.php' ?>