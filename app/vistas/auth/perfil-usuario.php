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
                <form action='#' method='POST' id="user-edit-form">
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
                    <button class="btn btn-primary activate" type="button" onclick="switchEditMode()">Editar</button>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-secondary hidden  me-md-2" type="reset" onclick="switchEditMode()">Cancelar</button>
                    <button class="btn btn-primary hidden" type="submit" name="save" value="save">Guardar</button>
                </div>
            </div>
            </form>
        </div>
        <?php if ($_SESSION["user"]["admin"]) { ?>
            <div class="card p-3 col-sm-6">
                <div class="row">
                    <span class="fs-4 fw-200 col-auto"><i class="fa fa-money"></i> Mi Capital : </span>
                    <span class="fs-4 align-middle text-secondary fc-secondary col-auto">$<?php echo $_SESSION['user']['capital'] ?></span>
                    <?php if ($_SESSION["user"]["admin"] && $_SESSION["user"]["capital"] < 10000) { ?>
                        <span class="text-danger col-auto align-middle">Con tu capital actual no puedes realizar prestamos</span>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
        <a href="cambiar-contrasenia" class="fs-4 p-3 col-sm-<?php echo $_SESSION["user"]["admin"] ? 6 : 12 ?> btn btn-danger">
            <i class="fa fa-lock"></i> Cambiar Contraseña
        </a>
    </div>

</main>
<script>
    let editMode = false;
    const switchEditMode = () => {
        editMode = !editMode;
        document.querySelector('#user-edit-form').querySelectorAll(".form-control").forEach((input) => input.disabled = !editMode);
        document.querySelectorAll("button").forEach((button) => {
            button.classList.contains("hidden") ? button.classList.remove("hidden") : button.classList.add("hidden")
        })
    };
</script>