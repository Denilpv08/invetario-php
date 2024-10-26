<?php
include 'connection.php';

$sql = "SELECT * FROM productos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Productos</title>
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
            max-width: 1200px;
            margin: 20px auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .card {
            background: white;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin: 15px;
            padding: 20px;
            text-align: center;
            width: 300px;
            transition: transform 0.3s;
        }
        .card img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .card h3 {
            margin: 15px 0;
            color: #333;
        }
        .card p {
            margin: 10px 0;
            color: #666;
        }
        .card button {
            background-color: #f3dd4f;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .card button:hover {
            background-color: #FFC300;
        }
        .add-product-button {
            display: block;
            padding: 12px 25px;
            background-color: #4ac3fe;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px auto;
            text-align: center;
            font-weight: bold;
            width: 200px;
            transition: background-color 0.3s;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
        .add-product-button:hover {
            background-color: #27aff1;
        }
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                align-items: center;
            }
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
        <br>
    <a href="new_product.php" class="add-product-button">Agregar Producto</a>
    <div class="container">
        
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="card">
                <img src="./imagenes/<?php echo $row['imagen']; ?>" alt="<?php echo $row['nombre']; ?>">
                <h3><?php echo $row['nombre']; ?></h3>
                <p>Precio: $<?php echo $row['precio']; ?></p>
                <button onclick="location.href='product_details.php?id=<?php echo $row['id']; ?>'">Ver Detalles</button>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>
