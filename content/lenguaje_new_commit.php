<?php
include('../base/bd.php');

// Recoger y limpiar el dato
$nombre = isset($_POST['lenguaje']) ? trim($_POST['lenguaje']) : '';

// Escapar comillas simples
$nombre_limpio = str_replace("'", "''", $nombre);

// Verificar duplicado
$sql = "SELECT lenguaje FROM lenguaje WHERE LOWER(TRIM(lenguaje)) = LOWER(TRIM('$nombre_limpio'))";
$resultado = bd_consulta($sql);

if (mysqli_num_rows($resultado) > 0) {
    header('Location: ../base/index.php?op=70&error=repetido');
    exit;
}

// Insertar si todo está bien
$sql_insert = "INSERT INTO lenguaje (lenguaje) VALUES ('$nombre_limpio')";
bd_consulta($sql_insert);

header('Location: ../base/index.php?op=70');
exit;
?>