<?php include_once('./php/auth.php') ?>

<?php
    include 'php/conexion.php';
    $sql = "SELECT id_usuario, nombre, email, direccion, telefono,dia_solicitado, hora, cantida_prestamo  FROM registro, prestamo WHERE id_usuario=ident";
    $query = mysqli_query($conexion,$sql);
    $row = mysqli_fetch_array($query);
?>


<!DOCTYPE html>
<html lang="en">
<?php include_once('./componentes/head.php') ?>
<body>
    <header>
        <nav>
            <div class="container">
                <div class="logo" onclick="toggleList()"><img src="img/usuario.png"></div>
                <ul class="lista">
                    <li><a href="">Aceptadas</a></li>
                    <li><a href="solicitudes_usuario.php">Rechazadas</a></li>
                    <li><a href="login.php"> Log Out</a></li>
                </ul>
            </div>
        </nav>
        
    </header>
    <main class="main">
        <table class="table table-striped" >
            <thead>
                <tr>
                    <th scope="col">Identificación</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Email</th>
                    <th scope="col">direccion</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Dia de prestamo</th>
                    <th scope="col">Hora</th>
                    <th scope="col">Monto a Solicitar</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
           
            <tbody>
        <?php 
         if($row !=null){
            do{
        ?>
            <tr>
                <td><?php echo $row ['id_usuario']?></td>
                <td><?php echo $row ['nombre']?></td>
                <td><?php echo $row ['email']?></td>
                <td><?php echo $row ['direccion']?></td>
                <td><?php echo $row ['telefono']?></td>
                <td><?php echo $row ['dia_solicitado']?></td>
                <td><?php echo $row ['hora']?></td>
                <td><?php echo $row ['cantida_prestamo']?></td>
                <td><a href="javascript:void(0);" class="botona" onclick="abrirModal('<?php echo $row['id_usuario']; ?>')">Abonar</a></td>
                <td><a href="php/borrar.php?id=<?php echo $row ['id_usuario']?>" class="botona">Borrar</a></td>
                <td>
                    <form action='php/guardar_seleccion.php' method='POST' class="sele">
                        <input type="hidden" name="id_usuario" value="<?php echo $row['id_usuario']; ?>">
                        <select name="estado" id="opcion_<?php echo $row['id_usuario']; ?>" onchange="this.form.submit()">
                            <option value="">----</option>
                            <option value="Aceptada" required>Aceptada</option>
                            <option value="Rechazada" required>Rechazada</option>
                        </select>
                    </form>
                </td>
                <script>
                    function guardarSeleccion(usuarioId, seleccion) {
                        // Realiza una solicitud AJAX para enviar la selección al servidor
                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', 'php/guardar_seleccion.php', true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function () {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                var respuesta = xhr.responseText;
                                var mensajeElement = document.getElementById("mensaje_" + usuarioId);

                                if (respuesta === "ok") {
                                    mensajeElement.textContent = "Selección guardada con éxito";
                                } else {
                                    mensajeElement.textContent = "Error al guardar la selección";
                                }
                            }
                        };

                        // Envía la selección al servidor
                        xhr.send("usuario_id=" + usuarioId + "&seleccion=" + seleccion);
                    }
             </script>
            </tr>
           
        <?php
            }while($row=mysqli_fetch_array($query));

         }
        ?>
        </tbody>

        </table>
        <div id="modalAbono" class="modal">
            <div class="modal-contenido">
                <span class="cerrar" id="cerrarModalAbono">&times;</span>
                <h2>Realizar Abono</h2>
                <!-- Aquí puedes agregar un formulario para realizar el abono -->
                <form action="php/realizar_abono.php" method="POST">
                    <div class="abonar">
                        <label for="monto">Monto del abono:</label>
                        <input type="number" id="monto" name="monto" required>
                        <input type="hidden" id="usuario_id" name="usuario_id" value="">
                        <button type="submit">Realizar Abono</button>
                    </div>
                   
                </form>
            </div>
     </div>
         <script>
                const cantida_prestamoInput = document.getElementById('cantida_prestamo');

                <?php
                // Verificar si el usuario ya ha solicitado un préstamo y deshabilitar el campo si es el caso
                if ($row['cantida_prestamo'] > 0) {
                    echo 'cantida_prestamoInput.disabled = true;';
                }
                ?>

                // Resto de tu código JavaScript
                // ...
         </script>
        <script>
            
            
            function abrirModal(usuarioId) {
                var modal = document.getElementById("modalAbono");
                var usuarioIdInput = document.getElementById("usuario_id");
                usuarioIdInput.value = usuarioId;
                modal.style.display = "block";
            }

            function cerrarModalAbono() {
                var modal = document.getElementById("modalAbono");
                modal.style.display = "none";
            }

            var cerrarModalAbonoButton = document.getElementById("cerrarModalAbono");
            if (cerrarModalAbonoButton) {
                cerrarModalAbonoButton.addEventListener("click", cerrarModalAbono);
            }
        </script>

    </main>
    
</body>
<footer class="fot">
  <label class="text">Copyright © Todos los derechos reservados</label>
</footer>   
</html>