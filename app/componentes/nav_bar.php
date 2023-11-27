<body>
    <header>
        <nav>
            <div class="container">
                <div class="logo" onclick="toggleList()">
                    <img src="/public/img/usuario.png">
                </div>
                <?php if (isset($_SESSION['auth'])) { ?>
                    <h4 class='ident'>
                        <?php echo $_SESSION['user']['nombre'] . ' ' . $_SESSION['user']['apellidos'] . ($_SESSION['user']['admin'] ? ' | Admin' : ' | Deudor') ?>
                    </h4>
                <?php } ?>
                <ul class="lista">
                    <?php foreach ($routes as $route => $data) {
                        if (
                            (!isset($_SESSION["auth"]) && !uriRequiresLogin($route)) ||
                            (isset($_SESSION["auth"]) && !$_SESSION['admin'] && uriRequiresDeudor($route)) ||
                            (isset($_SESSION["auth"]) && $_SESSION['admin'] && uriRequiresAdmin($route)) 
                        ) { ?>
                            <li class="<?php echo ($uri == $route) ? 'selected' : '' ?>">
                                <!--<i class="fa fa-lock "></i>-->
                                <a href="<?php echo $route ?>"><?php echo $data['alias'] ?></a>
                            </li>
                        <?php }
                    }
                    if (isset($_SESSION['auth'])) { ?>
                        <li><a href="/logout">Log Out</a></li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
    </header>