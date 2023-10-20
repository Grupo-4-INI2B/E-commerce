<?php
    
    ini_set ('display_errors', 1);    
    error_reporting (E_ALL);
    session_start();
    include ("../PHP/Funcoes.php");
    $conn = conecta();
   
    if($_POST) { //Verifica se a nova senha e o código foram enviados.
        if($_SESSION['codigo'] == $_POST['paramCodigo']) { //Verifica se o código enviado é igual ao código gerado.
            //Atualiza a senha do usuário no banco de dados.
            $update = $conn->prepare("UPDATE tbl_usuario SET senha = :novaSenha WHERE email = :email");
            $update->bindParam(':novaSenha', $_POST['novaSenha'], PDO::PARAM_STR);
            $update->bindParam(':email', $_GET['email'], PDO::PARAM_STR);
            $update->execute();

            unset($update);
            unset($conn);
            unset($_SESSION['codigo']);

            //Aviso de mudança de senha.
            $html = "<h1>Olá, !</h1><br><h3>Sua senha foi modificada, caso não reconheça essa mudança, 
            por favor entre em contato</h3><br>";
            enviaEmail($_GET['email'], "Usuário", "Mudança de senha", $html);

            header("Location: Login.php");
            exit();
        }      
    }

?>

<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <h2>Esqueci minha senha</h2>
        <form action="" method="post">
            <input type="text" name="novaSenha" placeholder="Nova senha">
            <input type="text" name="paramCodigo" placeholder="Código enviado por email">
            <input type="submit" name="submit" value="Enviar">
        </form>
    </body>
</html>