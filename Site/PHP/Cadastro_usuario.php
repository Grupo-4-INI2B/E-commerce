<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    include("Funcoes.php");
    $conn = conecta();

    $usuario = ""; $email = ""; $tlfn = ""; $senha = ""; $id_usuario = 0;
    /*Parámetros vindos do formulário de cadastro e verificação se não estão vazios*/
    $id_usuario = rand(1000, 2000); /*Cria um número aleatório entre 1000 e 2000 para servir como id do usuário*/
    if (isset($_POST['usuario']) && isset($_POST['email']) && isset($_POST['tlfn']) && isset($_POST['senha'])) {
        $usuario = $_POST['usuario'];
        $email = $_POST['email'];
        $tlfn = $_POST['tlfn'];
        $senha = $_POST['senha'];
    } else {
        echo "Erro ao receber os dados do formulário";
    }
    $adm  = false;
    $excluido = false;

    //Verifica se o usuário é administrador
    if ($email == 'bbytecraft@gmail.com') { 
        $adm = true;
    }

    //Verifica se o email já existe no banco de dados.
    if(verificaEmail($email)) {
        echo "Email já cadastrado";
        header("Location: ../HTML_CSS/HTML/Cadastro.html");
        exit();
    }
    else{
    
    //Verifica se o id gerado já existe no banco de dados
    $select = $conn->query("SELECT id_usuario FROM tbl_usuario");
    while ($row = $select->fetch()) {
        $varIdUsuario = $row['id_usuario'];
        if ($id_usuario == $varIdUsuario) {
            $id_usuario = rand(1000, 2000);
        }
    }

    //Insere os dados do usuário no banco de dados
    $insert = $conn->prepare("INSERT INTO tbl_usuario(id_usuario, nome_usuario, email, telefone, senha, adm, excluido) 
    VALUES(:id_usuario, :nome_usuario, :email, :telefone, :senha, :adm, :excluido)");
    $insert->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $insert->bindParam(':nome_usuario', $usuario, PDO::PARAM_STR);
    $insert->bindParam(':email', $email, PDO::PARAM_STR);
    $insert->bindParam(':telefone', $tlfn, PDO::PARAM_STR);
    $insert->bindParam(':senha', $senha, PDO::PARAM_STR);
    $insert->bindParam(':adm', $adm, PDO::PARAM_BOOL);
    $insert->bindParam(':excluido', $excluido, PDO::PARAM_BOOL);
    $insert->execute();
        
    unset($select);
    unset($insert);
    unset($conn);
    
    //Envia um email para o usuário cadastrado
    $html = "<h1>Olá, $usuario!</h1><br><h3>Seu cadastro foi realizado com sucesso!</h3><br>";
    enviaEmail($email, "Cadastro realizado com sucesso", $html, "bbytecraft@gmail.com");

    //Redireciona o usuário para a página de login
    header("Location: ../HTML_CSS/HTML/Login.php");
    }
    exit();
?>