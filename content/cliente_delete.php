<?php
require_once('../base/bd.php');

if (isset($_GET['telefono'])) {
    $telefono = $_GET['telefono'];
    
    // Verificar si el cliente tiene ventas asociadas
    $check_query = "SELECT COUNT(*) as count FROM ventas WHERE cliente_telefono = '$telefono'";
    $check_result = bd_consulta($check_query);
    
    if ($check_result && $row = mysqli_fetch_assoc($check_result)) {
        if ($row['count'] > 0) {
            header('Location: ../base/index.php?op=20&error=asociado');
            exit;
        }
    }
    
    // Eliminar cliente
    $delete_query = "DELETE FROM cliente WHERE telefono = '$telefono'";
    if (bd_consulta($delete_query)) {
        header('Location: ../base/index.php?op=20&del=1');
    } else {
        header('Location: ../base/index.php?op=20&del=0');
    }
}

header('Location: ../base/index.php?op=20');
exit;
?>