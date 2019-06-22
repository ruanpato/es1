<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
} else if (isset($_SESSION['user']) != "") {
    $select_sql = "SELECT tipo_usuario FROM `Usuario` WHERE cpf_usuario=?".$_SESSION['user'];
    $query = mysql_query($select_sql, $conn);
    if(isset($query)){
        if($query=="Cliente"){
            header("Location: agenda.php");         # Cliente page
        }else{
            header("Location: agendamentos.php");   # Funcionarios page
        }
    }else{
        die('Não foi possível conectar com o banco de dados: ' . mysql_error());
    }

    header("Location: login.php");
    exit;
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user']);
    header("Location: login.php");
    exit;
}
