<?php

$db_name = "engenharia";
$db_host = "localhost";
$db_user = "root";
$db_pass = "";  # db_pass = password

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if($conn->connect_error){
    die("Problema na conexão\nContate o admnistrador\n->".$conn->conn_error);
}

?>