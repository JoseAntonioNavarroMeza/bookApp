<?php
require_once('../base/bd.php');

$id = $_POST['id'] ?? '';
$nombre = $_POST['nombre'] ?? '';
$nacionalidad = $_POST['nacionalidad'] ?? '';

$nombre = trim($nombre);
$nacionalidad = intval($nacionalidad);

if ($nombre === '' || $nacionalidad === 0) {
    header('Location: ../content/autores_modify.php?id=' . urlencode($id) . '&error=datos&nombre=' . urlencode($nombre) . '&nacionalidad=' . urlencode($nacionalidad));
    exit;
}

// Validar si ya existe otro autor con el mismo nombre (ignorando el id actual)
$verifica = "SELECT COUNT(*) AS total FROM autor WHERE nombre = '" . addslashes($nombre) . "' AND id != " . intval($id);
$result = bd_consulta($verifica);
$fila = mysqli_fetch_assoc($result);

if ($fila['total'] > 0) {
    header('Location: ../content/autor_modify.php?id=' . urlencode($id) . '&error=repetido&nombre=' . urlencode($nombre) . '&nacionalidad=' . urlencode($nacionalidad));
    exit;
}

// Actualizar
$update = "UPDATE autor SET nombre = '" . addslashes($nombre) . "', nacionalidad = " . $nacionalidad . " WHERE id = " . intval($id);
bd_consulta($update);

header('Location: ../base/index.php?op=90');
exit;
