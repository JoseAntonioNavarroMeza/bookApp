<?php
$option = $_GET['id'];
$consulta = "DELETE FROM 'cliente' WHERE id=$option";

$result = bd_consulta($consulta);
if ($result) {
   echo "Cliente eliminado";
} else {
   echo "Error. El cliente no fue eliminado";
}
?>