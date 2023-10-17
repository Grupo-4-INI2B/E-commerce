<?php

    ini_set ('display_errors', 1);    
    error_reporting (E_ALL);
    include ("../../PHP/Funcoes.php");
    $conn = conecta();

    if(!isset($_SESSION['sessaoUsuario'])) { //Verifica se há sessão iniciada.
        header("Location: Login.php");
    }

    include ("Funcoes.php");
    $conn = conecta();
    
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    //Seleciona o id do usuario
    $select = $conn->prepare("SELECT id_usuario FROM tbl_usuario WHERE email = :email AND senha = :senha");
    $select->bindParam(':senha', $senha, PDO::PARAM_STR);
    $select->bindParam(':email', $email, PDO::PARAM_STR);
    $select->execute();
    $id_usuario = $select->fetch();

    if(isset($id_usuario)) {
        $excluido = false;
        //Deleta o usuário(lógico) e desativa o cookie e a sessão
        $update = $conn->prepare("UPDATE tbl_usuario SET excluido = :excluido WHERE id_usuario = :id_usuario");
        $update->bindParam(':excluido', $excluido, PDO::PARAM_BOOL);
        $update->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $update->execute();

        unset($_COOKIE['Cookie_email']);
        unset($_SESSION['sessaoUsuario']);

        unset($update);
    }else {
        header("Location: Excluir_usuario.php");
        exit();
    }
    //Aviso de exclusão de conta.
    $html = "<h1>Olá, !</h1><br><h3>Sua conta foi excluída, caso não reconheça essa mudança entre em contato</h3><br>";
    enviaEmail($email, $_SESSION['nome'], "Exclusão de conta", $html);

    unset($select);
    unset($conn);

    //Redireciona para a página inicial
    header("Location: ../HTML_CSS/HTML/index.php");
    exit();
?>

<!DOCTYPE html>
<html>
    
</html>