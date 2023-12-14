<?php
$sql = "SELECT  cantidad, deuda, fecha_solicitud,prestamo.estado  FROM prestamo WHERE id_usuario=" . $_SESSION['user']['ident'];
$query = hacerConsulta($sql);
$row = mysqli_fetch_array($query);
?>
<main>
    <h2 class="vista-titulo">Historial de Prestamos</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Prestamo</th>
                <th scope="col">Deuda</th>
                <th scope="col">Fecha de solicitud</th>
                <th scope="col">Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($row != null) {
                do {
            ?>
                    <tr>
                        <td>$<?php echo $row['cantidad'] ?></td>
                        <td>$<?php echo $row['deuda'] ?></td>
                        <td><?php echo date("d-m-Y", strtotime($row['fecha_solicitud'])) ?></td>
                        <td><span class="estado <?php echo strtolower($row['estado']) ?>"><?php echo ($row['estado']) ?></span> </td>
                    </tr>

            <?php
                } while ($row = mysqli_fetch_array($query));
            }
            ?>
        </tbody>
    </table>
</main>