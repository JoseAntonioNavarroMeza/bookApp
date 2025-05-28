<?php
include('../base/bd.php');

// Recoger y validar los datos
$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
$telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';
$correo = isset($_POST['correo']) ? trim($_POST['correo']) : '';

// Validaciones básicas
if (empty($nombre) || empty($telefono)) {
    header('Location: ../base/index.php?op=20&error=datos');
    exit;
}

// Validar formato del teléfono (10 dígitos)
if (!preg_match('/^[0-9]{10}$/', $telefono)) {
    header('Location: ../base/index.php?op=20&error=telefono_invalido');
    exit;
}

// Validar formato de correo si se proporcionó
if (!empty($correo) && !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    header('Location: ../base/index.php?op=20&error=correo_invalido');
    exit;
}

// Verificar duplicados de teléfono
$check_telefono = "SELECT telefono FROM cliente WHERE telefono = '$telefono'";
$result_telefono = bd_consulta($check_telefono);

if (mysqli_num_rows($result_telefono) > 0) {
    header('Location: ../base/index.php?op=20&error=telefono_repetido');
    exit;
}

// Verificar duplicados de correo (solo si se proporcionó)
if (!empty($correo)) {
    $check_correo = "SELECT correo FROM cliente WHERE correo = '$correo'";
    $result_correo = bd_consulta($check_correo);

    if (mysqli_num_rows($result_correo) > 0) {
        header('Location: ../base/index.php?op=20&error=correo_repetido');
        exit;
    }
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