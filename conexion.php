<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "sgdp";

$conexion = new mysqli($server, $user, $pass, $db);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
} else {
    echo "Conectado";
}
?>
