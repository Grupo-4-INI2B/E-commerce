<?php
include "Funcoes.php";

$conn = conecta();

        
           {
                $id_produto = $_GET['id']; 
                $deleta = ['id' => $id_produto];
                $delete = $conn->prepare('delete from tbl_produto where id_produto = :id');
                $delete->execute($deleta);
                header("Location: ../HTML/Crud.php");
           }
?>
