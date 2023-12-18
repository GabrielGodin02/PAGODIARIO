<main>
    <h2 class="vista-titulo">Historial de Prestamos</h2>
    <table class="table table-striped text-center">
        <thead>
            <tr>
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
            foreach ($prestamos as $row) { ?>
                <tr>
                    <th scope="row"><?php echo $row['pagodiario'] ?></th>
                    <td scope="row">$<?php echo $row['cantidad'] ?></td>
                    <td>$<?php echo $row['deuda'] ?></td>
                    <td><?php echo date("d-m-Y", strtotime($row['fecha_solicitud'])) ?></td>
                    <td <?php if ($row["estado"] != "Aceptada") { ?>class="row" <?php } ?>>
                        <?php if ($row["estado"] != "Aceptada") { ?>
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
            <?php } ?>
        </tbody>
    </table>
</main>