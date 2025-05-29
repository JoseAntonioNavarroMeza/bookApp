<?php
require_once('../base/bd.php');

$id = $_POST['id'] ?? '';
$editorial = $_POST['editorial'] ?? '';
$editorial = trim($editorial);

if ($editorial === '') {
    header('Location: ../content/editorial_modify.php?id=' . urlencode($id) . '&error=datos&editorial=' . urlencode($editorial));
    exit;
}

// Validar si ya existe otra editorial con el mismo nombre
$verifica = "SELECT COUNT(*) AS total FROM editorial WHERE editorial = '" . addslashes($editorial) . "' AND id != " . intval($id);
$result = bd_consulta($verifica);
$fila = mysqli_fetch_assoc($result);

if ($fila['total'] > 0) {
    header('Location: ../content/editorial_modify.php?id=' . urlencode($id) . '&error=repetido&editorial=' . urlencode($editorial));
    exit;
}

// Actualizar
$update = "UPDATE editorial SET editorial = '" . addslashes($editorial) . "' WHERE id = " . intval($id);
bd_consulta($update);

header('Location: ../base/index.php?op=80');
exit;
