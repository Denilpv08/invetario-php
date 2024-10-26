<?php
include 'connection.php';

// Obtener todos los productos de la base de datos
$sql = "SELECT * FROM productos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hardware Store Nuts and Bolts</title>
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
            margin: auto;
            padding: 20px;
        }
        .info-card {
            display: flex; /* Usamos flexbox para la disposición */
            align-items: center; /* Alinear verticalmente al centro */
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .info-card img {
            max-width: 150px; /* Ancho máximo para el logo */
            height: auto;
            border-radius: 5px;
            margin-left: 20px; /* Espaciado a la izquierda del logo */
        }
        .catalogo {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .catalogo h2 {
            margin-top: 0;
        }
        .product {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px;
            display: inline-block;
            width: 200px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .product img {
            max-width: 100%;
            border-radius: 5px;
        }
        .products {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px 0;
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
    <main>
        <div class="container">
            <div class="info-card">
                <div class="info-text">
                    <h2>Información de la Empresa</h2>
                    <p>Bienvenidos a Hardware Store, su mejor opción para comprar herramientas de alta calidad. Ofrecemos una amplia gama de productos, desde tornillos hasta sierras, todo lo que necesita para sus proyectos de construcción y mantenimiento.</p>
                    <p>Estamos comprometidos con la satisfacción del cliente y trabajamos arduamente para ofrecer los mejores precios y servicio al cliente.</p>
                    <p>¡Contáctenos para más información!</p>
                </div>
                <img src="imagenes/logo.png" alt="Logo de la Empresa">
            </div>

            <div class="catalogo">
                <h2>Catálogo de Productos</h2>
                <div class="products">
                    <?php while($row = $result->fetch_assoc()): ?>
                        <div class="product">
                            <img src="./imagenes/<?php echo htmlspecialchars($row['imagen']); ?>" alt="<?php echo htmlspecialchars($row['nombre']); ?>">
                            <h3><?php echo htmlspecialchars($row['nombre']); ?></h3>
                            <p>Precio: $<?php echo htmlspecialchars($row['precio']); ?></p>
                            <p>Stock: <?php echo htmlspecialchars($row['stock']); ?></p>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </main>
</body>
</html>

<?php
$conn->close();
?>
