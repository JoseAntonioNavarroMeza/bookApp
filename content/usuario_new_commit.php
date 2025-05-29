<?php
include('../base/bd.php');

// Recoger y limpiar los datos
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';
$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';

// Escapar comillas simples
$username_limpio = str_replace("'", "''", $username);
$nombre_limpio = str_replace("'", "''", $nombre);

// Verificar duplicado
$sql = "SELECT username FROM usuario WHERE LOWER(TRIM(username)) = LOWER(TRIM('$username_limpio'))";
$resultado = bd_consulta($sql);

if (mysqli_num_rows($resultado) > 0) {
    header('Location: ../base/index.php?op=03&error=repetido');
    exit;
}

// Hash de la contraseña (usar password_hash en producción)
$hashed_password = md5($password); // Nota: md5 no es seguro, usar password_hash() en aplicaciones reales

// Insertar si todo está bien
$sql_insert = "INSERT INTO usuario (username, password, nombre) VALUES ('$username_limpio', '$hashed_password', '$nombre_limpio')";
bd_consulta($sql_insert);

header('Location: ../base/index.php?op=02');
exit;
?>