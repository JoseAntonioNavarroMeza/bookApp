<?php
include('../base/bd.php');

// Recoger y validar los datos del formulario
$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
$telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';
$correo = isset($_POST['correo']) ? trim($_POST['correo']) : '';

// Verificar datos obligatorios
if (empty($nombre) || empty($telefono)) {
    header('Location: ../base/index.php?op=20&error=datos');
    exit;
}

// Verificar si el teléfono ya existe
$check_query = "SELECT telefono FROM cliente WHERE telefono = '$telefono'";
$check_result = bd_consulta($check_query);

if (mysqli_num_rows($check_result) > 0) {
    header('Location: ../base/index.php?op=20&error=repetido');
    exit;
}

// Insertar el nuevo cliente
$insert_query = "INSERT INTO cliente (nombre, telefono, correo) 
                 VALUES ('$nombre', '$telefono', " . ($correo ? "'$correo'" : "NULL") . ")";

if (bd_consulta($insert_query)) {
    header('Location: ../base/index.php?op=20&success=creado');
} else {
    header('Location: ../base/index.php?op=20&error=insertar');
}
exit;
?>