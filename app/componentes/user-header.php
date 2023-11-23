<header>
    <?php
    $links = [
        'Iniciar sesion' => '/',
        'Registrarse' => '/registro',
    ];
    $user_links = [
        'Mi perfil' => 'perfil-usuario.php',
        'Solicitar' => 'panel-control-usuario.php',
        'Mis solicitudes' => 'vistas/solicitudes-deudor.php',
    ];
    $admin_links = [
        'Mi perfil' => 'perfil-usuario.php',
        'Solicitar' => 'panel-control-usuario.php',
        'Solicitudes' => 'solicitudes-usuario.php',
        'Control solicitudes' => 'vistas/admin/admin.php',
    ];
    if ($_SESSION['user']) $links = $admin_links;
    if ($_SESSION['user']['admin']) $links = $admin_links;
    ?>
    <nav>
        <div class="container">
            <div class="logo" onclick="toggleList()">
                <img src="public/img/usuario.png">
            </div>
            <?php if ($_SESSION['user']){ ?>
            <h4 class='ident'>
                    <?php echo $_SESSION['user']['nombre'] . ' ' . $_SESSION['user']['apellidos'] . ($_SESSION['user']['admin'] ? ' | Admin' : ' | User') ?> 
                </h4>
            <?php } ?>
            <ul class="lista">
                <?php foreach ($links as $key => $value) { ?>
                    <li class="<?php echo ($uri == $value) ? 'selected' : '' ?>"><a href="<?php echo $value ?>"><?php echo $key ?></a></li>
                <?php } ?>
            <?php if ($_SESSION['user']){ ?>
                <li><a href="./php/logout.php">Log Out</a></li>
            <?php } ?>
            </ul>
        </div>
    </nav>
</header>