<?php
require_once('../base/bd.php');

if (isset($_GET['username'])) {
    $username = $_GET['username'];
    
    $sql = "DELETE FROM usuario WHERE username = '$username'";
    
    if (bd_consulta($sql)) {
        header('Location: ../base/index.php?op=02');
    } else {
        echo "Error al eliminar el usuario";
    }
}
?>