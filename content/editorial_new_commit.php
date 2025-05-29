<?php
include('../base/bd.php');

// Recoger y limpiar el dato
$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';

// Escapar comillas simples
$nombre_limpio = str_replace("'", "''", $nombre);

// Verificar duplicado
$sql = "SELECT editorial FROM editorial WHERE LOWER(TRIM(editorial)) = LOWER(TRIM('$nombre_limpio'))";
$resultado = bd_consulta($sql);

if (mysqli_num_rows($resultado) > 0) {
    header('Location: ../base/index.php?op=81&error=repetido');
    exit;
}

// Insertar si todo está bien
$sql_insert = "INSERT INTO editorial (editorial) VALUES ('$nombre_limpio')";
bd_consulta($sql_insert);

header('Location: ../base/index.php?op=80');
exit;
?>