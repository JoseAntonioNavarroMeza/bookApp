<?php
$option = $_GET['id'];
$consulta = "DELETE FROM editorial WHERE id=$option";

$result = bd_consulta($consulta);
if ($result) {
   echo "editorial eliminada";
} else {
   echo "Error. La editorial no fue eliminada";
}
header('Location: ../base/index.php?op=80');
?>