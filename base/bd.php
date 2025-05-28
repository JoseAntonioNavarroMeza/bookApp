<?php
function bd_consulta($query)
{
    $hostname = "127.0.0.1";
    $user = "root";
    $password = "";
    $bd = "books";
    
    $connection = mysqli_connect($hostname, $user, $password, $bd);
    
    if (!$connection) {
        die('Error de conexión: ' . mysqli_connect_error());
    }
    
    mysqli_set_charset($connection, "utf8");
    
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);
    
    return $result;
}

?>