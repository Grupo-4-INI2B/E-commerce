<?php
    display_errors ('display_errors' , 1);
    error_reporting (E_ALL);

    include ("Functions.php");

    $conn = conecta();
    session_start();

    //Parámetros vindos do formulário de Login(Login.html)
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $select = $conn->query("SELECT (email, senha) FROM tbl_cliente");
    while($row = $select -> fetch()) {
        $varEmail = $row['email'];
        $varSenha = $row['senha'];

        if($email == $varEmail && $senha == $varSenha) {
            DefineCookie('Cookie_email', $email, 1440);
            $usuario = array('email' => $email, 'senha' => $senha);
            $_SESSION['sessaoUsuario'] = $usuario;
            header("Location: ../../HTML_CSS/HTML/Home.html");
        }
    }

?>