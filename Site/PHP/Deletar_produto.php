<?php
include "Funcoes.php";

$conn = conecta();

     if(!isset($_SESSION['sessaoUsuario']) || $_SESSION['adm'] == false) { // Se não está logado ou não é administrador 
          header("Location: ../HTML/Login.php");
          exit();
     }
        
     $id_produto = $_GET['id']; 
     $excluido = true;
     $deleta = ['id' => $id_produto];
     $delete = $conn->prepare('UPDATE tbl_produto SET excluido = :excluido WHERE id_produto = :id_produto');
     $delete->bindParam(':excluido', $excluido, PDO::PARAM_BOOL);
     $delete->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
     $delete->execute($deleta);
     header("Location: ../HTML/Crud.php");
           
?>
