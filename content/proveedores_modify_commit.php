<?php
require_once('../base/bd.php');

// Validamos que vengan los datos por POST
if (
    !isset($_POST['rfc_original'], $_POST['rfc'], $_POST['nombre'], $_POST['telefono'], $_POST['correo']) ||
    empty(trim($_POST['rfc'])) ||
    empty(trim($_POST['nombre'])) ||
    empty(trim($_POST['telefono'])) ||
    empty(trim($_POST['correo']))
) {
    header('Location: ../base/index.php?op=32&error=datos');
    exit;
}

$rfc_original = trim($_POST['rfc_original']);
$rfc = trim($_POST['rfc']);
$nombre = trim($_POST['nombre']);
$telefono = trim($_POST['telefono']);
$correo = trim($_POST['correo']);

// Abrimos conexión manual para hacer las validaciones y actualizar
$conexion = mysqli_connect("127.0.0.1", "root", "", "books");
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
mysqli_set_charset($conexion, "utf8");

// Escapamos datos para evitar inyección SQL
$rfc_original_esc = mysqli_real_escape_string($conexion, $rfc_original);
$rfc_esc = mysqli_real_escape_string($conexion, $rfc);
$nombre_esc = mysqli_real_escape_string($conexion, $nombre);
$telefono_esc = mysqli_real_escape_string($conexion, $telefono);
$correo_esc = mysqli_real_escape_string($conexion, $correo);

// Validar que no se repita RFC en otro registro (solo si el RFC fue cambiado)
if ($rfc_original !== $rfc) {
    $consulta_rfc = "SELECT RFC FROM proveedor WHERE RFC = '$rfc_esc'";
    $res_rfc = mysqli_query($conexion, $consulta_rfc);
    if ($res_rfc && mysqli_num_rows($res_rfc) > 0) {
        mysqli_close($conexion);
        header('Location: ../base/index.php?op=32&error=rfc_repetido');
        exit;
    }
}

// Validar teléfono único (excepto si es el mismo proveedor)
$consulta_tel = "SELECT RFC FROM proveedor WHERE telefono = '$telefono_esc' AND RFC != '$rfc_original_esc'";
$res_tel = mysqli_query($conexion, $consulta_tel);
if ($res_tel && mysqli_num_rows($res_tel) > 0) {
    mysqli_close($conexion);
    header('Location: ../base/index.php?op=32&error=telefono_repetido');
    exit;
}

// Validar correo único (excepto si es el mismo proveedor)
$consulta_correo = "SELECT RFC FROM proveedor WHERE correo = '$correo_esc' AND RFC != '$rfc_original_esc'";
$res_correo = mysqli_query($conexion, $consulta_correo);
if ($res_correo && mysqli_num_rows($res_correo) > 0) {
    mysqli_close($conexion);
    header('Location: ../base/index.php?op=32&error=correo_repetido');
    exit;
}

// Actualizar datos en la tabla proveedor
$update = "UPDATE proveedor SET
    RFC = '$rfc_esc',
    nombre = '$nombre_esc',
    telefono = '$telefono_esc',
    correo = '$correo_esc'
    WHERE RFC = '$rfc_original_esc'";

if (mysqli_query($conexion, $update)) {
    mysqli_close($conexion);
    header('Location: ../base/index.php?op=30');
    exit;
} else {
    $error_msg = mysqli_error($conexion);
    mysqli_close($conexion);
    die("Error al actualizar proveedor: $error_msg");
}

