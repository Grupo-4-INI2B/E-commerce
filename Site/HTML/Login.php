<!DOCTYPE html>
<html lang="pt-BR">    
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Byte Craft - login</title>
    <link rel="stylesheet" href="../CSS/login.css">
</head>
<?php
    ini_set ('display_errors', 1);
    error_reporting (E_ALL);
    session_start();
    include ("../PHP/Funcoes.php");
    $conn = conecta();

    //Verifica se o usuário está logado.
    if (isset($_SESSION['sessaoUsuario'])) {
        $sessaoUsuario = $_SESSION['sessaoUsuario'];
    } else { 
        $sessaoUsuario = null;
        $nome = null;
        $adm = false;
    }

    if(!$sessaoUsuario){
        if(isset($_COOKIE['cookie_email'])) {
            $email = $_COOKIE['cookie_email'];
        }else {
            $email = null;
        }
    }

    unset($conn);
?>
<body>
    <form name="frmLogin" method="post" action="../PHP/Login_usuario.php">
    <div class="main-login">
        <div class="login-container">

            <div class="left-login">
                <img src="../Imagens/logocaixinhabranco.svg">

                <h1>Bem-vindo de volta!<br></h1>
                <h3>Acesse sua conta agora mesmo.</h3>
            </div>
            <div class="right-login">
                <div class="card-login">
                    <h1>Entre em sua conta</h1>
                    <br>
                        <div class="textfield">
                            <input type="email" id="email" name="email" placeholder="Email"/>
                            <br>
                        </div>
                        <div class="textfield">
                            <input type="password" id="senha" name="senha" placeholder="Senha"/>
                        </div>  
                        <button type="submit" class="btn-login">Login</button>
                        <a href="Cadastro.html" style="color: #FFF" >Não tenho uma conta</a>
                        <a href="Esqueci.php" style="color: #FFF">Esqueci a senha</a>
                </div>
            </div>
        </div>
    </div>
</form>
</body>
</html>
