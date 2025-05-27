<?php
$option = $_GET['id'];
$consulta = "DELETE FROM 'autor' WHERE id=$option";

$result = bd_consulta($consulta);
if ($result) {
   echo "Autor eliminado";
} else {
   echo "Error. El Autor no fue eliminado";
}
?>