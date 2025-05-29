<?php
require_once('../base/bd.php');

$id = $_POST['id'] ?? '';
$nombre = $_POST['nombre'] ?? '';
$nombre = trim($nombre);

if ($nombre === '') {
    header('Location: ../content/pais_modify.php?id=' . urlencode($id) . '&error=datos&nombre=' . urlencode($nombre));
    exit;
}

// 1. Primero verificar si tiene autores asociados (doble validación por seguridad)
$query_autores = "SELECT COUNT(*) as total FROM autor WHERE nacionalidad = " . intval($id);
$result_autores = bd_consulta($query_autores);
$fila_autores = mysqli_fetch_assoc($result_autores);

if ($fila_autores['total'] > 0) {
    header('Location: ../content/pais_modify.php?id=' . urlencode($id) . '&error=asociado');
    exit;
}

// 2. Validar si ya existe otro país con el mismo nombre
$verifica = "SELECT COUNT(*) AS total FROM pais WHERE nombre = '" . addslashes($nombre) . "' AND id != " . intval($id);
$result = bd_consulta($verifica);
$fila = mysqli_fetch_assoc($result);

if ($fila['total'] > 0) {
    header('Location: ../content/pais_modify.php?id=' . urlencode($id) . '&error=repetido&nombre=' . urlencode($nombre));
    exit;
}

// 3. Actualizar si pasa todas las validaciones
$update = "UPDATE pais SET nombre = '" . addslashes($nombre) . "' WHERE id = " . intval($id);
bd_consulta($update);

header('Location: ../base/index.php?op=60');
exit;
?>