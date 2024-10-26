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
    <title>Generar Cotización</title>
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
        .form-container {
            max-width: 800px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"] {
            width: 97.5%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .productos-list {
            margin-bottom: 15px;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: space-between;
        }
        .product-item {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            background: #f9f9f9;
            flex: 1 1 calc(33% - 15px);
            display: flex;
            align-items: center;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
        }
        .product-item img {
            max-width: 80px;
            margin-right: 10px;
        }
        input[type="checkbox"] {
            margin-right: 10px;
        }
        input[type="button"] {
            background-color: #f3dd4f;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        input[type="button"]:hover {
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
    <main>
        <div class="form-container">
            <h2>Generar Cotización</h2>
            <form id="quoteForm" onsubmit="return false;">
                <label for="user_id">Usuario ID:</label>
                <input type="text" name="user_id" required>

                <label for="productos">Seleccionar Productos:</label>
                <div class="productos-list">
                    <?php while($row = $result->fetch_assoc()): ?>
                        <div class="product-item">
                            <input type="checkbox" name="productos[]" value="<?php echo htmlspecialchars($row['id']); ?>">
                            <img src="./imagenes/<?php echo htmlspecialchars($row['imagen']); ?>" alt="<?php echo htmlspecialchars($row['nombre']); ?>">
                            <div>
                                <strong><?php echo htmlspecialchars($row['nombre']); ?></strong><br>
                                <span>Precio: $<?php echo htmlspecialchars($row['precio']); ?></span>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>

                <label for="cantidad">Cantidad:</label>
                <input type="number" name="cantidad" required>

                <input type="button" value="Generar Cotización" onclick="generarCotizacion()">
            </form>
        </div>
    </main>
    <script>
        function generarCotizacion() {
            const form = document.getElementById('quoteForm');
            const formData = new FormData(form);

            // Enviar datos usando fetch
            fetch('generate_quote.php', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(`Cotización generada con éxito. Precio total: $${data.total}`);
                    formData.reset();
                } else {
                    alert('Error al generar la cotización. Por favor, intenta de nuevo.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Ocurrió un error. Por favor, intenta de nuevo.');
            });
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>
