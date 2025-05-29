<?php
require_once('../base/bd.php');

if (isset($_GET['id'])) {
    $editorial_id =  $_GET['id'];
    
    // 1. Verificar si hay libros asociados a esta editorial
    $consulta_book = "SELECT COUNT(*) as total FROM book WHERE editorial = $editorial_id";
    $resultado = bd_consulta($consulta_book);
    $fila = mysqli_fetch_assoc($resultado);
    
    if ($fila['total'] > 0) {
        // Hay libros asociados, redirigir con error
        header("Location: ../base/index.php?op=80&error=asociado");
        exit();
    }
    
    // 2. Si no hay libros asociados, proceder a borrar
    $consulta_borrar = "DELETE FROM editorial WHERE id = $editorial_id";
    if (bd_consulta($consulta_borrar)) {
        header("Location: ../base/index.php?op=80");
        exit();
    } else {
        // Error en el borrado
        header("Location: ../base/index.php?op=80&error=borrado");
        exit();
    }
} else {
    // No se proporcionó ID
    header("Location: ../base/index.php?op=80");
    exit();
}
?>