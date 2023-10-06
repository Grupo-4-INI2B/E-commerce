<?php
    ini_set ('display_errors', 1);
    error_reporting (E_ALL);
    include("Funcoes.php");
    $conn = conecta();

    $email = ""; $senha = "";
    //Parâmetros vindos do formulário de cadastro e login e verificação se estão vazios.
    if(isset($_POST['email']) && isset($_POST['senha'])) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];
    }else {
        echo "Erro ao receber os dados do formulário";
    }

    //Verifica se o email e senha existem no banco de dados.
    if(verificaEmail($email)) {
        $sql = "SELECT senha FROM tbl_usuario WHERE email = $email";
        if(ExecutaSQL($conn , $sql)) {
            //Define o cookie e a sessão do usuário
            defineCookie("cookie_email", $email, 420);
            if($email == 'bbytecraft@gmail.com'){
                defineSessao("sessaoAdm", $email);
            }else {
                defineSessao("sessaoUsuario", $email);
            }  
        }else {
            echo "Senha incorreta";
        }
    }else {
        echo "Email não cadastrado";
    }
    
    unset($conn);
?>