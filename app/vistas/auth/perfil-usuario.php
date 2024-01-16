<main class="pb-4">
    <div class="row m-4">
        <div class="container-sm card pb-4 col-md-3">
            <h4 class="vista-titulo"><i class="fa fa-user"></i> Perfil</h4>
            <div class="container">
                <h5 class="text-center mb-2">
                    <?php echo $_SESSION['user']['nombre'] ?>
                    <?php echo $_SESSION['user']['apellidos'] ?>
                </h5>
                <div class="text-center">
                    <?php echo $_SESSION['user']['ident'] ?>
                </div>
                <div class="text-center">
                    <?php
                    // Fecha de nacimiento en formato 'Y-m-d'
                    $fechaNacimiento = $_SESSION['user']['fecha'];

                    // Crea un objeto DateTime con la fecha de nacimiento
                    $fechaNacimiento = new DateTime($fechaNacimiento);

                    // Obtiene la fecha actual
                    $fechaActual = new DateTime();

                    // Calcula la diferencia entre las fechas
                    $diferencia = $fechaActual->diff($fechaNacimiento);

                    // Obtiene la edad
                    $edad = $diferencia->y;

                    // Imprime la edad
                    echo $edad;
                    ?> Años (<?php echo $fechaNacimiento->format('Y'); ?>)
                </div>
            </div>
        </div>
        <div class="container-sm card pb-4 col-md-9">
            <h3 class="vista-titulo"><i class="fa fa-phone"></i> Informacion de contacto</h3>
            <div class="container">
                <form action='' method='POST' id="user-edit-form">
                    <div class="form-floating mb-2"><input type="email" class="form-control" id="email" disabled value="<?php echo $_SESSION['user']['email'] ?>" name="email"><label for="email">Correo electronico</label></div>
                    <div class="form-floating mb-2"><input type="text" class="form-control" disabled value="<?php echo $_SESSION['user']['profesion'] ?>" name="profesion"><label for="profesion">Profesión</label></div>
                    <div class="form-floating mb-2"><input type="text" class="form-control" disabled value="<?php echo $_SESSION['user']['direccion'] ?>" name="direccion"><label for="fecha">Direccion</label></div>
                    <div class="form-floating mb-2"><input type="number" class="form-control" disabled value="<?php echo $_SESSION['user']['telefono'] ?>" name="telefono"> <label for="telefono">Telefono</label></div>
                    <div class="form-floating mb-2">
                        <select class="form-control" name="estado" disabled>
                            <?php
                            $estados = [
                                'solter@' => 'Solter@',
                                'casad@' => 'Casad@',
                                'union libre' => 'Union libre',
                            ];
                            foreach ($estados as $estado => $estadoMayus) {
                                echo ('<option ' . ($estado ==  $_SESSION['user']['estado'] ? " selected " : " ") . 'value="' . $estado . '">' . $estadoMayus . '</option>');
                            }
                            ?>
                        </select>
                        <label for="estado">Estado civil</label>
                    </div>
            </div>
            <div class="row mt-2 px-3">
                <div class="col">
                    <button class="btn btn-primary switch activate" type="button" onclick="switchEditMode()">Editar</button>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-secondary hidden switch me-md-2" type="reset" onclick="switchEditMode()">Cancelar</button>
                    <button class="btn btn-primary hidden switch" type="submit" name="save" value="save">Guardar</button>
                </div>
            </div>
            </form>
        </div>
        <?php if ($_SESSION["user"]["admin"]) { ?>
            <div class="card p-3 col-sm-6">
                <div class="row">
                    <span class="fs-4 fw-200 col-auto input-text"><i class="fa fa-money"></i> Mi Capital : </span>
                    <form action="" id="capital-edit-form" method="post" class="input-group">
                        <span class="input-group-text fs-3" id="addon1">$</span>
                        <input class="fs-4 align-middle text-secondary form-control fc-secondary col-auto" name="capital" value="<?php echo $_SESSION['user']['capital'] ?>" disabled>
                        <button type="button" class="input-group-text btn switch2 btn-primary" id="addon2" onclick="switchEditMode2()"><i class="fa fa-edit"></i></button>
                        <button type="reset" class="input-group-text btn switch2 hidden btn-secondary" id="addon3" onclick="switchEditMode2()"><i class="fa fa-rotate-right"></i></button>
                        <button type="submit" class="input-group-text btn switch2 hidden btn-success" id="addon4"><i class="fa fa-check"></i></button>
                    </form>
                    <?php if ($_SESSION["user"]["admin"] && $_SESSION["user"]["capital"] < 10000) { ?>
                        <span class="text-danger col-auto align-middle">Con tu capital actual no puedes realizar prestamos</span>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
        <div class="d-grid col-sm-<?php echo $_SESSION["user"]["admin"] ? 6 : 12 ?> p-0">
            <a href="cambiar-contrasenia" class="fs-4 p-3 col-sm-12 btn btn-danger">
                <i class="fa fa-lock"></i> Cambiar Contraseña
            </a>
            <a href="/recuperacion" class="fs-4 p-3 col-sm-12 btn btn-warning">
                <i class="fa fa-warning"></i> Olvide mi Contraseña
            </a>
        </div>
    </div>

</main>
<script>
    let editMode = false;
    const switchEditMode = () => {
        editMode = !editMode;
        document.querySelector('#user-edit-form').querySelectorAll(".form-control").forEach((input) => input.disabled = !editMode);
        document.querySelectorAll(".switch").forEach((button) => {
            button.classList.contains("hidden") ? button.classList.remove("hidden") : button.classList.add("hidden")
        })
    };
    let editMode2 = false;
    const switchEditMode2 = () => {
        editMode2 = !editMode2;
        document.querySelector('#capital-edit-form').querySelectorAll(".form-control").forEach((input) => input.disabled = !editMode2);
        document.querySelectorAll(".switch2").forEach((button) => {
            button.classList.contains("hidden") ? button.classList.remove("hidden") : button.classList.add("hidden")
        })
    };
</script>