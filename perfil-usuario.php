<?php include('./php/auth.php')?>

<!DOCTYPE html>
<html lang="en">
<?php include_once('./componentes/head.php');?>
<body>
<?php include_once('./componentes/user-header.php');?>
    <main>
        <h3 class="vista-titulo">Perfil de usuario</h3>
        <div class="container">
            <form action="">
                <input type="text" class="form-control" value="<?php echo $_SESSION['user']['nombre'] ?>">
            </form>
        </div>
    </main>
</body>
</html>