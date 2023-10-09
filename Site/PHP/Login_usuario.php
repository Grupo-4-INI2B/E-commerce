<?php
    ini_set ('display_errors', 1);
    error_reporting (E_ALL);
    include("Funcoes.php");
    $conn = conecta();

    $email = ""; $senha = "";
    //Parâmetros vindos do formulário de cadastro e login e verificação se estão vazios.
    if(isset($_POST['email']) && isset($_POST['senha'])) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];
    }else {
        header("Location: ../HTML_CSS/HTML/Login.php");
    }

    //Verifica se o email e senha existem no banco de dados.
    $resultado = verificaUser($senha, $email);
    if(!$resultado) {
        header("Location: ../HTML_CSS/HTML/Login.php");
        exit();
    } else {
        header("Location: ../HTML_CSS/HTML/Index.php");
        exit();
    }
    
    unset($conn);
?>