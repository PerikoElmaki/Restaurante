<?php
// Seguridad, para que vuelva al index si no tiene la session 
session_start();

if(isset($_SESSION('id')) ||isset($_SESSION('nombre'))){
    header("LOCATION:index.php");
    exit();
}

?>