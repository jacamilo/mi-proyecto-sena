<?php
$usuario_correcto = "admin";
$password_correcto = "12345";

$username = $_POST['username'];
$password = $_POST['password'];

if ($username === $usuario_correcto && $password === $password_correcto) {
    echo "<h2>Bienvenido, $username!</h2>";
    echo "<p>Has iniciado sesión correctamente.</p>";
    echo "<a href='sgd_index.html'>Cerrar sesión</a>";
} else {
    echo "<h2>Usuario o contraseña incorrectos</h2>";
    echo "<a href='index.html'>Intentar de nuevo</a>";
}
?>
