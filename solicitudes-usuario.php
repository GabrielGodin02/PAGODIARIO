<?php 
include ('php/auth.php');
?>
<?php
    include 'php/conexion.php';
    $sql = "SELECT id_usuario, email, direccion, telefono,dia_solicitado, hora, cantida_prestamo  FROM registro, prestamo WHERE id_usuario=ident";
    $query = mysqli_query($conexion,$sql);
    $row = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once('./componentes/head.php') ?>
<body>
    <?php include_once('./componentes/user-header.php') ?>
    <main class="main">
        <table class="table table-striped" >
            <thead>
                <tr>
                    <th scope="col">direccion</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Dia de prestamo</th>
                    <th scope="col">Hora</th>
                    <th scope="col">Monto a Solicitar</th>
                    <th scope="col">Solicitud</th>
                    <th></th>
                </tr>
            </thead>
           
            <tbody>
        <?php 
         if($row !=null){
            do{
        ?>
            <tr>
                <td><?php echo $row ['direccion']?></td>
                <td><?php echo $row ['telefono']?></td>
                <td><?php echo $row ['dia_solicitado']?></td>
                <td><?php echo $row ['hora']?></td>
                <td>$<?php echo $row ['cantida_prestamo']?></td>

            </tr>
           
        <?php
            }while($row=mysqli_fetch_array($query));

         }
        ?>
        </tbody>

        </table>
        
    </main>
</body>
</html>