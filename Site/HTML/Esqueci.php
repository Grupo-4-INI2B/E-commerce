<?php

    ini_set ('display_errors', 1);    
    error_reporting (E_ALL);
    include ("../PHP/Funcoes.php");
    session_start();

    //Verifica se email foi enviado.
    if($_POST) {
        $email = $_POST['email'];

        if(verificaEmail($email)) { //Verifica se o email existe no banco de dados
            //Gera um código de recuperação de senha e envia para o email do usuário.
            $_SESSION['codigo'] = geraSenha();
            $html = "<h1>Olá!</h1><br><h3>Seu código de recuperação de senha é: ".$_SESSION['codigo']."</h3><br>";
            enviaEmail($email, "Usuário", "Código de recuperação de senha", $html);
            
            header("Location:Muda_senha.php?email=$email");
            exit();
        } else {
            header("Location: Esqueci.php");
            exit();
        }
    }

?>
<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <form action="" method="post">
            <input type="email" name="email" placeholder="Email">
            <input type="submit" name="submit" value="Enviar">
        </form>
    </body>
</html>