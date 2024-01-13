<main class="container pt-4">
    <div class="card">
        <div class="card-header fs-2">
            Cambia tu contraseña aquí
        </div>
        <div class="card-body">
            <?php
            global $auth;
            if ($_GET['email'] && $_GET['token']) {
                $email = $_GET['email'];
                $token = $_GET['token'];

                $query = hacerConsulta("SELECT * FROM registro WHERE reset_token=? and email=?", [$token, $email]);

                $current_date = date("Y-m-d H:i:s");

                if (mysqli_num_rows($query) > 0) {

                    $row = mysqli_fetch_array($query);

                    if ($row['expiry_date'] >= $current_date) { ?>
                        <form action="" method="post">
                            <div class="mb-3 form-floating"><input class="form-control" id="new" type="password" name="new"><label for="new">Nueva Contraseña</label></div>
                            <div class="mb-3 form-floating"><input class="form-control" id="confirm_new" type="password" name="confirm_new"><label for="confirm_new">Confirmar Contraseña</label></div>
                            <div class="d-grid gap-2">
                                <button class="btn btn-success btn-lg"><i class="fa fa-key"></i> Enviar</button>
                            </div>
                        </form>
            <?php } else echo "<p>Este link de recuperacion ha expirado</p>";
                } else echo "<p>Este link de recuperacion ha expirado</p>";
            }
            ?>
        </div>
    </div>
</main>