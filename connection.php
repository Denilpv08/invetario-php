<?php
$servername = "localhost";
$username = "root";
$password = "Desawed2";
$dbname = "hardware_store";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>