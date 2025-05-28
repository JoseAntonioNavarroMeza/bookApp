<?php
include('../base/bd.php');

// Validación básica
if (empty($nombre)) {
    header('Location: ../base/index.php?op=60&error=vacio');
    exit;
}

// Escapar comillas simples
$nombre_limpio = str_replace("'", "''", $nombre);

// Verificar duplicado
$sql = "SELECT nombre FROM pais WHERE LOWER(TRIM(nombre)) = LOWER(TRIM('$nombre_limpio'))";
$resultado = bd_consulta($sql);

if (mysqli_num_rows($resultado) > 0) {
    header('Location: ../base/index.php?op=60&error=repetido&t=' . time());
    exit;
}

// Insertar nuevo registro
$sql_insert = "INSERT INTO pais (nombre) VALUES ('$nombre_limpio')";
bd_consulta($sql_insert);

header('Location: ../base/index.php?op=60');
exit;
?>
