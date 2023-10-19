<?php
    
    ini_set ('display_errors', 1);    
    error_reporting (E_ALL);
    include ("../PHP/Funcoes.php");
    $conn = conecta();

    if(isset($_GET['codigo']) && isset($_GET['email']) && //Verifica se o código e o email foram enviados.
       isset($_POST['novaSenha']) && isset($_POST['paramCodigo']) 
       && isset($_POST['submit']) && $_GET['']) { //Verifica se a nova senha e o código foram enviados.
        $codigo = $_GET['codigo'];
        $email = $_GET['email'];
        $senha = $_POST['novaSenha'];
        $paramCodigo = $_POST['paramCodigo'];

        if($codigo != $paramCodigo) { //Verifica se o código enviado é igual ao código gerado.
            header("Location:  Muda_senha.php");
            exit();
        }

        //Atualiza a senha do usuário no banco de dados.
        $update = $conn->prepare("UPDATE tbl_usuario(senha) SET senha = :novaSenha WHERE email = :email");
        $update->bindParam(':novaSenha', $senha, PDO::PARAM_STR);
        $update->bindParam(':email', $email, PDO::PARAM_STR);
        $update->execute();

        unset($update);
        unset($conn);

        //Aviso de mudança de senha.
        $html = "<h1>Olá, !</h1><br><h3>Sua senha foi modificada, caso não reconheça essa mudança, 
        por favor entre em contato</h3><br>";
        enviaEmail($email, "Usuário", "Mudança de senha", $html);

        header("Location: Login.php");
        exit();

    }else {
        header("Location:  Muda_senha.php");
        exit();
    }
?>

<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <h2>Esqueci minha senha</h2>
        <form action="Muda_senha.php" method="POST">
            <input type="password" name="novaSenha" placeholder="Nova senha">
            <input type="text" name="paramCodigo" placeholder="Código enviado por email">
            <input type="submit" name="submit" value="Enviar">
        </form>
    </body>
</html>