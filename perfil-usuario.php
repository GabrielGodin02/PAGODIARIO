<?php include('./php/auth.php'); ?>

<!DOCTYPE html>
<html lang="en">
<?php include_once('./componentes/head.php'); ?>

<body>
    <?php include_once('./componentes/user-header.php'); ?>
    <main>
        <h3 class="vista-titulo">Perfil de usuario</h3>
        <div class="container">
            <form action='php/actualizar_informacion_usuario.php' method='POST'>
                <div class="ordenar-inf">
                    <div>
                        <input type="text" class="form-control" disabled value="<?php echo $_SESSION['user']['nombre'] ?>" name="nombre">
                    </div>
                    <div>
                        <input type="text" class="form-control" disabled value="<?php echo $_SESSION['user']['apellidos'] ?>" name="apellidos">
                    </div>
                </div>
                <div class="ordenar-inf">
                    <div>
                        <input type="email" class="form-control" disabled value="<?php echo $_SESSION['user']['email'] ?>" name="email">
                    </div>
                    <div>
                        <input type="date" class="form-control" disabled value="<?php echo $_SESSION['user']['fecha'] ?>" name="fecha">
                    </div>
                </div>
                <div class="ordenar-inf">
                    <div>
                        <button class="boton_usuario activate" type="button" onclick="switchEditMode()">Editar</button>
                    </div>
                    <div>
                        <button class="boton_usuario" type="submit" name="save" value="save">Guardar</button>
                    </div>
                    <div>
                        <button class="boton_usuario cancel" type="button" onclick="switchEditMode()">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <script>
        let editMode = false;
        const switchEditMode = () => {
            editMode = !editMode;
            document.querySelectorAll(".form-control").forEach((input) => input.disabled = !editMode);
            document.querySelectorAll("button").forEach((button) => {

            })
        };
    </script>
</body>

</html>