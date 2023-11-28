<div id="modalAbono" class="modal">
    <div class="modal-contenido">
        <span class="cerrar" id="cerrarModalAbono" onclick="cerrarModalAbono()">&times;</span>
        <h2>Realizar Abono</h2>
        <!-- Aquí puedes agregar un formulario para realizar el abono -->
        <form action="/admin/prestamos/abonar" method="POST">
            <div class="abonar">
                <label for="monto">Monto del abono:</label>
                <input type="number" id="monto" name="monto" class="form-control" required>
                <input type="hidden" id="usuario_id" name="id_prestamo" class="form-control" value="">
                <button type="submit" class="btn btn-success">Realizar Abono</button>
            </div>

        </form>
    </div>
</div>
<div id="modalExcusa" class="modal">
    <div class="modal-contenido">
        <span class="cerrar" id="cerrarModalNoAbono" onclick="cerrarModalExcusa()">&times;</span>
        <h2>No realizar Abono</h2>
        <!-- Aquí puedes agregar un formulario para realizar el abono -->
        <form action="/admin/prestamos/excusar" method="POST">
            <div class="abonar">
                <label for="monto">Motivo:</label>
                <textarea type="text" name="motivo" class="form-control" required></textarea>
                <input type="hidden" id="usuario_id" name="id_prestamo" value="">
                <button type="submit" class="btn-success btn">Guardar</button>
            </div>
        </form>
    </div>
</div>