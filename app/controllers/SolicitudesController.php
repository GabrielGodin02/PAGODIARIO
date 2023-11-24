<?php

class SolicitudesController {
    public function showSolicitudForm(){
        $this->registerSolicitud();
        include 'app/vistas/deudor/panel-control-usuario.php';
    }
    public function registerSolicitud(){

    }
}