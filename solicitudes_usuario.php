<?php
    include 'php/conexion.php';
    $sql = "SELECT id_usuario, email, direccion, telefono,dia_solicitado, hora, cantida_prestamo  FROM registro, prestamo WHERE id_usuario=ident";
    $query = mysqli_query($conexion,$sql);
    $row = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <header>
        <nav>
            
        </nav>
    </header>
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
                <td><?php echo $row ['cantida_prestamo']?></td>
                <td><?php echo $row ['cantida_prestamo']?></td>
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