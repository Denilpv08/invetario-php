<?php
include 'connection.php';

// Validar y asegurar que el ID es un número entero
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id > 0) {
    // Preparar y ejecutar la consulta de selección
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    // Verificar si el usuario existe
    if (!$user) {
        echo "Usuario no encontrado";
        exit;
    }

    $stmt->close();
} else {
    echo "ID no válido";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
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
            padding: 20px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"], input[type="email"], select {
            width: 96%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #f3dd4f;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 4px;
            width: 100%;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #FFC300;
        }
        .error-message {
            color: red;
            font-size: 14px;
            text-align: center;
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
        <h2>Editar Usuario</h2>
        <form method="post" action="update_user.php">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="<?php echo $user['nombre']; ?>" required>
            
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo $user['email']; ?>" required>

            <label for="tipo_cliente">Tipo de Cliente:</label>
            <select name="tipo_cliente" required>
                <option value="Permanente" <?php if($user['tipo_cliente'] == 'Permanente') echo 'selected'; ?>>Permanente</option>
                <option value="Periódico" <?php if($user['tipo_cliente'] == 'Periódico') echo 'selected'; ?>>Periódico</option>
                <option value="Casual" <?php if($user['tipo_cliente'] == 'Casual') echo 'selected'; ?>>Casual</option>
                <option value="Nuevo" <?php if($user['tipo_cliente'] == 'Nuevo') echo 'selected'; ?>>Nuevo</option>
            </select>
            
            <input type="submit" value="Actualizar">
        </form>
    </div>
</body>
</html>
