<?php
    display_errors ( 'display_errors' , 1);
    error_reporting (E_ALL);

    include ("Functions.php");

    session_start();

    $conn = conecta();

    // $email = $_POST['email'];
    // $senha = $_POST['senha'];
    echo "abnabac";

    $select = $conn->query("SELECT email, senha FROM tbl_cliente");
    if ($email<>'') {
        header("../../HTML_CSS/HTML/Home.html");
        setcookie('loginCookie', $email, time() + 172800);
    }
    // while ($row = $select -> fetch()){
    //     $varEmail = $row['email'];
    //     $varSenha = $row['senha'];
    //     if($email == $varEmail && $senha == $varSenha){
            
    //     }else{
    //         header(/*ERRO*/);
    //     }
    // }
?>