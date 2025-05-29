<?php
require_once('../base/bd.php');

if (!isset($_GET['telefono'])) {
    header('Location: index.php?op=20&error=datos');
    exit;
}

$telefono = $_GET['telefono'];

// Eliminar cliente directamente (sin verificar ventas asociadas)
$delete_query = "DELETE FROM cliente WHERE telefono = '$telefono'";
if (bd_consulta($delete_query)) {
    header('Location: index.php?op=20&success=eliminado');
} else {
    header('Location: index.php?op=20&error=eliminar');
}
exit;
?>