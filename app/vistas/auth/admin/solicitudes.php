<main class="main">
    <h3 class="vista-titulo">Control de Solicitudes</h3>
    
    <table class="table table-striped table-hover mt-0">
        <form action="" method="get">
            <ul class="nav nav-tabs">
                <li class="nav-item"><button class="nav-link text-secondary <?php echo isset($_GET['state']) && $_GET['state'] == 'pendiente' ? 'active' : '' ?>" name="state" value="pendiente"  type="submit">Pendientes</button></li>
                <li class="nav-item"><button class="nav-link text-success <?php echo isset($_GET['state']) && $_GET['state'] == 'Aceptada' ? 'active' : '' ?>" name="state" value="Aceptada" type="submit">Aceptados</button></li>
                <li class="nav-item"><button aria-selected="true" class="nav-link text-danger <?php echo isset($_GET['state']) && $_GET['state'] == 'Rechazada' ? 'active' : '' ?>" name="state" value="Rechazada" type="submit">Rechazados</button></li>
                <li class="nav-item"><button class="nav-link text-info <?php echo isset($_GET['state']) && $_GET['state'] == 'Completado' ? 'active' : '' ?>" name="state" value="Completado" type="submit">Completados</button></li>
            </ul>
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
                    <th scope="col">Documento</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Solicita</th>
                    <th scope="col">direccion</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Profesión</th>
                    <th scope="col">fecha de solicitud</th>
                    <th>Acciones</th>
                </tr>
            </thead>
        </form>
            
        <tbody>
            <?php
            foreach ($soli->solicitudes as $solicitud) {
            ?>
                <tr class="usuario">
                    <th scope="row" class="ident"><?php echo $solicitud['ident'] ?></th>
                    <td><?php echo $solicitud['nombre'] . " " . $solicitud['apellidos'] ?></td>
                    <td <?php if ($_SESSION['user']['capital'] < $solicitud['cantidad']) { ?> class="text-danger" <?php } ?>>$<?php echo $solicitud['cantidad'] ?></td>
                    <td><?php echo $solicitud['direccion'] ?></td>
                    <td><?php echo $solicitud['telefono'] ?></td>
                    <td><?php echo $solicitud['profesion'] ?></td>
                    <td><?php echo $solicitud['fecha_solicitud'] ?></td>
                    <td>
                        <form action='/admin/control-solicitudes/update' method='POST' class="row gap-2 mx-2">
                            <input type="hidden" name="id_prestamo" value="<?php echo $solicitud['id_prestamo']; ?>">
                            <button class="btn btn-danger col-auto" name="estado" value="Rechazada"><i class="fa fa-trash me-2"></i>Rechazar</button>
                            <?php if ($_SESSION['user']['capital'] >= $solicitud['cantidad']) { ?>
                                <button class="btn btn-success col-auto" name="estado" value="Aceptada"><i class="fa fa-check me-2"></i>Aceptar</button>
                            <?php } ?>
                        </form>
                    </td>
                </tr>

            <?php
            }
            ?>
        </tbody>
    </table>
</main>