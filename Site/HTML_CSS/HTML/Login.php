<!DOCTYPE html>
<html lang="en">
<?php
    display_errors ('display_errors' , 1);
    error_reporting (E_ALL);

    include ("Functions.php");

    $conn = conecta();

    if (isset($_SESSION['sessaoUsuario'])) {
        $sessaoUsuario = $_SESSION['sessaoUsuario'];
    } else {  
        $Cookie_email = '';
        if (isset($_COOKIE['Cookie_email']) && isset($_COOKIE['Cookie_senha'])) {
            $Cookie_email = $_COOKIE['Cookie_email'];
        }
    }
?>    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../CSS/login.css">
</head>
<body>
    <form name="frmLogin" method="post" action="../../PHP/Login_usuario.php">
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

                            <input type="email" id="email" name="email" placeholder="Email" value='$Cookie_email'/>
                            <br>
                        </div>
                        <div class="textfield">
                            <input type="password" id="senha" name="senha" placeholder="Senha" />
                        </div>
                        <button type="submit" class="btn-login">Login</button>
                        <a href="cadastro.html" style="color: #FFF" >Não tenho uma conta</a>
                    </div>
                    <!--
                    <button class="close-button">
                    <img src="IconX.svg" alt="Fechar">
                    </button>-->
            </div>
        </div>
    </div>
</form>
</body>
</html>
