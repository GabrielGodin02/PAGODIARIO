<main>
    <div class="centro container-md mt-4 card">
        <form action='registro' method='POST' class="form card-body">
            <h3 class="vista-titulo">Informacion de Registro</h3>
            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="floatingInput" placeholder="Nombres" name="nombre" required>
                <label for="floatingInput">Nombres</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingPassword" placeholder="Apellidos" name="apellidos" required>
                <label for="floatingPassword">Apellidos</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="floatingInput" placeholder="Identificacion" name="ident" required>
                <label for="floatingInput">Identificacion</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="floatingInput" placeholder="numero de Telfono" name="telefono" required>
                <label for="floatingPassword">Telfono</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" required>
                <label for="floatingPassword">Correo electronico</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="Profesion" name="profesion" required>
                <label for="floatingPassword">Profesión</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="Dirección" name="direccion" required>
                <label for="floatingInput">Dirección</label>
            </div>
            <div class="form-floating mb-3">
                <select class="form-select" aria-label="Default select example" name="estado" required>
                    <option selected>-- seleccionar --</option>
                    <option value="solter@">Solter@</option>
                    <option value="casad@">Casad@</option>
                    <option value="union libre">Union Libre</option>
                </select>
                <label for="floatingInput">Estado civil</label>
            </div>
            <div class="form-floating mb-3">
                <input type="date" class="form-control" id="floatingInput" placeholder="Fecha Nacimiento" name="fecha" required>
                <label for="floatingInput">Fecha de Nacimiento</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Contraseña" name="passw" required>
                <label for="floatingPassword">Contraseña</label>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button class="btn btn-secondary me-md-2" type="reset">Cancelar</button>
                <button class="btn btn-primary" type="submit">Registrar</button>
            </div>
        </form>

    </div>

</main>