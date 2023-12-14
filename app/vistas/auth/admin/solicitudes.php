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
                <th scope="col">Solicita</th>
                <th scope="col">Deberia</th>
                <th scope="col">Profesión</th>
                <th scope="col">fecha de solicitud</th>
                <th></th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <?php
            foreach ($soli->solicitudes as $solicitud) {
            ?>
                <tr class="usuario">
                    <td><input type="text" disabled readonly value="<?php echo $solicitud['id_usuario'] ?>"></td>
                    <td><?php echo $solicitud['nombre']." ".$solicitud['apellidos'] ?></td>
                    <td><?php echo $solicitud['email'] ?></td>
                    <td><?php echo $solicitud['direccion'] ?></td>
                    <td><?php echo $solicitud['telefono'] ?></td>
                    <td>$<?php echo $solicitud['cantidad'] ?></td>
                    <td>$<?php echo $solicitud['deuda'] ?></td>
                    <td><?php echo $solicitud['profesion'] ?></td>
                    <td><?php echo $solicitud['fecha_solicitud'] ?></td>
                    <td><a href="./php/borrar.php?id=<?php echo $solicitud['id_prestamo'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                    <td>
                        <form action='/admin/control-solicitudes/update' method='POST' class="sele ">
                            <input type="hidden" name="id_prestamo" value="<?php echo $solicitud['id_prestamo']; ?>">
                            <select name="estado" id="opcion_<?php echo $solicitud['id_prestamo']; ?>" class="estado <?php echo strtolower($solicitud['estado']) ?>" onchange="this.form.submit()">
                                <?php
                                $estados = [
                                    'Pendiente' => 'Pendiente',
                                    'Aceptada' => 'Aceptada',
                                    'Rechazada' => 'Rechazada',
                                ];
                                foreach ($estados as $estado => $estadoMayus) {
                                    echo (
                                        '<option class="estado '
                                        . strtolower($estado) .'"' 
                                        . ($estadoMayus ==  $solicitud["estado"] ? " selected " : " ") 
                                        . 'value="' . $estado . '">' . $estado . '</option>'
                                    );
                                }
                                ?>
                            </select>
                        </form>
                    </td>
                </tr>

            <?php
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