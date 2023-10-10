
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="monto.js"></script>
    <script src="java.js"></script>
    <title>Document</title>
</head>
<body>
    <?php echo '<script>const usuarioYaSolicitoPrestamo = $cantida_prestamo.lenght > 0  </script>' ?>
    <header>
        <nav>
            <div class="container">
                <div class="logo" onclick="toggleList()"><img src="img/usuario.png"></div>
                <ul class="lista">
                    <li><a href="">Perfil</a></li>
                    <li><a href="login.php"> Log Out</a></li>
                    <li><a href="solicitudes.php">Solicitud</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        
        <form action='php/ingresar-prestamo.php' method='POST'>
            <div class="gg">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="Direccion" name="direccion" required>
                    <label for="floatingInput">Direccion</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="floatingInput" placeholder="Telefono" name="telefono" required>
                    <label for="floatingInput">Telefono</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="floatingInput" placeholder="ID" name="id_usuario" required>
                    <label for="floatingInput">id_usuario</label>
                </div>
            </div>
            <div class="gg">
                <div class="form-floating mb-3">
                    <input type="time" class="form-control" id="floatingInput" placeholder="Hora" name="hora" required>
                    <label for="floatingInput">Hora</label>
                </div>
                
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="cantida_prestamo" placeholder="Monto a Solicitar" name="cantida_prestamo" min="10000" max="1000000" required >
                    <label for="cantida_prestamo">Monto a Solicitar</label>
                    <p>Por día vas a pagar el 7% de la cantidad que coloques.</p>
                    <p id="result"></p>
                    <input type="hidden" id="resultado" name="resultado">
                </div>
               <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const cantidaPrestamoInput = document.getElementById('cantida_prestamo');
                        
                        // Simulamos que el usuario ya ha solicitado un préstamo, por lo que desactivamos el campo.
                        // En tu caso, debes verificar esta condición en PHP y luego generar el JavaScript correspondiente.
                        

                        if (usuarioYaSolicitóPrestamo) {
                            cantidaPrestamoInput.disabled = true;
                        }
                    });
               </script>
                
                <script>
                    const cantida_prestamoInput = document.getElementById('cantida_prestamo');
                    const resultParagraph = document.getElementById('result');
                    const resultado = document.getElementById('resultado');
                    cantida_prestamoInput.addEventListener('input', () => {
                    
                    
                    const cantida_prestamo = parseFloat(cantida_prestamoInput.value);
                    if (!isNaN(cantida_prestamo) && cantida_prestamo >= 10000 && cantida_prestamo <= 1000000) {
                        const pagoDiario = cantida_prestamo * 0.07;
                        resultParagraph.textContent = `Por día vas a pagar $${pagoDiario.toFixed(2)}.`;
                        resultado.value = pagoDiario.toFixed(2);
                    } else {
                        resultParagraph.textContent = 'Ingrese una cantidad válida entre 10,000 y 1.000.000.';
                    }
                    });
                </script>
                
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="floatingInput" placeholder="Monto a Solicitar" name="dia_solicitado" required>
                    <label for="floatingInput">Dia Solicitado</label>
                </div>
            </div>
            <button class="boton_usuario">Solicitar</button>
        </form>
        
    </main>
</body>
<footer class="fot">
  <label class="text">Copyright © Todos los derechos reservados</label>
</footer>   
</html>