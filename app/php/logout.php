<?php
include './print.php';

session_start();
session_destroy();
header('location: ../vistas/login.php');
die();

?>