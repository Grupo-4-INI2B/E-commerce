<?php

    ini_set ('display_errors', 1);    
    error_reporting (E_ALL);
    include ("Funcoes.php");
    $conn = conecta();

    //Parámetros vindos do formulário de cadastro(Cadastro.html)
    $id_usuario = rand(1000, 2000); //Cria um número aleatório entre 1000 e 2000 para servir como id do usuário 
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $tlfn = $_POST['tlfn']; 
    $senha = $_POST['senha'];
    $adm  = FALSE;
    $excluido = FALSE;

    if($email = 'bbytecraft@gmail.com'){ //Verifica se o usuário é administrador
        $adm = TRUE; 
    }

    /*Verifica se algum campo está vazio(só por garantia, visto que 
    no HTML já está definido que todos os campos são obrigatórios)*/
    if($usuario == '' || $email == '' || $tlfn == '' || $senha == '') {
        header("Location: ../../HTML_CSS/HTML/Cadastro.html");
    }

    //Verifica se o email já existe no banco de dados
    if(verificaEmail($email)){
        header("Location: ../../HTML_CSS/HTML/Cadastro.html");
    }
    

    //Verifica se o id gerado já existe no banco de dados
    $select = $conn->query("SELECT id_usuario FROM tbl_usuario");
    while ($row = $select -> fetch()) {
        $varIdUsuario = $row['id_usuario'];
        if($id_usuario == $varIdUsuario) {
            $id_usuario = rand(1000, 2000);
        }
    }
   
    //Insere os dados do usuário no banco de dados
    $insert = $conn->query("INSERT INTO tbl_usuarios(id_usuario, nome_usuario, email, telefone, senha, adm, excluido) 
        VALUES($id_usuario, $usuario, $email, $tlfn, $senha , $adm, $excluido)");
    //Criando um cookie para email e sessao
    defineCookie('cookie_email', $email, 1440);
    if($adm){ //Verifica se o usuário é administrador
        defineSessao('sessaoAdm', $email);
    }else{
        defineSessao('sessaoUsuario', $email);
    }
    header("Login_usuario.php");
?>