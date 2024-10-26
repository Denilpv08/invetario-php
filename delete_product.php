<?php
include 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar el producto de la base de datos
    $sql = "DELETE FROM productos WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Producto eliminado con éxito";
    } else {
        echo "Error al eliminar el producto: " . $conn->error;
    }
}

$conn->close();

// Redirigir a la vista de productos después de eliminar
header("Location: productos.php");
exit();
?>
