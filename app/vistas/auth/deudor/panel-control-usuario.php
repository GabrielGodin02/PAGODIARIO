<main>
    <?php
    if ($soli->tiene_pendientes) {
    ?>
        <h2 class='vista-titulo'>Ya solicito un prestamo, hagale seguimiento <a href="/deudor/mis-solicitudes" class="link">Aquí.</a> </h2>
    <?php } else {
    ?>
        <div class="card p-4 mt-4 container-sm">
            <form action='' method='POST' class="">
                <h3 class='vista-titulo'>Complete el formulario para solicitar un prestamo</h3>
                <div class="form-floating mb-2">
                    <input type="number" class="form-control" id="cantida_prestamo" placeholder="Monto a Solicitar" name="cantida_prestamo" min="10000" required>
                    <label for="cantida_prestamo">Monto a Solicitar</label>
                    <p></p>
                    <p id="result" class="danger"></p>
                    <input type="hidden" id="resultado" name="resultado">
                </div>
                <div class="form-floating mb-3 col-auto">
                    <select name="pagodiario" class="form-select" id="" required>
                        <?php
                        foreach ($soli->readPagodiarios() as $pagodiario) {
                        ?>
                            <option value="<?php echo $pagodiario['ident'] ?>">
                                <?php echo $pagodiario['nombre'] ?>
                                <?php echo $pagodiario['apellidos'] ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                    <label for="contrasenia">Pagodiario a solicitar</label>
                </div>
                <div class="form-floating mb-3 col-auto">
                    <input type="password" class="form-control" id="contrasenia" placeholder="Contraseña" name="passw" required>
                    <label for="contrasenia">Escribe tu contraseña</label>
                </div>
                <button class="btn btn-primary">Solicitar</button>
            </form>
        </div>
    <?php } ?>
</main>

<script>
    const cantida_prestamoInput = document.getElementById('cantida_prestamo');
    const resultParagraph = document.getElementById('result');
    const resultado = document.getElementById('resultado');

    cantida_prestamoInput.addEventListener('input', () => {
        const cantida_prestamo = parseFloat(cantida_prestamoInput.value);

        if (!isNaN(cantida_prestamo) && cantida_prestamo >= 10000 && cantida_prestamo <= 100000000) {
            const tasaInteres = 0.20;
            const montoConInteres = cantida_prestamo * (1 + tasaInteres);
            const pagoDiario = montoConInteres * 0.04;

            resultParagraph.innerHTML = `Con una tasa de interés del 20%,vas a estar pagando $${pagoDiario.toFixed(2)}<br> por día.Monto total a pagar: $${montoConInteres.toFixed(2)}.`;
            resultado.value = pagoDiario.toFixed(2);
        } else {
            resultParagraph.textContent = 'Ingrese una cantidad válida entre 10,000 o Superior';
        }
    });
</script>