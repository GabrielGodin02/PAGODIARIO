<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>PAGODIARIO</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Overpass&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilo-login.css">

</head>
<body>
    <div id="contenedor">
        <div id="central">
            <div id="login">
                <div class="titulo">
                    Bienvenido
                </div>
                <form id="loginform" action="validar.php" method="POST">
                    <input type="text" name="email" placeholder="Usuario" required>
                    
                    <input type="password" placeholder="Contraseña" name="ident" required>
                    
                    <button type="submit" title="Ingresar" name="Ingresar" required >Login</button>
                </form>
                <div class="pie-form">
                    <a href="recuperar-contarseña.html">¿Perdiste tu contraseña?</a>
                    <a href="formulario.php">¿No tienes Cuenta? Registrate</a>
                </div>
            </div>
        </div>
    </div>
   
</body>
</html>