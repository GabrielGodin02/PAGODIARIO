<body>
    <div id="contenedor">
        <div id="central">
            <div id="login">
                <div class="titulo">
                    Bienvenido
                </div>
                <form id="loginform" action="/login" method="POST">
                    <input type="text" name="email" placeholder="Usuario" required>
                    
                    <input type="password" placeholder="Contraseña" name="ident" required>
                    
                    <button type="submit" title="Ingresar" name="Ingresar" required >Iniciar sesion</button>
                </form>
                <div class="pie-form">
                    <a href="/formulario-recuperacion">¿Perdiste tu contraseña?</a>
                    <a href="/formulario-registro">¿No tienes Cuenta? Registrate</a>
                </div>
            </div>
        </div>
    </div>
</body>