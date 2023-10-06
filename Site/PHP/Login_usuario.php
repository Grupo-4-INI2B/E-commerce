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
    $resultado = verificaUser($senha, $email);
    if(!$resultado) {
        echo "Email ou senha incorretos";
    } else {
        echo "Login realizado com sucesso";
        echo $_SESSION['adm'];
    }
    
    unset($conn);
?>