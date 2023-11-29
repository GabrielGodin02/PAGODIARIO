<main>
    <div class="centro">
        <form action='registro' method='POST'>
            <h1>Informacion de Registro</h1>
            <div class="gg">
                <div class="form-floating mb-2">
                    <input type="text" class="form-control" id="floatingInput" placeholder="Nombres" name="nombre" required>
                    <label for="floatingInput">Nombres</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingPassword" placeholder="Apellidos" name="apellidos" required>
                    <label for="floatingPassword">Apellidos</label>
                </div>
            </div>
            <div class="gg">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="floatingInput" placeholder="Identificacion" name="ident" required>
                    <label for="floatingInput">Identificacion</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingPassword" placeholder="name@example.com" name="email" required>
                    <label for="floatingPassword">Email address</label>
                </div>
            </div>
            <div class="gg">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingPassword" placeholder="Profesion" name="profesion" required>
                    <label for="floatingPassword">Profesión</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Contraseña" name="passw" required>
                    <label for="floatingPassword">Contraseña</label>
                </div>
            </div>
            <div class="gg">
                <div class="form-floating mb-3">
                    <select class="form-control" aria-label="Default select example" name="estado" required>
                        <option selected>-- seleccionar --</option>
                        <option value="solter@">Solter@</option>
                        <option value="casad@">Casad@</option>
                        <option value="union libre">Union Libre</option>
                    </select>
                    <label for="floatingPassword">Estado civil</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="floatingPassword" placeholder="Fecha Nacimiento" name="fecha" required>
                    <label for="floatingPassword">Fecha</label>
                </div>
            </div>
            <button class="boton_usuario">Registrar</button>
        </form>

    </div>

</main>