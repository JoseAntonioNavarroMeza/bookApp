<?php
// ventas_new_commit.php
include "../base/bd.php"; // Ajusta la ruta según tu proyecto

// Recoger datos del formulario
$cliente_id = $_POST['cliente_id'];
$libro_ids = $_POST['libro_id'];           // Array
$cantidades = $_POST['cantidad'];          // Array
$precios_unitarios = $_POST['precio_unitario'];  // Array

// Validar que haya al menos un libro seleccionado
if (empty($libro_ids) || !is_array($libro_ids)) {
    die("No se seleccionaron libros.");
}

// Calcular total
$total = 0;
for ($i = 0; $i < count($libro_ids); $i++) {
    $total += $cantidades[$i] * $precios_unitarios[$i];
}

// Insertar en tabla ventas
$fecha = date('Y-m-d H:i:s');
$sql_venta = "INSERT INTO ventas (fecha, cliente, total) VALUES (?, ?, ?)";
$stmt = $mysqli->prepare($sql_venta);
$stmt->bind_param("sid", $fecha, $cliente_id, $total);
$stmt->execute();

if ($stmt->affected_rows == 0) {
    die("Error al insertar la venta.");
}

// Obtener el ID de la venta insertada
$id_venta = $stmt->insert_id;
$stmt->close();

// Insertar en detalle_ventas
$sql_detalle = "INSERT INTO detalle_ventas (id_venta, libro, cantidad, precio_unitario) VALUES (?, ?, ?, ?)";
$stmt_detalle = $mysqli->prepare($sql_detalle);

for ($i = 0; $i < count($libro_ids); $i++) {
    $libro_id = $libro_ids[$i];
    $cantidad = $cantidades[$i];
    $precio_unitario = $precios_unitarios[$i];

    // Validar cantidades y precios positivos
    if ($cantidad < 1 || $precio_unitario < 0) {
        continue; // saltar registros inválidos
    }

    $stmt_detalle->bind_param("iiid", $id_venta, $libro_id, $cantidad, $precio_unitario);
    $stmt_detalle->execute();
}

$stmt_detalle->close();

echo "Venta registrada correctamente. ID Venta: $id_venta";
?>
