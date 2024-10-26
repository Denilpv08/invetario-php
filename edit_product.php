<?php
include 'connection.php';

$id = $_GET['id'];
$sql = "SELECT * FROM productos WHERE id=$id";
$result = $conn->query($sql);
$product = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $imagen = $_FILES['imagen']['name'];
    $target_dir = "imagenes/";
    $target_file = $target_dir . basename($imagen);

    // Si no se sube una nueva imagen, se mantiene la imagen actual
    if (empty($imagen)) {
        $imagen = $product['imagen'];
    } else {
        move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file);
    }

    $sql_update = "UPDATE productos SET nombre='$nombre', precio='$precio', descripcion='$descripcion', imagen='$imagen' WHERE id=$id";

    if ($conn->query($sql_update) === TRUE) {
        echo "Producto actualizado con éxito";
    } else {
        echo "Error: " . $sql_update . "<br>" . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffdf;
        }
        header {
            background-color: #f3dd4f;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        nav {
            display: flex;
            gap: 15px;
        }
        nav a {
            color: white;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        nav a:hover {
            background-color: #FFC300;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden; /* Asegura que no sobresalga el contenido */
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            color: #666;
        }
        input[type="text"], input[type="number"], input[type="file"], textarea {
            width: calc(100% - 20px); /* Ajuste para el padding */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 20px;
            box-sizing: border-box; /* Incluye padding en el tamaño total */
        }
        input[type="submit"] {
            background-color: #f3dd4f;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #FFC300;
        }
    </style>
</head>
<body>
    <header>
        <h1>Hardware Store Nuts and Bolts</h1>
        <nav>
            <a href="index.php">Inicio</a>
            <a href="productos.php">Productos</a>
            <a href="quote_form.php">Cotizaciones</a>
            <a href="view_users.php">Usuarios</a>
        </nav>
    </header>

    <div class="container">
        <h2>Editar Producto</h2>
        <form method="post" enctype="multipart/form-data">
            <label for="nombre">Nombre del Producto:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $product['nombre']; ?>" required>

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" value="<?php echo $product['precio']; ?>" required>

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="4" required><?php echo $product['descripcion']; ?></textarea>

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="imagen">

            <input type="submit" value="Actualizar Producto">
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
