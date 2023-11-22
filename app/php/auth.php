<?php

include 'conexion.php';
include 'print.php';

session_start();
function checkAuth(){
    if(!$_SESSION["auth"]){
        header("Location: ./vistas/login.php");
        die();
    }
}
function checkAdmin(){
    if ((!$_SESSION["user"]["admin"])) {
        header("Location: ./vistas/login.php");
        die();
    }
}

checkAuth();