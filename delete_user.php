<?php
include 'connection.php';

$id = $_GET['id'];

// Validar y verificar que $id sea un número entero
if (filter_var($id, FILTER_VALIDATE_INT)) {
    // Preparar y ejecutar la consulta de eliminación
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id); 

    if ($stmt->execute()) {
        echo "Usuario eliminado con éxito";
    } else {
        echo "Error al eliminar el usuario: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID no válido";
}

$conn->close();

header("Location: view_users.php");
exit();
?>
