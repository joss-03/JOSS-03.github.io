<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "tienda_tenis";
$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}
?>