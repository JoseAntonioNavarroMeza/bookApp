<?php
require_once('../base/bd.php');

function validarCorreo($correo) {
    return filter_var($correo, FILTER_VALIDATE_EMAIL);
}

function validarTelefono($telefono) {
    return preg_match('/^[0-9]{10}$/', $telefono);
}

if (!isset($_POST['nombre'], $_POST['telefono'], $_POST['correo'], $_POST['telefono_original'])) {
    header('Location: ../base/index.php?op=20&error=datos');
    exit;
}

$nombre = trim($_POST['nombre']);
$telefono = trim($_POST['telefono']);
$correo = trim($_POST['correo']);
$telefono_original = trim($_POST['telefono_original']);

if (empty($nombre) || empty($telefono) || empty($correo)) {
    header('Location: ../base/index.php?op=22&telefono=' . urlencode($telefono_original) . '&error=datos');
    exit;
}

if (!validarTelefono($telefono)) {
    header('Location: ../base/index.php?op=22&telefono=' . urlencode($telefono_original) . '&error=telefono_invalido');
    exit;
}

if (!validarCorreo($correo)) {
    header('Location: ../base/index.php?op=22&telefono=' . urlencode($telefono_original) . '&error=correo_invalido');
    exit;
}

// Verificar teléfono duplicado
$query = "SELECT * FROM cliente WHERE telefono = '$telefono' AND telefono != '$telefono_original'";
if (mysqli_num_rows(bd_consulta($query)) > 0) {
    header('Location: ../base/index.php?op=22&telefono=' . urlencode($telefono_original) . '&error=telefono_repetido');
    exit;
}

// Verificar correo duplicado
$query = "SELECT * FROM cliente WHERE correo = '$correo' AND telefono != '$telefono_original'";
if (mysqli_num_rows(bd_consulta($query)) > 0) {
    header('Location: ../base/index.php?op=22&telefono=' . urlencode($telefono_original) . '&error=correo_repetido');
    exit;
}

// Actualizar datos
$query = "UPDATE cliente SET nombre = '$nombre', telefono = '$telefono', correo = '$correo' WHERE telefono = '$telefono_original'";
bd_consulta($query);

header('Location: ../base/index.php?op=20');
exit;
