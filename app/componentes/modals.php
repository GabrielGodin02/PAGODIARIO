<div id="modalExcusa" class="modal">
    <div class="modal-contenido">
        <span class="cerrar" id="cerrarModalNoAbono" onclick="cerrarModalExcusa()">&times;</span>
        <h2>No realizar Abono</h2>
        <!-- Aquí puedes agregar un formulario para realizar el abono -->
        <form action="/admin/excusar" method="POST">
            <div class="abonar">
                <label for="monto">Motivo:</label>
                <textarea type="text" name="motivo" class="form-control" required></textarea>
                <input type="hidden" id="excusar_prestamo_id" name="id_prestamo" value="">
                <button type="submit" class="btn-success btn">Guardar</button>
            </div>
        </form>
    </div>
</div>
<div id="modalAbono" class="modal">
    <div class="modal-contenido">
        <span class="cerrar" id="cerrarModalAbono" onclick="cerrarModalAbono()">&times;</span>
        <h2>Realizar Abono</h2>
        <!-- Aquí puedes agregar un formulario para realizar el abono -->
        <form action="/admin/abonar" method="POST">
            <div class="abonar">
                <label for="monto">Monto del abono:</label>
                <input type="number" id="monto" name="monto" class="form-control" required>
                <input type="hidden" id="abonar_prestamo_id" name="id_prestamo" class="form-control" value="">
                <button type="submit" class="btn btn-success">Realizar Abono</button>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="confirmCompletar" tabindex="-1" aria-labelledby="confirmar completado" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body row">
                <div class="col-sm-3 my-2 text-info text-center align-middle">
                    <i class="fa fa-5x fa-question-circle "></i>
                </div>
                <div class="col-sm-9 col-auto text-sm-start text-center">
                    <h5>Confirmar Completado</h5>
                    <p class="text-secondary">
                        Una vez completado el prestamo se cambiara su estado se registrara un pago por la totalidad de la deuda restante.
                    </p>
                </div>
            </div>
            <form class="modal-footer text-center" action="/admin/control-solicitudes/complete" method="post">
                <input  type="hidden" id="confirm_complete_id" name="id_prestamo">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Completar</button>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="confirmRechazar" tabindex="-1" aria-labelledby="confirmar completado" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body row">
                <div class="col-sm-3 my-2 text-danger text-center align-middle">
                    <i class="fa fa-5x fa-trash "></i>
                </div>
                <div class="col-sm-9 col-auto text-sm-start text-center">
                    <h5>Confirmar Rechazo</h5>
                    <p class="text-secondary">
                        Una vez rechazado el prestamo se cambiara su estado y ya no podra ser aceptado.
                    </p>
                </div>
            </div>
            <form class="modal-footer text-center" action="/admin/control-solicitudes/update" method="POST">
                <input id="confirm_reject_id" type="hidden" name="id_prestamo">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger" name="estado" value="Rechazada">Rechazar</button>
            </form>
        </div>
    </div>
</div>