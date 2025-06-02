<?php
// Configuración de ordenamiento
$orden = isset($_GET['orden']) ? $_GET['orden'] : 'fecha';
$direccion = isset($_GET['dir']) ? strtolower($_GET['dir']) : 'desc';
$permitidos = ['id_compra', 'fecha', 'proveedor', 'total'];
if (!in_array($orden, $permitidos)) $orden = 'fecha';

// Consulta SQL con detalle
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
ORDER BY $orden $direccion";

$result = bd_consulta($consulta);

// Agrupar por compra
$compras = [];
while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id_compra'];
    if (!isset($compras[$id])) {
        $compras[$id] = [
            'fecha' => $row['fecha'],
            'proveedor' => $row['proveedor'],
            'total' => $row['total'],
            'libros' => []
        ];
    }
    $compras[$id]['libros'][] = [
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
        <th onclick="ordenarPor('id_compra')">N° Compra</th>
        <th onclick="ordenarPor('fecha')">Fecha</th>
        <th onclick="ordenarPor('proveedor')">Proveedor</th>
        <th>Libro</th>
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
    $totalLibros = 0;
    $totalCompras = 0;

    foreach ($compras as $id => $compra) {
        // Fila de encabezado por compra
        echo "<tr style='background-color:#f2f2f2; font-weight:bold'>
            <td>{$id}</td>
            <td>" . date('d/m/Y', strtotime($compra['fecha'])) . "</td>
            <td>{$compra['proveedor']}</td>
            <td colspan='4'></td>
            <td>$" . number_format($compra['total'], 2) . "</td>
            <td></td>
        </tr>";

        // Detalles de libros
        foreach ($compra['libros'] as $libro) {
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

        $totalCompras += $compra['total'];
    }
    ?>

    <tr style="font-weight: bold; background-color: #ddd;">
        <td colspan="4">Total Compras: <?= count($compras) ?></td>
        <td><?= $totalLibros ?></td>
        <td colspan="3">$<?= number_format($totalCompras, 2) ?></td>
        <td></td>
    </tr>
</table>
