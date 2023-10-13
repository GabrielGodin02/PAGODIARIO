<?php

include 'conexion.php';
include 'print.php';

function checkAuth(){
    debug_to_console(!$_SESSION["ident"]);
    if(!$_SESSION["ident"]){
        header("Location: ./login.php");
        die();
    }
}

checkAuth();

?>