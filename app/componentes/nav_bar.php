<body>
<header>
    <?php
    $links = [
        'Iniciar sesion' => ['vista' => '/formulario-login', 'icono' => 'fa'],
        'Registrarse' => ['vista' => '/formulario-registro', 'icono' => 'fa'],
    ];
    $user_links = [
        'Mi perfil' => ['vista' => 'perfil-usuario.php', 'icono' => 'fa'],
        'Solicitar' =>  ['vista' => 'panel-control-usuario.php', 'icono' => 'fa'],
        'Mis solicitudes' => ['vista' => 'vistas/solicitudes-deudor.php', 'icono' => 'fa']
    ];
    $admin_links = [
        'Mi perfil' => ['vista' => 'perfil-usuario.php', 'icono' => 'fa'],
        'Solicitar' => ['vista' => 'panel-control-usuario.php', 'icono' => 'fa'],
        'Solicitudes' => ['vista' => 'solicitudes-usuario.php', 'icono' => 'fa'],
        'Control solicitudes' => ['vista' => 'vistas/admin/admin.php', 'icono' => 'fa']
    ];
    if ($_SESSION['auth']) $links = $admin_links;
    if ($_SESSION['auth'] && $_SESSION['user']['admin']) $links = $admin_links;
    ?>
    <nav>
        <div class="container">
            <div class="logo" onclick="toggleList()">
                <img src="public/img/usuario.png">
            </div>
            <?php if ($_SESSION['auth']) { ?>
                <h4 class='ident'>
                    <?php echo $_SESSION['user']['nombre'] . ' ' . $_SESSION['user']['apellidos'] . ($_SESSION['user']['admin'] ? ' | Admin' : ' | User') ?>
                </h4>
            <?php } ?>
            <ul class="lista">
                <?php foreach ($links as $titulo => $ruta) { ?>
                    <li class="<?php echo ($uri == $ruta['vista']) ? 'selected' : '' ?>">
                        <!--<i class="fa fa-lock "></i>-->
                        <a href="<?php echo $ruta['vista'] ?>"><?php echo $titulo ?></a>
                    </li>
                <?php } ?>
                <?php if ($_SESSION['auth']) { ?>
                    <li><a href="./php/logout.php">Log Out</a></li>
                <?php } ?>
            </ul>
        </div>
    </nav>
</header>