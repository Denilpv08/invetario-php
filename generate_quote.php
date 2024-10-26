<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $productos = $_POST['productos'];
    $cantidad = $_POST['cantidad'];

    // Obtener información del usuario
    $sql_user = "SELECT * FROM users WHERE id=$user_id";
    $result_user = $conn->query($sql_user);
    $user = $result_user->fetch_assoc();
    $tipo_cliente = $user['tipo_cliente'];

    // Calcular el precio total
    $precio_total = 0;
    foreach ($productos as $producto_id) {
        $sql_producto = "SELECT * FROM productos WHERE id=$producto_id";
        $result_producto = $conn->query($sql_producto);
        $producto = $result_producto->fetch_assoc();
        $precio_total += $producto['precio'] * $cantidad;
    }

    // Aplicar descuentos
    $precio_total_con_descuento = calcularDescuento($tipo_cliente, $precio_total);

    // Insertar cotización en la base de datos
    foreach ($productos as $producto_id) {
        $sql_insert = "INSERT INTO cotizaciones (user_id, producto_id, cantidad, precio_total) VALUES ($user_id, $producto_id, $cantidad, $precio_total_con_descuento)";
        $conn->query($sql_insert);
    }

    // Devolver respuesta JSON
    echo json_encode(['success' => true, 'total' => $precio_total_con_descuento]);
} else {
    // Respuesta de error
    echo json_encode(['success' => false]);
}

function calcularDescuento($tipo_cliente, $total_compra) {
    $descuento = 0;

    switch ($tipo_cliente) {
        case 'Permanente':
            $descuento = 0.10;
            break;
        case 'Periódico':
            $descuento = 0.05;
            break;
        case 'Casual':
            $descuento = 0.02;
            break;
        case 'Nuevo':
            $descuento = 0.00;
            break;
    }

    if ($total_compra > 100000) {
        $descuento += 0.02;
    }

    return $total_compra * (1 - $descuento);
}

$conn->close();
?>
