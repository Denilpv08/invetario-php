<?php
include 'connection.php';

$id = $_GET['id'];
$sql = "SELECT * FROM productos WHERE id=$id";
$result = $conn->query($sql);
$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Producto</title>
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
        }
        .product-image {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        p {
            color: #666;
        }
        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .button-group a {
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .btnEdit{
            background-color: #f3dd4f;
        }
        .btnEdit:hover{
            background-color: #FFC300;
        }
        .btnDelete{
            background-color: #ee4026;
        }
        .btnDelete:hover{
            background-color: #ec3418;
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
        <h2><?php echo $product['nombre']; ?></h2>
        <img src="./imagenes/<?php echo $product['imagen']; ?>" alt="<?php echo $product['nombre']; ?>" class="product-image">
        <p><strong>Precio:</strong> $<?php echo $product['precio']; ?></p>
        <p><strong>Descripción:</strong> <?php echo $product['descripcion']; ?></p>

        <div class="button-group">
            <a href="edit_product.php?id=<?php echo $product['id']; ?>" class="btnEdit">Editar</a>
            <a href="delete_product.php?id=<?php echo $product['id']; ?>" class="btnDelete" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">Eliminar</a>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
