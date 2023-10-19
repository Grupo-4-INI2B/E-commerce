<?php

    ini_set ('display_errors', 1);    
    error_reporting (E_ALL);
    include ("../PHP/Funcoes.php");
    $conn = conecta();

    //Verifica se email foi enviado.
    if($_POST['submit'] && isset($_POST['email'])) {
        $email = $_POST['email'];

        if(verificaEmail($email)) { //Verifica se o email existe no banco de dados
            $codigo = geraSenha();
            $html = "<h1>Olá!</h1><br><h3>Seu código de recuperação de senha é: ".$codigo."</h3><br>";
            enviaEmail($email, "Usuário", "Código de recuperação de senha", $html);
    
            unset($conn);
            header("Location: Muda_senha.php?codigo=$codigo&email=$email");
            exit();
        }else {
            header("Location: Esqueci.php"); //email não existe no banco de dados
            exit();
        }    
    }else {
        header("Location: Esqueci.php");
        exit();
    }

    
?>

<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <form action="Esqueci.php" method="POST">
            <input type="email" name="email" placeholder="Email">
            <input type="submit" name="submit" value="Enviar">
        </form>
    </body>
</html>