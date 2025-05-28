<?php
require_once('../base/bd.php');

if (!isset($_GET['id'])) {
    header('Location: index.php?op=30&error=datos');
    exit;
}

$rfc = $_GET['id'];

// 1. Verificar si el proveedor existe primero
$check_proveedor = "SELECT rfc FROM proveedor WHERE rfc = '$rfc'";
$result_proveedor = bd_consulta($check_proveedor);

if (!mysqli_num_rows($result_proveedor)) {
    header('Location: index.php?op=30&error=no_existe');
    exit;
}

// 2. Eliminar proveedor directamente (sin verificar productos asociados)
$delete_query = "DELETE FROM proveedor WHERE rfc = '$rfc'";
if (bd_consulta($delete_query)) {
    header('Location: index.php?op=30&success=eliminado');
} else {
    header('Location: index.php?op=30&error=eliminar');
}
exit;
?>