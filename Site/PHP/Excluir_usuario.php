<?php

    display_errors ('display_errors' , 1);
    error_reporting (E_ALL);
    session_start();

    include ("Funcoes.php");
    $conn = conecta();
    
    $email =  $_COOKIE['cookie_email'];
    $senha = $_POST['senha'];

    //Seleciona o id do usuario
    $select = $conn->query("SELECT id_usuario FROM tbl_usuario WHERE email = $email AND senha = $senha");
    $id_usuario = $select->fetch();

    //Deleta o usuário(lógico) e deativa o cookie e a sessão
    $delete = $conn->query("UPDATE tbl_usuario SET excluido = true WHERE id_usuario = $id_usuario");
    unset($_COOKIE['Cookie_email']);
    unset($_SESSION['sessaoUsuario']);
    header("Location: ../../HTML_CSS/HTML/Home.php");
?>