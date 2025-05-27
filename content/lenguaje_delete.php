<?php
$option = $_GET['id'];
$consulta = "DELETE FROM 'lenguaje' WHERE id=$option";

$result = bd_consulta($consulta);
if ($result) {
   echo "Lenguaje eliminado";
} else {
   echo "Error. El lenguaje no fue eliminado";
}
?>