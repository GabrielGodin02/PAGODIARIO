<?php
$sql = "SELECT id_usuario, email, prestamo.direccion as direccion, telefono,dia_solicitado, hora, cantida_prestamo, prestamo.estado as p_estado  
FROM registro, prestamo 
WHERE id_usuario=ident";
$query = mysqli_query($conexion, $sql);
$row = mysqli_fetch_array($query);
?>

<main class="main">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">direccion</th>
                <th scope="col">Telefono</th>
                <th scope="col">Dia de prestamo</th>
                <th scope="col">Hora</th>
                <th scope="col">Monto a Solicitar</th>
                <th scope="col">Solicitud</th>
            </tr>
        </thead>

        <tbody>
            <?php
            if ($row != null) {
                do {
            ?>
                    <tr>
                        <td><?php echo $row['direccion'] ?></td>
                        <td><?php echo $row['telefono'] ?></td>
                        <td><?php echo $row['dia_solicitado'] ?></td>
                        <td><?php echo $row['hora'] ?></td>
                        <td>$<?php echo $row['cantida_prestamo'] ?></td>
                        <td><?php echo $row['p_estado'] ?></td>
                    </tr>

            <?php
                } while ($row = mysqli_fetch_array($query));
            }
            ?>
        </tbody>

    </table>

</main>