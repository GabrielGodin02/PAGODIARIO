<main>
    <h2 class="vista-titulo">Historial de Prestamos</h2>
    <form action="" method="get">
        <?php // FilterOptionsComponent() ?>
    </form>
    <table class="table mt-0 table-striped text-center">
        <thead>
            <tr>
                <th></th>
                <th scope="col">Pagodiario</th>
                <th scope="col">Prestamo</th>
                <th scope="col">Deuda</th>
                <th scope="col">Fecha de solicitud</th>
                <th scope="col">Acciones</th>
                <th scope="col">Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($prestamos)) {
                foreach ($prestamos as $row) { ?>
                    <tr>
                        <td class="estado <?php echo strtolower($row['estado']) ?>"></td>
                        <th scope="row"><?php echo $row['pagodiario'] ?></th>
                        <td scope="row">$<?php echo $row['cantidad'] ?></td>
                        <td>$<?php echo $row['deuda'] < 0 ? 0 : $row['deuda'] ?></td>
                        <td><?php echo date("d-m-Y", strtotime($row['fecha_solicitud'])) ?></td>
                        <td <?php if ($row["estado"] == "pendiente") { ?>class="row" <?php } ?>>
                            <?php if ($row["estado"] == "pendiente") { ?>
                                <a href="/deudor/mis-solicitudes/delete?soli=<?php echo $row["id_prestamo"] ?>" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            <?php } ?>
                        </td>
                        <td class="p-2">
                            <div class="row px-3">
                                <span class="estado <?php echo strtolower($row['estado']) ?> py-2 rounded"><?php echo ($row['estado']) ?>
                                </span>
                            </div>
                        </td>
                    </tr>
            <?php }
            } else {
                NoRegistrosComponent();
            } ?>
        </tbody>
    </table>
</main>