<?php
require_once('../base/bd.php');

// Collect and clean data
$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
$nacionalidad = isset($_POST['nacionalidad']) ? (int)$_POST['nacionalidad'] : 0;

// Validate inputs
if (empty($nombre) || $nacionalidad <= 0) {
    header('Location: ../base/index.php?op=91&error=datos');
    exit;
}

// Escape quotes and check for duplicates
$nombre_limpio = str_replace("'", "''", $nombre);

// Check if author already exists
$sql = "SELECT nombre FROM autor WHERE LOWER(TRIM(nombre)) = LOWER(TRIM('$nombre_limpio'))";
$resultado = bd_consulta($sql);

if (mysqli_num_rows($resultado) > 0) {
    header('Location: ../base/index.php?op=91&error=repetido');
    exit;
}

// Insert new author
$sql_insert = "INSERT INTO autor (nombre, nacionalidad) VALUES ('$nombre_limpio', $nacionalidad)";
if (bd_consulta($sql_insert)) {
    header('Location: ../base/index.php?op=90&add=1');
} else {
    header('Location: ../base/index.php?op=90&add=0');
}
exit;
?>