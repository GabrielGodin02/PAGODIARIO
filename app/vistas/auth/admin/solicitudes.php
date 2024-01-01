<main class="main">
    <h3 class="vista-titulo">Control de Solicitudes</h3>
    <table class="table table-striped mt-0">
        <form action="" method="get">
            <?php FilterOptionsComponent() ?>
            <thead>
                <tr>
                    <td colspan="11" class="search-cell">
                        <span>Consultar por numero de documento</span>
                        <input type="number" name="search">
                        <button type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <th class="estado"></th>
                    <th scope="col">Documento</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Solicita</th>
                    <th scope="col">Deuda</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Profesión</th>
                    <th scope="col">fecha de solicitud</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
        </form>

        <tbody>
            <?php
            if (count($soli->solicitudes)) {
                foreach ($soli->solicitudes as $solicitud) {
            ?>
                    <tr class="usuario">
                        <td class="estado <?php echo strtolower($solicitud['estado']) ?>"></td>
                        <th scope="row" class="ident"><?php echo $solicitud['ident'] ?></th>
                        <td><?php echo $solicitud['nombre'] . " " . $solicitud['apellidos'] ?></td>
                        <td <?php
                            if ($solicitud['estado'] === "pendiente" && $_SESSION['user']['capital'] < $solicitud['cantidad']) {
                            ?> class="text-danger" <?php } ?>>$<?php echo $solicitud['cantidad'] ?>
                        </td>
                        <td>
                            <?php
                            if ($solicitud['estado'] != "Rechazada" && $solicitud["estado"] != "pendiente") {
                            ?> $<?php echo $solicitud['deuda'] < 0 ? 0 : $solicitud['deuda'];
                            } else echo "---"
                                ?>
                        </td>
                        <td><?php echo $solicitud['direccion'] ?></td>
                        <td><?php echo $solicitud['telefono'] ?></td>
                        <td><?php echo $solicitud['profesion'] ?></td>
                        <td><?php echo $solicitud['fecha_solicitud'] ?></td>
                        <td class="text-center table-hover dropdown">
                            <?php if ($solicitud['estado'] === "Aceptada" || $solicitud['estado'] === "pendiente") { ?>
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                <form action='/admin/control-solicitudes/update' method='POST' class="dropdown-menu p-2 row">
                                    <input type="hidden" name="id_prestamo" value="<?php echo $solicitud['id_prestamo']; ?>">
                                    <?php
                                    if ($solicitud['estado'] === "pendiente") {
                                        if ($_SESSION['user']['capital'] >= $solicitud['cantidad']) { ?>
                                            <button class="btn btn-success d-flex justify-content-between align-items-center mb-2" name="estado" value="Aceptada"><i class="fa fa-check me-2"></i>Aceptar</button>
                                        <?php } ?>
                                        <button class="btn btn-danger d-flex justify-content-between align-items-center" data-bs-toggle="modal" type="button" onclick="setConfirmRejectId(<?php echo $solicitud['id_prestamo'] ?>)" data-bs-target="#confirmRechazar"><i class="fa fa-trash me-2"></i>Rechazar</button>
                                    <?php } ?>
                                    <?php if ($solicitud['estado'] === "Aceptada") { ?>
                                        <button class="btn btn-danger d-flex justify-content-between align-items-center mb-2" data-bs-toggle="modal" type="button" onclick="setConfirmRejectId(<?php echo $solicitud['id_prestamo'] ?>)" data-bs-target="#confirmRechazar">Retirar<i class="fa fa-trash"></i></button>
                                        <button class="btn btn-success d-flex justify-content-between align-items-center mb-2" name="estado" type="button" onclick="abrirModalAbono(<?php echo $solicitud['id_prestamo'] ?>)">Abonar<i class="fa fa-money"></i></button>
                                        <button class="btn btn-info d-flex justify-content-between align-items-center mb-2" type="button" onclick="setConfirmCompleteId(<?php echo $solicitud['id_prestamo'] ?>)" data-bs-toggle="modal" data-bs-target="#confirmCompletar">Completar<i class="fa fa-check"></i></button>
                                    <?php } ?>
                                </form>
                            <?php } ?>
                        </td>
                    </tr>

                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="10">
                        <?php NoRegistrosComponent() ?>
                    </td>
                </tr>
            <?php
            } ?>
        </tbody>
    </table>
</main>

<?php include 'app/componentes/modals.php' ?>