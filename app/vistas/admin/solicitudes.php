<?php
$sql =
    "SELECT 
        id_usuario, nombre, prestamo.direccion as direccion, email, 
        telefono, id_prestamo,dia_solicitado, hora,cantidad, cantida_prestamo, 
        profesion, fecha_solicitud, prestamo.estado as estado
     FROM registro, prestamo 
     WHERE id_usuario=ident";
$query = mysqli_query($conexion, $sql);
$row = mysqli_fetch_array($query);
?>

<main class="main">
    <h3 class="vista-titulo">Control de Solicitudes</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <td colspan="11" class="search-cell">
                    <form action="" onsubmit="filter(event)">
                        <span>Consultar por numero de documento</span>
                        <input type="text" name="search" onchange="filter()">
                        <button type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                </td>
            </tr>
            <tr>
                <th scope="col">Identificación</th>
                <th scope="col">Nombre</th>
                <th scope="col">Email</th>
                <th scope="col">direccion</th>
                <th scope="col">Telefono</th>
                <th scope="col">Dia de prestamo</th>
                <th scope="col">Hora</th>
                <th scope="col">cantidad</th>
                <th scope="col">Monto a Solicitar Interes</th>
                <th scope="col">Profesión</th>
                <th scope="col">fecha de solicitud</th>
                <th></th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <?php
            if ($row != null) {
                do {
            ?>
                    <tr class="usuario">
                        <td><input class="ident" type="text" class="hidden" disabled readonly value="<?php echo $row['id_usuario'] ?>"></td>
                        <td><?php echo $row['nombre'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo $row['direccion'] ?></td>
                        <td><?php echo $row['telefono'] ?></td>
                        <td><?php echo $row['dia_solicitado'] ?></td>
                        <td><?php echo $row['hora'] ?></td>
                        <td><?php echo $row['cantidad'] ?></td>
                        <td>$<?php echo $row['cantida_prestamo'] ?></td>
                        <td><?php echo $row['profesion'] ?></td>
                        <td><?php echo $row['fecha_solicitud'] ?></td>
                        <td><a href="javascript:void(0);" class="botona" onclick="abrirModal('<?php echo $row['id_prestamo']; ?>')">Abonar</a></td>
                        <td><a href="./php/borrar.php?id=<?php echo $row['id_prestamo'] ?>" class="botona">Borrar</a></td>
                        <td>
                            <form action='/admin/control-solicitudes/update' method='POST' class="sele">
                                <input type="hidden" name="id_prestamo" value="<?php echo $row['id_prestamo']; ?>">
                                <select name="estado" id="opcion_<?php echo $row['id_prestamo']; ?>" onchange="this.form.submit()">
                                    <?php
                                    $estados = [
                                        'Pendiente' => 'Pendiente',
                                        'Aceptada' => 'Aceptada',
                                        'Rechazada' => 'Rechazada',
                                    ];
                                    foreach ($estados as $estado => $estadoMayus) {
                                        echo ('<option ' . ($estado ==  $row["estado"] ? " selected " : " ") . 'value="' . $estado . '">' . $estadoMayus . '</option>');
                                    }
                                    ?>
                                </select>
                            </form>
                        </td>
                    </tr>

            <?php
                } while ($row = mysqli_fetch_array($query));
            }
            ?>
        </tbody>
    </table>
</main>
<script>
    function filter(ev) {
        ev.preventDefault();
        document.querySelectorAll(".usuario").forEach(usuario => {
            usuario.querySelector(".ident").value.includes(ev.target[0].value) ?
                usuario.classList.remove("hidden") :
                usuario.classList.add("hidden");
        });
    }
</script>