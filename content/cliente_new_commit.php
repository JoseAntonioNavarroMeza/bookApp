<?php
require_once('../base/bd.php');

// Recoger y limpiar datos
$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
$telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';
$correo = isset($_POST['correo']) ? trim($_POST['correo']) : '';

// Validar datos obligatorios
if (empty($nombre) || empty($telefono)) {
    header('Location: ../base/index.php?op=21&error=datos');
    exit;
}

// Verificar si el teléfono ya existe
$sql = "SELECT telefono FROM cliente WHERE telefono = '$telefono'";
$resultado = bd_consulta($sql);

if (mysqli_num_rows($resultado) > 0) {
    header('Location: ../base/index.php?op=21&error=repetido');
    exit;
}

// Insertar nuevo cliente
$sql_insert = "INSERT INTO cliente (nombre, telefono, correo) VALUES ('$nombre', '$telefono', '$correo')";
if (bd_consulta($sql_insert)) {
    header('Location: ../base/index.php?op=20&add=1');
} else {
    header('Location: ../base/index.php?op=20&add=0');
}
exit;
?>