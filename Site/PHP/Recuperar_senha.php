<?php

    display_errors ('display_errors' , 1);
    error_reporting (E_ALL);
    session_start();

    include ("Funcoes.php");
    $conn = conecta();

    $email = $_POST['email'];
    
?>