<?php
$option = $_GET['id'];
$consulta = "DELETE FROM 'usuario' WHERE id=$option";

$result = bd_consulta($consulta);
if ($result) {
   echo "Usuario eliminado";
} else {
   echo "Error. El usuario no fue eliminado";
}
?>