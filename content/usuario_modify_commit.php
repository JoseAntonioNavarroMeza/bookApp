<?php
include('../base/bd.php');

// Validar que todos los campos requeridos están presentes
if (!isset($_POST['id']) || !isset($_POST['titulo']) || !isset($_POST['autor'])) {
    header('Location: ../base/index.php?op=10&error=missing_fields');
    exit;
}

// Recoger y limpiar los datos
$id = (int)$_POST['id'];
$titulo = trim($_POST['titulo']);
$autor = trim($_POST['autor']);
$genero = isset($_POST['genero']) ? trim($_POST['genero']) : '';
$anio = isset($_POST['anio']) ? (int)$_POST['anio'] : null;

// Validaciones básicas
if (empty($titulo) || empty($autor)) {
    header('Location: ../base/index.php?op=10&error=empty_fields');
    exit;
}

// Escapar los datos para SQL
$titulo_limpio = mysqli_real_escape_string($conexion, $titulo);
$autor_limpio = mysqli_real_escape_string($conexion, $autor);
$genero_limpio = mysqli_real_escape_string($conexion, $genero);

// Construir la consulta SQL
$sql = "UPDATE book SET 
        titulo = '$titulo_limpio',
        autor = '$autor_limpio',
        genero = ".($genero_limpio ? "'$genero_limpio'" : "NULL").",
        anio = ".($anio ? $anio : "NULL")."
        WHERE id = $id";

if (bd_consulta($sql)) {
    header('Location: ../base/index.php?op=10&success=book_updated');
} else {
    header('Location: ../base/index.php?op=10&error=update_failed');
}
exit;
?>