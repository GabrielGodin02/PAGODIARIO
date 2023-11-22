<?php
include('./php/auth.php');
checkAdmin();
?>

<?php
    include './php/conexion.php';
    $sql = "SELECT id_usuario, nombre, email, direccion, telefono,dia_solicitado, hora, cantida_prestamo  FROM registro, prestamo WHERE id_usuario=ident";
    $query = mysqli_query($conexion,$sql);
    $row = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once('./componentes/head.php') ?>
<body>
    <form action="" method="">
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="card-link">Card link</a>
            <a href="#" class="card-link">Another link</a>
        </div>
    </div>
    </form>
</body>
</html>