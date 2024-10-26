<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger y sanitizar entradas
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $tipo_cliente = htmlspecialchars(trim($_POST['tipo_cliente']));
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Validar el email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Formato de email no válido";
        exit;
    }

    // Preparar y ejecutar la consulta de inserción
    $stmt = $conn->prepare("INSERT INTO users (nombre, email, tipo_cliente, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nombre, $email, $tipo_cliente, $password);

    if ($stmt->execute()) {
        echo "Nuevo usuario registrado con éxito";
    } else {
        echo "Error al registrar usuario: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

header("Location: view_users.php");
exit();
?>
