<?php
// Configuración de ordenamiento
$orden = isset($_GET['orden']) ? $_GET['orden'] : 'fecha';
$direccion = isset($_GET['dir']) ? strtolower($_GET['dir']) : 'desc'; // Por defecto recientes primero
$permitidos = ['id_venta', 'fecha', 'cliente', 'total'];
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

// Agrupar por venta
$ventas = [];
while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id_venta'];
    if (!isset($ventas[$id])) {
        $ventas[$id] = [
            'fecha' => $row['fecha'],
            'cliente' => $row['cliente'],
            'total' => $row['total'],
            'libros' => []
        ];
    }
    $ventas[$id]['libros'][] = [
        'titulo' => $row['libro'],
        'cantidad' => $row['cantidad'],
        'precio_unitario' => $row['precio_unitario'],
        'subtotal' => $row['subtotal']
    ];
}
?>

<script type="text/javascript">
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
        <th>Libro</th>
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

    foreach ($ventas as $id => $venta) {
        // Fila de encabezado por venta
        echo "<tr style='background-color:#f2f2f2; font-weight:bold'>
            <td>{$id}</td>
            <td>" . date('d/m/Y', strtotime($venta['fecha'])) . "</td>
            <td>{$venta['cliente']}</td>
            <td colspan='3'></td>
            <td></td>
            <td>$" . number_format($venta['total'], 2) . "</td>
            <td></td>
        </tr>";

        // Detalles de libros vendidos
        foreach ($venta['libros'] as $libro) {
            echo "<tr>
                <td></td>
                <td></td>
                <td></td>
                <td>{$libro['titulo']}</td>
                <td>{$libro['cantidad']}</td>
                <td>$" . number_format($libro['precio_unitario'], 2) . "</td>
                <td>$" . number_format($libro['subtotal'], 2) . "</td>
                <td></td>
                <td></td>
            </tr>";
            $totalLibros += $libro['cantidad'];
        }

        $totalVentas += $venta['total'];
    }
    ?>

    <tr style="font-weight: bold; background-color: #ddd;">
        <td colspan="4">Total Ventas: <?= count($ventas) ?></td>
        <td><?= $totalLibros ?></td>
        <td colspan="3">$<?= number_format($totalVentas, 2) ?></td>
        <td></td>
    </tr>
</table>
