<?php
require_once('../base/bd.php');

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    // Verificar si el autor tiene libros asociados en la tabla 'book' (usando la columna 'autor')
    $check_query = "SELECT COUNT(*) as count FROM book WHERE autor = $id";
    $check_result = bd_consulta($check_query);
    
    if ($check_result) {
        $row = mysqli_fetch_assoc($check_result);
        if ($row['count'] > 0) {
            header('Location: ../base/index.php?op=90&error=asociado');
            exit;
        }
    } else {
        // Manejo de error en la consulta
        header('Location: ../base/index.php?op=90&error=consulta');
        exit;
    }
    
    // Eliminar autor si no tiene libros asociados
    $delete_query = "DELETE FROM autor WHERE id = $id";
    if (bd_consulta($delete_query)) {
        header('Location: ../base/index.php?op=90&del=1');
    } else {
        header('Location: ../base/index.php?op=90&del=0');
    }
} else {
    header('Location: ../base/index.php?op=90');
}
exit;
?>