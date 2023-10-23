<?php
     ini_set ('display_errors', 1);
     error_reporting (E_ALL);
     session_start();
     include ("../PHP/Funcoes.php");
     $conn=conecta();
     if(!$_SESSION['adm']){ // Se não está logado ou não é administrador 
     header("Location: ../HTML/Login.php");
     exit();
     }
        
     $id_produto = $_GET['id']; 
     $excluido = true;

     $delete = $conn->prepare('UPDATE tbl_produto SET excluido = :excluido, dta_exclusao=:data_exclusao WHERE id_produto = :id_produto');
     $delete->bindParam(':excluido', $excluido, PDO::PARAM_BOOL);
     $delete->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
     $delete->bindParam(':data_exclusao', date("Y-m-d H:i:s"), PDO::PARAM_STR);
     $delete->execute($deleta);
     header("Location: ../HTML/Crud.php");
           
?>
