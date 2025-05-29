<?php
include('../base/bd.php');

// 1. Obtener datos del formulario
$proveedor_id = $_POST['proveedor_id'];
$libro_ids = $_POST['libro_id'];
$cantidades = $_POST['cantidad'];

// 2. Calcular total basado en precios de la base de datos
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

// 3. Insertar compra principal
$fecha = date('Y-m-d');
$consultaCompra = "INSERT INTO compra (fecha, proveedor, total) VALUES ('$fecha', '$proveedor_id', '$total')";
bd_consulta($consultaCompra);

// 4. Obtener el ID de la compra recién insertada
$result = bd_consulta("SELECT MAX(id_compra) AS id FROM compra");
$row = mysqli_fetch_assoc($result);
$id_compra = $row['id'];

// 5. Insertar detalles de compra con precios oficiales
for ($i = 0; $i < count($libro_ids); $i++) {
    $libro = $libro_ids[$i];
    $cantidad = $cantidades[$i];
    $precio = $precios_oficiales[$i];

    $consultaDetalle = "INSERT INTO detalle_compra (id_compra, id_libro, cantidad, precio_unitario)
                        VALUES ($id_compra, $libro, $cantidad, $precio)";
    bd_consulta($consultaDetalle);
}

// 6. Redirigir con mensaje
header('Location: ../base/index.php?op=40&mensaje=compra_registrada');
?>
