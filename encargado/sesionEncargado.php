<?php
// Seguridad, para que vuelva al index si no tiene la session 
session_start();

if (!isset($_SESSION['nombre']) || !isset($_SESSION['id'])) {
    header("LOCATION:../index.php");
    exit();
}

if ($_SESSION['encargado'] == 0) {
    header("LOCATION:../index.php");
    exit();
    
}

?>