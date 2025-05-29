<?php
require_once('../base/bd.php');

if (isset($_GET['id'])) {
    $pais_id = $_GET['id'];
    
    // 1. Verificar si hay autores asociados a este país
    $consulta_autores = "SELECT COUNT(*) as total FROM autor WHERE nacionalidad = $pais_id";
    $resultado = bd_consulta($consulta_autores);
    $fila = mysqli_fetch_assoc($resultado);
    
    if ($fila['total'] > 0) {
        // Hay autores asociados, redirigir con error
        header("Location: ../base/index.php?op=60&error=asociado");
        exit();
    }
    
    // 2. Si no hay autores asociados, proceder a borrar
    $consulta_borrar = "DELETE FROM pais WHERE id = $pais_id";
    if (bd_consulta($consulta_borrar)) {
        header("Location: ../base/index.php?op=60");
        exit();
    } else {
        // Error en el borrado
        header("Location: ../base/index.php?op=60&error=borrado");
        exit();
    }
} else {
    // No se proporcionó ID
    header("Location: ../base/index.php?op=60");
    exit();
}
?>