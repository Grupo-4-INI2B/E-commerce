<?php

    ini_set ('display_errors', 1);    
    error_reporting (E_ALL);

    include ("Funcoes.php");
    $conn = conecta();

    $email = $_POST['email']; //Vindo do formulário Esqueci.html
    
    if($email == '') { //Verifica se o campo está vazio
        header("Location: ../../HTML_CSS/HTML/Esqueci.php");
    }

    if(verificaEmail($email)) { //Verifica se o email existe no banco de dados
        $codigo = geraSenha();
        enviaEmail($email, "Código de recuperação de senha", $codigo, "bbytecraft@gmail.com");
        header("Location: Muda_senha.php?codigo=$codigo&email=$email");
    }else {
        header("Location: ../../HTML_CSS/HTML/Esqueci.html"); //email não existe no banco de dados
    }    
?>