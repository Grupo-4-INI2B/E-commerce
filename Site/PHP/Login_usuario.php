<?php

    ini_set ('display_errors', 1);
    error_reporting (E_ALL);
    session_start();

    include ("Funcoes.php");
    $conn = conecta();

    $email = '', $senha = '';
    $_SESSION['sessaoAdm'] = false;

    if(isset($_COOKIE['cookie_email'])) {
        //Parâmetros vindos do formulário da cadastro.
        $email = $_COOKIE['cookie_email'];
    }else {
        //Parâmetros vindos do formulário de Login
        $email = $_POST['email'];
    }
    $senha = $_POST['senha'];

    /*Verifica se algum campo está vazio(só por garantia, visto que 
    no HTML já está definido que todos os campos são obrigatórios)*/
    if($email == '' || $senha == '') {
        header("Location: ../../HTML_CSS/HTML/Login.php");
    }

    //Seleciona email e senha dos usuários
    $select = $conn->query("SELECT (email, senha) FROM tbl_usuario");
    while($row = $select -> fetch()) {
        $varEmail = $row['email'];
        $varSenha = $row['senha'];

        //Deve existir um email e senha iguais aos do banco de dados
        if($email == $varEmail && $senha == $varSenha) {
            /*Se o cookie e a sessão já existirem, redireciona para a Home
            caso contrário, cria um cookie e uma sessão*/ 
            if(isset($_COOKIE['cookie_email']) && isset($_SESSION['sessaoUsuario'])) { 
                header("Location: ../../HTML_CSS/HTML/Home.php");
                break;
            }else {
                defineCookie('cookie_email', $email, 1440);
                if($email = "bbytecraft@gmail.com"){ //Verifica se o usuário é administrador
                    defineSessao('sessaoAdm', $email);
                    header("Location: ../../HTML_CSS/HTML/Home.php");
                }else{
                    defineSessao('sessaoUsuario', $email);
                    header("Location: ../../HTML_CSS/HTML/Home.php");
                }
            }
        }else { //email ou senha errados
            header("Location: ../../HTML_CSS/HTML/Login_usuario.php");
        }
    }

?>