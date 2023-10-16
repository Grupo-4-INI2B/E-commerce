<?php

    ini_set ('display_errors', 1);    
    error_reporting (E_ALL);
    include ("../../PHP/Funcoes.php");
    $conn = conecta();

    $email = ""; 

    if(!isset($_SESSION['sessaoUsuario'])) { //Verifica se há sessão iniciada.
        header("Location: index.php");
    }

    //Verifica se email foi enviado.
    if(isset($_POST['email'])) {
        $email = $_POST['email'];
    }else {
        header("Location: ../HTML_CSS/HTML/Esqueci.html");
    }

    if(verificaEmail($email)) { //Verifica se o email existe no banco de dados
        $codigo = geraSenha();
        $html = "<h1>Olá!</h1><br><h3>Seu código de recuperação de senha é: ".$codigo."</h3><br>";
        enviaEmail($email,  $_SESSION['nome'], "Código de recuperação de senha", $html);
        header("Location: Muda_senha.php?codigo=$codigo&email=$email");
    }else {
        header("Location: ../HTML_CSS/HTML/Esqueci.html"); //email não existe no banco de dados
    }    
?>

<html>
</html>