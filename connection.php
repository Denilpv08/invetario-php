<?php
$servername = "localhost";
$username = "root";
$password = "Dp119277";
$dbname = "hardware_store";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>