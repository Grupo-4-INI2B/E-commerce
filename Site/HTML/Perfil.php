

<!DOCTYPE html>
<html lang="pt-BR">    
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Byte Craft - Perfil</title>
    <link rel="stylesheet" href="../CSS/login.css">
</head>

<body>
    <form name="frmLogin" method="post" action="../PHP/Login_usuario.php">
    <div class="main-login">
        <div class="login-container">

            <div class="left-login">
                <img src="../Imagens/logocaixinhabranco.svg">

                <h1>Bem-vindo usuário!<br></h1>
                <h3>Este é seu perfil.</h3>
            </div>
            <div class="right-login">
                <div class="card-login">
                    <?php
                    ini_set ('display_errors', 1);
                    error_reporting (E_ALL);
                    session_start();
                     include ("../PHP/Funcoes.php");

                        if(isset($_SESSION['sessaoUsuario'])) {
                             $sessaoUsuario = $_SESSION['sessaoUsuario'];
                             $nome = $_SESSION['nome'];
                             $adm = $_SESSION['adm'];
                         }else {
                          header("Location: Login.php");
                          exit();
                                }

    echo"
        <!DOCTYPE html>
            <html lang='pt-BR'>
                <head>
                    <meta charset='UTF-8'>
                    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Byte Craft - Home</title>
                    <link rel='stylesheet' href='../CSS/Perfil.css'>
                </head>
    ";
    if(!$adm)
    {
        echo "
            <body>
                <h1 class='titulo-perfil'>Perfil</h1>
                <h2 class='campo-perfil'>Nome : $nome</h2>
                <h2 class='campo-perfil'>Email : $sessaoUsuario</h2>
                <a class='btn-logout' href='../PHP/Logout_usuario.php'>Logout</a>
                <br>
                <a class='btn-logout' href='Excluir_usuario.php'>Excluir Perfil</a>
            </body>
        </html>";
    }else {
        echo "<h1>Perfil</h1>";
        echo "<h2>Nome: $nome</h2>";
        echo "<h2>Email: $sessaoUsuario</h2>";
        echo "<h2>Administrador</h2>";
        echo "<h2><a href='Usuarios.php'>Administar Usuários</a></h2>";
        echo "<h2><a href='Crud.php'>Administar Produtos</a></h2>";
        echo "<a href='../PHP/Logout_usuario.php'>Logout</a></html>";
    }

?>
                </div>
            </div>
        </div>
    </div>
</form>
</body>
</html>
