<?php
    display_errors ('display_errors' , 1);
    error_reporting (E_ALL);

    include ("Functions.php");

    $conn = conecta();
    session_start(); 

    if(isset($_SESSION['sessaoUsuario'])) {
        $_SESSION['sessaoUsuario'] = false;
    }else {
        echo"ERRO";
    }
?>