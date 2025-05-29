<?php
require_once('../base/bd.php');

$id = $_POST['id'] ?? '';
$lenguaje = $_POST['lenguaje'] ?? '';
$lenguaje = trim($lenguaje);

if ($lenguaje === '') {
    header('Location: ../content/lenguaje_modify.php?id=' . urlencode($id) . '&error=datos&lenguaje=' . urlencode($lenguaje));
    exit;
}

// 1. Primero verificar si tiene libros asociados (doble validación por seguridad)
$query_libros = "SELECT COUNT(*) as total FROM book WHERE idioma = " . intval($id);
$result_libros = bd_consulta($query_libros);
$fila_libros = mysqli_fetch_assoc($result_libros);

if ($fila_libros['total'] > 0) {
    header('Location: ../content/lenguaje_modify.php?id=' . urlencode($id) . '&error=asociado');
    exit;
}

// 2. Validar si ya existe otro lenguaje con el mismo nombre
$verifica = "SELECT COUNT(*) AS total FROM lenguaje WHERE lenguaje = '" . addslashes($lenguaje) . "' AND id != " . intval($id);
$result = bd_consulta($verifica);
$fila = mysqli_fetch_assoc($result);

if ($fila['total'] > 0) {
    header('Location: ../content/lenguaje_modify.php?id=' . urlencode($id) . '&error=repetido&lenguaje=' . urlencode($lenguaje));
    exit;
}

// 3. Actualizar si pasa todas las validaciones
$update = "UPDATE lenguaje SET lenguaje = '" . addslashes($lenguaje) . "' WHERE id = " . intval($id);
bd_consulta($update);

header('Location: ../base/index.php?op=70');
exit;
?>