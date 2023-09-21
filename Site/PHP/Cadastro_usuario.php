<?php
    display_errors ('display_errors' , 1);
    error_reporting (E_ALL);

    include ("Functions.php");

    $conn = conecta();

    //Parámetros vindos do formulário de cadastro(Cadastro.html)
    $id_usuario = rand(1000, 2000); //Cria um número aleatório entre 1000 e 2000 para servir como id do usuário 
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $tlfn = $_POST['tlfn']; 
    $senha = $_POST['senha'];
    
    /*Verifica se algum campo está vazio(só por garantia, visto que 
    no HTML já está definido que todos os campos são obrigatórios)*/
    if($usuario == '' || $email == '' || $tlfn == '' || $senha == '') {
        header("Location: ../../HTML_CSS/HTML/Cadastro.html");
    }

    //Verifica se o email já existe no banco de dados
    $select = $conn->query("SELECT email FROM tbl_cliente");
    while ($row = $select -> fetch()) {
        $varEmail = $row['email'];
        if($email == $varEmail){
            header("Location: ../../HTML_CSS/HTML/Cadastro.html");
            break;
        }
    }

    //Verifica se o id gerado já existe no banco de dados
    $select = $conn->query("SELECT id_usuario FROM tbl_cliente");
    while ($row = $select -> fetch()) {
        $varIdUsuario = $row['id_usuario'];
        if($id_usuario == $varIdUsuario)
            $id_usuario = rand(1000, 2000);
        else
            break;
    }
   
    //Insere os dados do usuário no banco de dados
    $insert = $conn->query("INSERT INTO tbl_cliente VALUES ($id_usuario, $usuario, $email, $senha, $tlfn)");

    //Criando um cookie para email e senha
    DefineCookie('Cookie_email', $email, 1440);
    header("Location: ../../HTML_CSS/HTML/Home.html");
?>