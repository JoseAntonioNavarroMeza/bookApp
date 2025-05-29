<?php
include('../base/bd.php');

// 1. Obtener datos del formulario
$cliente_id = $_POST['cliente_id'];
$libro_ids = $_POST['libro_id'];
$cantidades = $_POST['cantidad'];

// 2. Calcular total basado en precios oficiales de la base de datos
$total = 0;
$precios_oficiales = [];

for ($i = 0; $i < count($libro_ids); $i++) {
    $libro = $libro_ids[$i];
    $cantidad = $cantidades[$i];

    // Obtener precio oficial del libro
    $result = bd_consulta("SELECT precio FROM book WHERE id = $libro");
    $row = mysqli_fetch_assoc($result);
    $precio = $row['precio'];
    $precios_oficiales[] = $precio;

    $total += $precio * $cantidad;
}

// 3. Insertar venta principal
$fecha = date('Y-m-d');
$consultaVenta = "INSERT INTO ventas (fecha, cliente, total) VALUES ('$fecha', '$cliente_id', '$total')";
bd_consulta($consultaVenta);

// 4. Obtener el ID de la venta recién insertada
$result = bd_consulta("SELECT MAX(id_venta) AS id FROM ventas");
$row = mysqli_fetch_assoc($result);
$id_venta = $row['id'];

// 5. Insertar detalles de venta con precios oficiales
for ($i = 0; $i < count($libro_ids); $i++) {
    $libro = $libro_ids[$i];
    $cantidad = $cantidades[$i];
    $precio = $precios_oficiales[$i];

    $consultaDetalle = "INSERT INTO detalle_venta (id_venta, libro, cantidad, precio_unitario)
                        VALUES ($id_venta, $libro, $cantidad, $precio)";
    bd_consulta($consultaDetalle);
}

// 6. Redirigir con mensaje
header('Location: ../base/index.php?op=50&mensaje=venta_registrada');
?>
