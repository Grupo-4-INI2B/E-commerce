<?php

    ini_set ('display_errors', 1);    
    error_reporting (E_ALL);
    include ("../PHP/funcoes.php");
    session_start();

    //Verifica se email foi enviado.
    if($_POST) {
        $email = $_POST['email'];

        if(verificaEmail($email)) { //Verifica se o email existe no banco de dados
            //Gera um código de recuperação de senha e envia para o email do usuário.
            $_SESSION['codigo'] = geraSenha();
            $html = "<h1>Olá!</h1><br><h3>Seu código de recuperação de senha é: ".$_SESSION['codigo']."</h3><br>";
            enviaEmail($email, "Usuário", "Código de recuperação de senha", $html);
            
            header("Location:mudaSenha.php?email=$email");
            exit();
        } else {
            header("Location: esqueci.php");
            exit();
        }
    }

?>
<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="../CSS/esqueci.css" />
    <link rel="stylesheet" href="../CSS/base.css" />

    </head>
    <body>
        <form action="" method="post">
        <div class="main-login">
            <div class="login-container">
                <div class="left-login">
                    <img src="../Imagens/logocaixinhabranco.svg" />
                    <br />
                    <h1>Esqueceu a senha?<br /></h1>
                    <h3>Mais cuidado da próxima vez.</h3>
                </div>
                <div class="right-login">
                    <div class="card-login">
                        <h1>Insira seu email:</h1>
                        <br />
 
                        <div class="textfield">
                            <input type="email" name="email" placeholder="Email">
                            <br />
                        </div>
                        
                        <button type="submit" name="submit" value="Enviar" class="btn-login">Enviar</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </body>
</html>