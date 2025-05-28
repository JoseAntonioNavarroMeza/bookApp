<?php
include('../base/bd.php');
include('../base/global.php');

// Obtenemos el lenguaje enviado desde el formulario
$lenguaje = $_POST['lenguaje'];

// Validamos que no venga vacío
if (!empty($lenguaje)) {
  // Insertamos en la tabla lenguaje
  $consulta = 'INSERT INTO lenguaje (lenguaje) VALUES ("' . $lenguaje . '")';
  bd_consulta($consulta);
}

// Redirigimos después de insertar (ajusta la URL según tu estructura)
header('Location: ../base/index.php?op=70');
?>
