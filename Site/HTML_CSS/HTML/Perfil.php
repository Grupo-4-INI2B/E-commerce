<?php
    ini_set ('display_errors', 1);
    error_reporting (E_ALL);
    session_start();
    include ("../../PHP/Funcoes.php");
    $conn = conecta();

    if(isset($_SESSION['sessaoUsuario'])) {
        $sessaoUsuario = $_SESSION['sessaoUsuario'];
        $nome = $_SESSION['nome'];
    }else {
        header("Location: Login.php");
    }
?>

<!DOCTYPE html>
<html>
    
</html>