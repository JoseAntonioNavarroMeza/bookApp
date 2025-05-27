<?php
$option = $_GET['id'];
$consulta = "DELETE FROM pais WHERE id=$option";

$result = bd_consulta($consulta);
if ($result) {
   echo "País eliminado";
} else {
   echo "Error. El país no fue eliminado";
}
header('Location: ../base/index.php?op=60');
?>