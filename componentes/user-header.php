<header>
    <?php
    $_url = $_SERVER["REQUEST_URI"];
    $split_url = explode("/", $_url);
    $current_dir =  end($split_url);

    $links = [
        'Mi perfil' => 'perfil-usuario.php',
        'Solicitar' => 'panel-control-usuario.php',
        'Mis solicitudes' => 'solicitudes.php',
    ];
    $admin_links = [
        'Mi perfil' => 'perfil-usuario.php',
        'Solicitar' => 'panel-control-usuario.php',
        'Solicitudes' => 'solicitudes-usuario.php',
        'Control solicitudes' => 'admin.php',
    ];
    if ($_SESSION['user']['admin']) $links = $admin_links;
    ?>
    <nav>
        <div class="container">
            <div class="logo" onclick="toggleList()">
                <img src="img/usuario.png">
            </div>
            <h4 class='ident'><?php echo $_SESSION['user']['nombre'] . ' ' . $_SESSION['user']['apellidos'] . ($_SESSION['user']['admin'] ? ' | Admin' : ' | User') ?></h4>
            <ul class="lista">
                <?php foreach ($links as $key => $value) { ?>
                    <li class="<?php echo ($current_dir == $value) ? 'selected' : '' ?>"><a href="<?php echo $value ?>"><?php echo $key ?></a></li>
                <?php } ?>
                <li><a href="./php/logout.php">Log Out</a></li>
            </ul>
        </div>
    </nav>
</header>