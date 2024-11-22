<?php
// $servidor = "localhost";
$servidor = "mysql.hostinger.com";
$user="u457699827_root";
// $user = "root";
// $clave = "";
$clave = "Informaticoredy8";
$bd = "u457699827_restaurante";

$conn = mysqli_connect($servidor, $user, $clave);

mysqli_select_db($conn, $bd);

echo mysqli_error($conn);

mysqli_query($conn, "SET NAMES'utf8'");

echo mysqli_error($conn);
?>