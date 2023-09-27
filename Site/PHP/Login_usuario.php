<?php
    display_errors ('display_errors' , 1);
    error_reporting (E_ALL);
    session_start();

    include ("Funcoes.php");
    $conn = conecta();

    $email = '', $senha = '';

    if(isset($_COOKIE['cookie_email'])) {
        //Parámetros vindos do formulário da cadastro.
        $email = $_COOKIE['cookie_email'];
    }else {
        //Parámetros vindos do formulário de Login
        $email = $_POST['email'];
    }

    $select = $conn->query("SELECT (email, senha) FROM tbl_usuario");
    while($row = $select -> fetch()) {
        $varEmail = $row['email'];
        $varSenha = $row['senha'];

        if($email == $varEmail && $senha == $varSenha) {
            if(isset($_COOKIE['cookie_email']) && isset($_SESSION['sessaoUsuario'])) { //Verifica se o usuário está com o cookie e a sessão ativos
                header("Location: ../../HTML_CSS/HTML/Home.php");
                break;
            }else { 
                defineCookie('cookie_email', $email, 1440);
                defineSessao($email);
                header("Location: ../../HTML_CSS/HTML/Home.php");
            }
        }else { //email ou senha errados
            header("Location: ../../HTML_CSS/HTML/Login_usuario.php");
        }
    }

?>