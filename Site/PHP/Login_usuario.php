<?php
    display_errors ('display_errors' , 1);
    error_reporting (E_ALL);

    include ("Funcoes.php");

    $conn = conecta();

    $email = '', $senha = '';

    if(isset($_COOKIE['Cookie_email']) && isset($_COOKIE['Cookie_senha'])) {
        //Parámetros vindos do formulário da cadastro.
        $email = $_COOKIE['Cookie_email'];
        $senha = $_COOKIE['Cookie_senha'];
    }else {
        //Parámetros vindos do formulário de Login
        $email = $_POST['email'];
        $senha = $_POST['senha'];
    }

    $select = $conn->query("SELECT (email, senha) FROM tbl_usuario");
    while($row = $select -> fetch()) {
        $varEmail = $row['email'];
        $varSenha = $row['senha'];

        if($email == $varEmail && $senha == $varSenha) {
            if(isset($_COOKIE['Cookie_email']) && isset($_COOKIE['Cookie_senha'])) {
                header("Location: ../../HTML_CSS/HTML/Home.php");
                break;
            }else {
                DefineCookie('Cookie_email', $email, 1440);
                DefineCookie('Cookie_senha', $senha, 1440);
                header("Location: ../../HTML_CSS/HTML/Home.php");
            }
        }
    }

?>