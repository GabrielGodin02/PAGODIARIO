<main>
    <h3 class="vista-titulo">Perfil de usuario</h3>
    <div class="container">
        <div class="ordenar-inf">
            <div>
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" disabled value="<?php echo $_SESSION['user']['nombre'] ?>">
            </div>
            <div>
                <label for="apellidos">Apellidos</label>
                <input type="text" class="form-control" disabled value="<?php echo $_SESSION['user']['apellidos'] ?>">
            </div>
        </div>
        <div class="ordenar-inf">
            <div>
                <label for="fecha">Fecha de nacimiento</label>
                <input type="date" class="form-control" disabled value="<?php echo $_SESSION['user']['fecha'] ?>">
            </div>
            <div>
                <label for="ident">Documento</label>
                <input type="text" class="form-control" disabled value="<?php echo $_SESSION['user']['ident'] ?>">
            </div>
        </div>
    </div>
    <h4 class="vista-titulo">Informacion de contacto</h4>
    <div class="container">
        <form action='#' method='POST' id="user-edit-form">
            <div class="ordenar-inf">
                <div>
                    <label for="email">Correo electronico</label>
                    <input type="email" class="form-control" disabled value="<?php echo $_SESSION['user']['email'] ?>" name="email">
                </div>
                <div>
                    <label for="profesion">Profesión</label>
                    <input type="text" class="form-control" disabled value="<?php echo $_SESSION['user']['profesion'] ?>" name="profesion">
                </div>
            </div>
            <div class="ordenar-inf">
                <div>
                    <label for="fecha">Direccion</label>
                    <input type="text" class="form-control" disabled value="<?php echo $_SESSION['user']['direccion'] ?>" name="direccion">
                </div>
                <div>
                    <label for="estado">Estado civil</label>
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
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button class="boton_usuario activate" type="button" onclick="switchEditMode()">Editar</button>
                </div>
                <div class="col">
                    <button class="boton_usuario cancel hidden" type="reset" onclick="switchEditMode()">Cancelar</button>
                </div>
                <div class="col">
                    <button class="boton_usuario hidden" type="submit" name="save" value="save">Guardar</button>
                </div>
            </div>
        </form>
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