<?php

include 'conexion.php';
include 'print.php';

session_start();
function checkAuth(){
    debug_to_console($_SESSION["ident"]);
    if(!$_SESSION["auth"]){
        header("Location: ./login.php");
        die();
    }
}

checkAuth();

?>