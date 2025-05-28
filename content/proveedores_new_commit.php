<?php
include('../base/bd.php');

// Recoger y limpiar datos
$rfc = isset($_POST['rfc']) ? strtoupper(trim($_POST['rfc'])) : '';
$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
$telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';
$correo = isset($_POST['correo']) ? trim($_POST['correo']) : '';

// Validaciones básicas
if (empty($rfc) || empty($nombre) || empty($telefono) || empty($correo)) {
    header('Location: ../base/index.php?op=31&error=datos');
    exit;
}

// Validar formato RFC (simplificado)
if (!preg_match('/^[A-Z0-9]{12,13}$/', $rfc)) {
    header('Location: ../base/index.php?op=31&error=rfc_invalido');
    exit;
}

// Validar teléfono (10 dígitos)
if (!preg_match('/^[0-9]{10}$/', $telefono)) {
    header('Location: ../base/index.php?op=31&error=telefono_invalido');
    exit;
}

// Validar correo
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    header('Location: ../base/index.php?op=31&error=correo_invalido');
    exit;
}

// Verificar duplicados
$duplicados = [
    'rfc' => ['campo' => 'rfc', 'error' => 'rfc_repetido'],
    'telefono' => ['campo' => 'telefono', 'error' => 'telefono_repetido'],
    'correo' => ['campo' => 'correo', 'error' => 'correo_repetido']
];

foreach ($duplicados as $dato => $config) {
    $check_query = "SELECT {$config['campo']} FROM proveedor WHERE {$config['campo']} = '${$dato}'";
    $check_result = bd_consulta($check_query);
    
    if (mysqli_num_rows($check_result) > 0) {
        header("Location: ../base/index.php?op=31&error={$config['error']}");
        exit;
    }
}

// Insertar proveedor
$insert_query = "INSERT INTO proveedor (rfc, nombre, telefono, correo) 
                 VALUES ('$rfc', '$nombre', '$telefono', '$correo')";

if (bd_consulta($insert_query)) {
    header('Location: ../base/index.php?op=30&success=creado');
} else {
    header('Location: ../base/index.php?op=31&error=insertar');
}
exit;
?>