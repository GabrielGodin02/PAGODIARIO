<?php include('./php/auth.php')?>

<!DOCTYPE html>
<html lang="en">
<?php include_once('./componentes/head.php');?>
<body>
<?php include_once('./componentes/user-header.php');?>
    <main>
        <h3 class="vista-titulo">Perfil de usuario</h3>
        <div class="container">
            <form action='php/actualizar_informacion_usuario.php' method='GET'>
                <div class="ordenar-inf">
                    <div>
                     <input type="text" class="form-control" value="<?php echo $_SESSION['user']['nombre'] ?>">
                    </div>
                    <div>
                     <input type="text" class="form-control" value="<?php echo $_SESSION['user']['apellidos'] ?>">
                    </div>
                </div>
                <div class="ordenar-inf">
                    <div>
                     <input type="email" class="form-control" value="<?php echo $_SESSION['user']['email'] ?>">
                    </div>
                    <div>
                     <input type="date" class="form-control" value="<?php echo $_SESSION['user']['fecha'] ?>">
                    </div>
                </div>
                <button class="boton_usuario">Registrar</button>
            </form>
        </div>
    </main>
</body>
</html>