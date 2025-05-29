<?php
require_once('../base/bd.php');

if (isset($_GET['id'])) {
    $lenguaje_id = intval($_GET['id']);
    
    // 1. Verificar si hay libros asociados a este lenguaje
    $consulta_libros = "SELECT COUNT(*) as total FROM book WHERE idioma = $lenguaje_id";
    $resultado = bd_consulta($consulta_libros);
    $fila = mysqli_fetch_assoc($resultado);
    
    if ($fila['total'] > 0) {
        // Hay libros asociados, redirigir con error
        header("Location: ../base/index.php?op=70&error=asociado");
        exit();
    }
    
    // 2. Si no hay libros asociados, proceder a borrar
    $consulta_borrar = "DELETE FROM lenguaje WHERE id = $lenguaje_id";
    if (bd_consulta($consulta_borrar)) {
        header("Location: ../base/index.php?op=70");
        exit();
    } else {
        // Error en el borrado
        header("Location: ../base/index.php?op=70&error=borrado");
        exit();
    }
} else {
    // No se proporcionó ID
    header("Location: ../base/index.php?op=70");
    exit();
}
?>