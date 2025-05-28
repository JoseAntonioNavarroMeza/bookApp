<?php
// Configuración de ordenamiento
$orden = isset($_GET['orden']) ? $_GET['orden'] : 'fecha';
$direccion = isset($_GET['dir']) ? strtolower($_GET['dir']) : 'desc';
$permitidos = ['id_compra', 'fecha', 'proveedor', 'total', 'libro', 'cantidad'];
if (!in_array($orden, $permitidos)) $orden = 'fecha';

// Consulta SQL
$consulta = "SELECT 
    c.id_compra, 
    c.fecha, 
    p.nombre AS proveedor, 
    b.titulo AS libro, 
    dc.cantidad, 
    dc.precio_unitario,
    (dc.cantidad * dc.precio_unitario) AS subtotal,
    c.total
FROM compra c
JOIN proveedor p ON c.proveedor = p.RFC
JOIN detalle_compra dc ON c.id_compra = dc.id_compra
JOIN book b ON dc.id_libro = b.id
ORDER BY id_compra $direccion";

$result = bd_consulta($consulta);
?>

<table>
    <tr>
        <th onclick="ordenarPor('id_compra')">N° Compra</th>
        <th onclick="ordenarPor('fecha')">Fecha</th>
        <th onclick="ordenarPor('proveedor')">Proveedor</th>
        <th onclick="ordenarPor('libro')">Libro</th>
        <th>Cantidad</th>
        <th>P. Unitario</th>
        <th>Subtotal</th>
        <th onclick="ordenarPor('total')">Total</th>
    <th>
      <a class="botonAñadir" href="../base/index.php?op=41" title="Añadir nuevo">
        <i class="fas fa-plus"></i> <i class="fas fa-receipt"></i>
      </a>
    </th>
    </tr>
    <?php
    $totalCompras = 0;
    $totalLibros = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
            <td>{$row['id_compra']}</td>
            <td>" . date('d/m/Y', strtotime($row['fecha'])) . "</td>
            <td>{$row['proveedor']}</td>
            <td>{$row['libro']}</td>
            <td>{$row['cantidad']}</td>
            <td>$" . number_format($row['precio_unitario'], 2) . "</td>
            <td>$" . number_format($row['subtotal'], 2) . "</td>
            <td>$" . number_format($row['total'], 2) . "</td>
        </tr>";
        $totalCompras += $row['total'];
        $totalLibros += $row['cantidad'];
    }
    ?>
    <tr style="font-weight: bold; background-color: #f2f2f2;">
        <td colspan="4">Total Compras: <?= mysqli_num_rows($result) ?></td>
        <td><?= $totalLibros ?></td>
        <td colspan="3">$<?= number_format($totalCompras, 2) ?></td>
    </tr>
</table>