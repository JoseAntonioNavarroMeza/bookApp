<?php
require_once('../base/bd.php');

$id = $_POST['id'] ?? '';
$lenguaje = $_POST['lenguaje'] ?? '';
$lenguaje = trim($lenguaje);

if ($lenguaje === '') {
    header('Location: ../content/lenguaje_modify.php?id=' . urlencode($id) . '&error=datos&lenguaje=' . urlencode($lenguaje));
    exit;
}

// Validar si ya existe otro lenguaje con el mismo nombre
$verifica = "SELECT COUNT(*) AS total FROM lenguaje WHERE lenguaje = '" . addslashes($lenguaje) . "' AND id != " . intval($id);
$result = bd_consulta($verifica);
$fila = mysqli_fetch_assoc($result);

if ($fila['total'] > 0) {
    header('Location: ../content/lenguaje_modify.php?id=' . urlencode($id) . '&error=repetido&lenguaje=' . urlencode($lenguaje));
    exit;
}

// Actualizar
$update = "UPDATE lenguaje SET lenguaje = '" . addslashes($lenguaje) . "' WHERE id = " . intval($id);
bd_consulta($update);

header('Location: ../base/index.php?op=70');
exit;
