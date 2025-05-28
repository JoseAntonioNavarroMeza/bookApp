<?php
include('../base/bd.php');
include('../base/global.php');

// Obtenemos el dato del formulario
$editorial = $_POST['editorial'];

// Validamos que no venga vacío
if (!empty($editorial)) {
  // Insertamos en la tabla editorial
  $consulta = 'INSERT INTO editorial (editorial) VALUES ("' . $editorial . '")';
  bd_consulta($consulta);
}

// Redirigimos a la página donde se listan las editoriales
header('Location: ../base/index.php?op=80');
?>
