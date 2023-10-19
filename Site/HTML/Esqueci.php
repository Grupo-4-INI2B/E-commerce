<?php

    ini_set ('display_errors', 1);    
    error_reporting (E_ALL);
    include ("../PHP/Funcoes.php");
    $conn = conecta();

    if(!isset($_SESSION['sessaoUsuario'])) { //Verifica se há sessão iniciada.
        header("Location: Login.php");
        exit();
    }

    //Verifica se email foi enviado.
    if(isset($_POST['email'])) {
        $email = $_POST['email'];
    }else {
        header("Location: Esqueci.php");
        exit();
    }

    if(verificaEmail($email)) { //Verifica se o email existe no banco de dados
        $codigo = geraSenha();
        $html = "<h1>Olá!</h1><br><h3>Seu código de recuperação de senha é: ".$codigo."</h3><br>";
        enviaEmail($email,  $_SESSION['nome'], "Código de recuperação de senha", $html);

        unset($conn);
        header("Location: Muda_senha.php?codigo=$codigo&email=$email");
        exit();
    }else {
        header("Location: Esqueci.php"); //email não existe no banco de dados
        exit();
    }    
?>

<!DOCTYPE html>
<html>
    
</html>