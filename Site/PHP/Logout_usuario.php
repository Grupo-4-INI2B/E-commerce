<?php
   ini_set ('display_errors', 1);
   error_reporting (E_ALL);
   session_start();
   include ("Funcoes.php");
   $conn = conecta();
  
   if(!isset($_SESSION['sessaoUsuario'])) { // Se não está logado
      header("Location: Login.php");
      exit();
   }

   if(isset($_SESSION['carrinho']['id_produto']) && isset($_SESSION['carrinho']['qntd'])) {
      $insert = $conn->prepare("INSERT INTO tbl_carrinho  
      VALUES(:qntd, :produto, :usuario)");
      $insert->bindParam(':qntd', $_SESSION['carrinho']['qntd'], PDO::PARAM_INT);
      $insert->bindParam(':produto', $_SESSION['carrinho']['id_produto'], PDO::PARAM_INT);
      $insert->bindParam(':email', $_SESSION['id_usuario'], PDO::PARAM_INT);
      $insert->execute();
   }
  
   unset($insert);
   unset($conn);
   session_unset();
   
   header('Location: ../HTML/index.php');
   exit();
?>