<?php
// Configuración de ordenamiento
$orden = isset($_GET['orden']) ? $_GET['orden'] : 'fecha';
$direccion = isset($_GET['dir']) ? strtolower($_GET['dir']) : 'desc'; // Por defecto recientes primero
$permitidos = ['id_venta', 'fecha', 'cliente', 'total', 'libro', 'cantidad'];
if (!in_array($orden, $permitidos)) $orden = 'fecha';
if (!in_array($direccion, ['asc', 'desc'])) $direccion = 'desc';

// Consulta SQL
$consulta = "SELECT 
    v.id_venta, 
    v.fecha, 
    c.nombre AS cliente, 
    b.titulo AS libro, 
    dv.cantidad, 
    dv.precio_unitario,
    (dv.cantidad * dv.precio_unitario) AS subtotal,
    v.total
FROM ventas v
JOIN cliente c ON v.cliente = c.telefono
JOIN detalle_venta dv ON v.id_venta = dv.id_venta
JOIN book b ON dv.libro = b.id
ORDER BY $orden $direccion";

$result = bd_consulta($consulta);
?>

<script type="text/javascript">
// Mismo sistema de ordenamiento que en tu código original
function ordenarPor(campo) {
    const url = new URL(window.location);
    if (url.searchParams.get('orden') === campo) {
        url.searchParams.set('dir', url.searchParams.get('dir') === 'asc' ? 'desc' : 'asc');
    } else {
        url.searchParams.set('orden', campo);
        url.searchParams.set('dir', 'desc');
    }
    window.location = url;
}
</script>

<table>
    <tr>
        <th onclick="ordenarPor('id_venta')">N° Venta</th>
        <th onclick="ordenarPor('fecha')">Fecha</th>
        <th onclick="ordenarPor('cliente')">Cliente</th>
        <th onclick="ordenarPor('libro')">Libro</th>
        <th>Cantidad</th>
        <th>P. Unitario</th>
        <th>Subtotal</th>
        <th onclick="ordenarPor('total')">Total</th>
    <th>
      <a class="botonAñadir" href="../base/index.php?op=51" title="Añadir nuevo">
        <i class="fas fa-plus"></i> <i class="fas fa-receipt"></i>
      </a>
    </th>
    </tr>
    <?php
    $totalVentas = 0;
    $totalLibros = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
            <td>{$row['id_venta']}</td>
            <td>" . date('d/m/Y', strtotime($row['fecha'])) . "</td>
            <td>{$row['cliente']}</td>
            <td>{$row['libro']}</td>
            <td>{$row['cantidad']}</td>
            <td>$" . number_format($row['precio_unitario'], 2) . "</td>
            <td>$" . number_format($row['subtotal'], 2) . "</td>
            <td>$" . number_format($row['total'], 2) . "</td>
        </tr>";
        $totalVentas += $row['total'];
        $totalLibros += $row['cantidad'];
    }
    ?>
    <tr style="font-weight: bold; background-color: #f2f2f2;">
        <td colspan="4">Total Ventas: <?= mysqli_num_rows($result) ?></td>
        <td><?= $totalLibros ?></td>
        <td colspan="3">$<?= number_format($totalVentas, 2) ?></td>
    </tr>
</table>