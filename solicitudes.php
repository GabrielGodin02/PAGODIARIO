<?php
    include 'php/conexion.php';
    $sql = "SELECT  cantida_prestamo,dia_solicitado,prestamo.estado  FROM prestamo WHERE id_usuario=id_usuario";
    $query = mysqli_query($conexion,$sql);
    $row = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
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