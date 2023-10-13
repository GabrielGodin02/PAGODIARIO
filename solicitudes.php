<?php
    include 'php/conexion.php';
    $sql = "SELECT  cantida_prestamo,dia_solicitado,prestamo.estado  FROM prestamo WHERE id_usuario=id_usuario";
    $query = mysqli_query($conexion,$sql);
    $row = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once('./componentes/head.php') ?>
<body>
    <?php include_once('./componentes/user-header.php') ?>
    <main>
        <table class="table table-striped" >
            <thead>
                <tr>
                    <th scope="col">Monto</th>
                    <th scope="col">Dia solicitante</th>
                    <th scope="col">Solicitud</th>
                </tr>
            </thead>
           
            <tbody>
        <?php 
         if($row !=null){
            do{
        ?>
            <tr>
                <td><?php echo $row ['cantida_prestamo']?></td>
                <td><?php echo $row ['dia_solicitado']?></td>
                <td><?php echo $row ['estado']?></td>
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