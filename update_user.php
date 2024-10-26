<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $tipo_cliente = $_POST['tipo_cliente'];

    $sql = "UPDATE users SET nombre='$nombre', email='$email', tipo_cliente='$tipo_cliente' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Datos actualizados con éxito');
                window.location.href = 'view_users.php';
              </script>";
    } else {
        echo "<script>
                alert('Error al actualizar los datos: " . $conn->error . "');
                window.location.href = 'view_users.php';
              </script>";
    }

    $conn->close();
}
?>
