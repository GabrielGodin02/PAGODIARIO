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
                <th scope="col">Nombre</th>
                <th scope="col">Solicita</th>
                <th scope="col">direccion</th>
                <th scope="col">Telefono</th>
                <th scope="col">Profesión</th>
                <th scope="col">fecha de solicitud</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php
            foreach ($soli->solicitudes as $solicitud) {
            ?>
                <tr class="usuario">
                    <td><?php echo $solicitud['nombre']." ".$solicitud['apellidos'] ?></td>
                    <th scope="row">$<?php echo $solicitud['cantidad'] ?></th>
                    <td><?php echo $solicitud['direccion'] ?></td>
                    <td><?php echo $solicitud['telefono'] ?></td>
                    <td><?php echo $solicitud['profesion'] ?></td>
                    <td><?php echo $solicitud['fecha_solicitud'] ?></td>
                    <td>
                        <form action='/admin/control-solicitudes/update' method='POST' class="row gap-2 mx-2">
                            <input type="hidden" name="id_prestamo" value="<?php echo $solicitud['id_prestamo']; ?>">
                            <button class="btn btn-danger col-auto" name="estado" value="Rechazada"><i class="fa fa-trash"></i></button>
                            <button class="btn btn-success col-auto" name="estado" value="Aceptada"><i class="fa fa-check"></i></button>
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