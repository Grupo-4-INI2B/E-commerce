<?php
   ini_set ('display_errors', 1);
   error_reporting (E_ALL);
   session_start();
   include ("../../PHP/Funcoes.php");
   $conn = conecta();
  
   $insert = $conn->prepare("INSERT INTO tbl_carrinho  
   VALUES(:qntd, :produto, :usuario)");
   $insert->bindParam(':qntd', $_SESSION['carrinho']['qntd'], PDO::PARAM_INT);
   $insert->bindParam(':produto', $_SESSION['carrinho']['id_produto'], PDO::PARAM_INT);
   $insert->bindParam(':email', $_SESSION['id_usuario'], PDO::PARAM_INT);
   $insert->execute();

   session_unset();
   
   header('Location: ../HTML_CSS/HTML/index.php');
?>