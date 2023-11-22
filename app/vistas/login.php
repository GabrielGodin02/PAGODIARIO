<body>
    <div id="contenedor">
        <div id="central">
            <div id="login">
                <div class="titulo">
                    Bienvenido
                </div>
                <form id="loginform" action="php/validar.php" method="POST">
                    <input type="text" name="email" placeholder="Usuario" required>
                    
                    <input type="password" placeholder="Contraseña" name="ident" required>
                    
                    <button type="submit" title="Ingresar" name="Ingresar" required >Login</button>
                </form>
                <div class="pie-form">
                    <a href="registro">¿Perdiste tu contraseña?</a>
                    <a href="recuperacion">¿No tienes Cuenta? Registrate</a>
                </div>
            </div>
        </div>
    </div>
</body>