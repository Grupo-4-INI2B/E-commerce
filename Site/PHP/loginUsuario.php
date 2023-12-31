<?php
    ini_set ('display_errors', 1);
    error_reporting (E_ALL);
    include("funcoes.php");
    $conn = conecta();
    session_start();

    //Parâmetros vindos do formulário de cadastro e login e verificação se estão vazios.
    if(isset($_POST['email']) && isset($_POST['senha'])) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];
    }else {
        header("Location: ../HTML/login.php");
        exit();
    }

    //Verifica se o email e senha existem no banco de dados.
    $resultado = verificaUser($senha, $email);
    if($resultado) {
        defineCookie("cookie_email", $email, 14400);
    } else {
        header("Location: ../HTML/login.php");
        exit();
    }

    //Envia email para o usuário informando que houve um novo login.
    $html= "<h1>Olá!</h1><br><h3>Se não reconhece essa nova atividade por favor entre em contato</h3><br>";
    enviaEmail($email,  $_SESSION['nome'], "Nova atividade", $html);
    
    unset($conn);

    if(isset($_SESSION['carrinhoTpm'])) {
        $_SESSION['carrinho'] = $_SESSION['carrinhoTpm']; //Se houver um carrinho temporário, ele é transformado em permanente.
    }
    //Redireciona para a página inicial.
    header("Location: ../HTML/index.php");
    exit();
?>