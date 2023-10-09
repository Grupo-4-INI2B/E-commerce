<?php

    ini_set ('display_errors', 1);    
    error_reporting (E_ALL);
    include ("Funcoes.php");
    $conn = conecta();

    $email = ""; 

    //Verifica se email foi enviado.
    if(isset($_POST['email'])) {
        $email = $_POST['email'];
    }else {
        header("Location: ../HTML_CSS/HTML/Esqueci.html");
    }

    if(verificaEmail($email)) { //Verifica se o email existe no banco de dados
        $codigo = geraSenha();
        enviaEmail($email, "Código de recuperação de senha", $codigo, "bbytecraft@gmail.com");
        header("Location: Muda_senha.php?codigo=$codigo&email=$email");
    }else {
        header("Location: ../HTML_CSS/HTML/Esqueci.html"); //email não existe no banco de dados
    }    
?>