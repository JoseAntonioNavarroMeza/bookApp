<?php
require_once('../base/bd.php');

if (!isset($_POST['username_original'], $_POST['nombre'], $_POST['password'])) {
    header('Location: ../base/index.php?op=04&error=datos&username=' . urlencode($_POST['username_original']));
    exit;
}

$username = addslashes($_POST['username_original']);
$nombre = trim(addslashes($_POST['nombre']));
$password = trim(addslashes($_POST['password']));

// Verificar si el nombre está repetido en otro usuario
$verificar = "SELECT username FROM usuario WHERE nombre = '$nombre' AND username != '$username'";
$resultado = bd_consulta($verificar);
if (mysqli_num_rows($resultado) > 0) {
    header('Location: ../base/index.php?op=04&error=repetido&username=' . urlencode($username));
    exit;
}

// Actualizar datos
$actualizar = "UPDATE usuario SET nombre = '$nombre', password = '$password' WHERE username = '$username'";
if (bd_consulta($actualizar)) {
    header('Location: ../base/index.php?op=02');
    exit;
} else {
    die('Error al actualizar el usuario');
}
