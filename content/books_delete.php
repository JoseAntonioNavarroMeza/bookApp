<?php
$option = $_GET['id'];
$consulta = "DELETE FROM 'book' WHERE id=$option";

$result = bd_consulta($consulta);
if ($result) {
   echo "Libro eliminado";
} else {
   echo "Error. El libro no fue eliminado";
}
?>