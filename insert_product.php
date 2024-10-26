<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $imagen = $_FILES['imagen'];

    // Verifica que todos los campos tengan datos válidos
    if (empty($nombre) || empty($descripcion) || empty($precio) || empty($stock) || empty($imagen['name'])) {
        echo "<script>alert('Por favor, complete todos los campos.'); window.history.back();</script>";
        exit();
    }

    // Configura la ruta para guardar la imagen
    $directorio = "imagenes/";
    $nombreArchivo = basename($imagen["name"]);
    $rutaArchivo = $directorio . $nombreArchivo;

    // Verifica el tipo de archivo y si la imagen ya existe
    $tipoArchivo = strtolower(pathinfo($rutaArchivo, PATHINFO_EXTENSION));
    if ($tipoArchivo != "jpg" && $tipoArchivo != "jpeg" && $tipoArchivo != "png") {
        echo "<script>alert('Solo se permiten archivos JPG, JPEG y PNG.'); window.history.back();</script>";
        exit();
    }

    // Guarda la imagen en el directorio "imagenes"
    if (move_uploaded_file($imagen["tmp_name"], $rutaArchivo)) {
        // Inserta los datos en la base de datos
        $sql = "INSERT INTO productos (nombre, descripcion, precio, stock, imagen) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdss", $nombre, $descripcion, $precio, $stock, $nombreArchivo);

        if ($stmt->execute()) {
            echo "<script>alert('Producto agregado exitosamente'); window.location.href = 'productos.php';</script>";
        } else {
            echo "<script>alert('Error al agregar el producto.'); window.history.back();</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Error al subir la imagen.'); window.history.back();</script>";
    }
}

$conn->close();
?>
