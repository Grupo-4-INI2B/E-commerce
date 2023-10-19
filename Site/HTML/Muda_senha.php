<?php
    
    ini_set ('display_errors', 1);    
    error_reporting (E_ALL);
    include ("../PHP/Funcoes.php");
    $conn = conecta();
    
    //Verifica se email e código foram enviados.
    if (isset($_GET['codigo']) && isset($_GET['email'])) {
        $email = $_GET['email'];
        $codigo = $_GET['codigo'];
    }else {
        header("Location: Esqueci.php");
        exit();
    }

    //Verifica se o código e a nova senha foram enviados.
    if(isset($_POST['novaSenha']) && isset($_POST['paramCodigo']) && $_POST['submit']) {
        $senha = $_POST['novaSenha'];
        $paramCodigo = $_POST['paramCodigo'];

        if($codigo != $paramCodigo) { //Verifica se o código enviado é igual ao código gerado.
            header("Location:  Muda_senha.php?codigo=$codigo&email=$email");
            exit();
        }

        //Atualiza a senha do usuário no banco de dados.
        $update = $conn->prepare("UPDATE tbl_usuario(senha) SET senha = :novaSenha WHERE email = :email");
        $update->bindParam(':novaSenha', $senha, PDO::PARAM_STR);
        $update->bindParam(':email', $email, PDO::PARAM_STR);
        $update->execute();

        unset($update);
        unset($conn);
    }else {
        header("Location:  Muda_senha.php?codigo=$codigo&email=$email");
        exit();
    }

    //Aviso de mudança de senha.
    $html = "<h1>Olá, !</h1><br><h3>Sua senha foi modificada, caso não reconheça essa mudança, 
    por favor entre em contato</h3><br>";
    enviaEmail($email, "Usuário", "Mudança de senha", $html);

    header("Location: Login.php");
    exit();

?>

<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <h2>Esqueci minha senha</h2>
        <form action="Muda_senha.php" method="POST">
            <input type="text" name="novaSenha" placeholder="Nova senha">
            <input type="hidden" name="paramCodigo" placeholder="Código enviado por email">
            <input type="submit" name="submit" value="Enviar">
        </form>
    </body>
</html>