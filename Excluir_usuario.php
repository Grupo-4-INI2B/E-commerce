<?php
    display_errors ( 'display_errors' , 1);
    error_reporting (E_ALL);

    include ("Functions.php");

    $conn = conecta();

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $select = $conn->query("SELECT id_usuario, email, senha FROM tbl_cliente");

    while ($row = $select -> fetch()){
        $varEmail = $row['email'];
        $varSenha = $row['senha'];
        $id_usuario = $row['id_usuario'];

        if($email == $varEmail && $senha == $varSenha){
            $sql = "DELETE FROM tbl_cliente WHERE id_usuario = $id_usuario";
            $delete = $conn->query($sql);
            header(/*PÁGINA PRINCIPAL*/);
        }else{
            header(/*PÁGINA DE LOGIN COM A MENSAGEM DE EMAIL OU SENHA INCORRETOS*/);
        }
    }
?>