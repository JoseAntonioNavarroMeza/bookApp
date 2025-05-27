<?php
include('../base/bd.php');
include('../base/global.php');

// Obtenemos el nombre del país desde el formulario
$nombre = $_POST['nombre'];

// Validamos que no esté vacío
if (!empty($nombre)) {
  // Insertamos en la base de datos
  $consulta = 'INSERT INTO pais (nombre) VALUES ("' . $nombre . '")';
  bd_consulta($consulta);
}

header('Location: ../base/index.php?op=60');
?>
