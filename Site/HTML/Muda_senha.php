<?php
    
    ini_set ('display_errors', 1);    
    error_reporting (E_ALL);
    include ("../PHP/Funcoes.php");
    $conn = conecta();
    
    if(!isset($_SESSION['sessaoUsuario'])) { //Verifica se há sessão iniciada.
        header("Location: Login.php");
        exit();
    }

    //Verifica se email e código foram enviados.
    if (isset($_POST['codigo']) && isset($_POST['email'])) {
        $email = $_POST['email'];
        $codigo = $_POST['codigo'];
    }else {
        header("Location: Esqueci.php");
        exit();
    }

    //Verifica se o código e a nova senha foram enviados.
    if(isset($_POST['novaSenha']) && isset($_POST['paramCodigo'])) {
        $senha = $_POST['novaSenha'];
        $paramCodigo = $_POST['paramCodigo'];
    }else {
        header("Location: Muda_senha.php");
        exit();
    }

    if($codigo != $paramCodigo) { //Verifica se o código enviado é igual ao código gerado.
        header("Location: Muda_senha.php");
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
    enviaEmail($email, $_SESSION['nome'], "Mudança de senha", $html);

    header("Location: Login.php");
    exit();

?>

<!DOCTYPE html>
<html>
    
</html>