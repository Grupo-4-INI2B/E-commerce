<?php

    display_errors ('display_errors' , 1);
    error_reporting (E_ALL);

    include ("Functions.php");

    $conn = conecta();
    session_start();

    //Parámetros vindos do formulário da Home, onde vai enviar o cookie salvo.
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $select = $conn->query("SELECT id_usuario FROM tbl_cliente WHERE email = $email AND senha = $senha");

    while ($row = $select -> fetch()) {
        $varEmail = $row['email'];
        $varSenha = $row['senha'];
        $id_usuario = $row['id_usuario'];

        if($email == $varEmail && $senha == $varSenha) {
            $delete = $conn->query("DELETE FROM tbl_cliente WHERE id_usuario = $id_usuario");
            session_destroy();
            unset($_COOKIE['Cookie_email']);
            header("Location: ../../HTML_CSS/HTML/Home.html");
        }
    }
?>