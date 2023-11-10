<?php

    ini_set ('display_errors', 1);    
    error_reporting (E_ALL);
    session_start();
    include ("../PHP/funcoes.php");
    $conn = conecta();

    if(!isset($_SESSION['sessaoUsuario'])) { //Verifica se há sessão iniciada.
        header("Location: login.php");
        exit();
    } 

    if(isset($_GET['id_usuario'])) {
        $pId_usuario = $_GET['id_usuario'];
    } 
  
    if($_SESSION['adm'] == false) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        //Seleciona o id do usuario
        $select = $conn->prepare("SELECT id_usuario FROM tbl_usuario WHERE email = :email AND senha = :senha");
        $select->bindParam(':senha', $senha, PDO::PARAM_STR);
        $select->bindParam(':email', $email, PDO::PARAM_STR);
        $select->execute();
        $id_usuario = $select->fetch();
    }
   
    if(isset($id_usuario) || isset($pId_usuario)) {
        //Aviso de exclusão de conta.
        $html = "<h1>Olá, !</h1><br><h3>Sua conta foi excluída, caso não reconheça essa mudança entre em contato</h3><br>";
        enviaEmail($email, $_SESSION['nome'], "Exclusão de conta", $html);

        $excluido = true;
        //Deleta o usuário(lógico) e desativa o cookie e a sessão
        $update = $conn->prepare("DELETE FROM tbl_usuario WHERE id_usuario = :id_usuario");
     
        $update->bindParam(':dta_exclusao', date("Y-m-d H:i:s"), PDO::PARAM_STR);
        $update->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        if($_SESSION['adm'] == true) {
            $update->bindParam(':id_usuario', $pId_usuario, PDO::PARAM_INT);

            $update->execute();

            unset($update);
            unset($select);
            unset($conn);
            
            header("Location: usuarios.php");
            exit();
        }
        
        $update->bindParam(':excluido', $excluido, PDO::PARAM_BOOL);
        $update->execute();

        destroiCookieSessao();

        unset($update);
    }else {
        header("Location: excluirUsuario.php");
        exit();
    }
    
    unset($select);
    unset($conn);

    //Redireciona para a página inicial
    header("Location: index.php");
    exit();
?>
