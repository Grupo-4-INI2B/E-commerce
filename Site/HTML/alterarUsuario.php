<?php
   ini_set ('display_errors', 1);
   error_reporting (E_ALL);
   session_start();
   include ("../PHP/funcoes.php");
   $conn = conecta();

    if(!isset($_SESSION['sessaoUsuario']) || $_SESSION['adm'] == false) { // Se não está logado ou não é administrador 
        header("Location: ../HTML/login.php");
        exit();
    }

    $id_usuario = $_GET['id_usuario'];

    $select = $conn->query("SELECT * FROM tbl_usuario WHERE id_usuario = $id_usuario")->fetch();

    if($select['excluido'] == true) {
        header("Location: usuarios.php");
        exit();
    }
    if(isset($select['nome_usuario']) && isset($select['email']) 
    && isset($select['telefone']) && isset($select['senha']) && isset($select['adm'])) {
        $varNome   = $select['nome_usuario'];
        $varEmail  = $select['email'];
        $varTlfn   = $select['telefone'];
        $varSenha  = $select['senha'];
        $varAdm    = $select['adm'];
    } 

    if(isset($_POST['submit'])){
        $usuario      = $_POST['usuario'];
        $email        = $_POST['email'];
        $telefone     = $_POST['tlfn'];
        $senha        = $_POST['senha'];
        $adm          = $_POST['adm'];

        $update = $conn->prepare("UPDATE tbl_usuario SET nome_usuario = :nome_usuario, email = :email, 
        telefone = :telefone, senha = :senha, adm = :adm WHERE id_usuario = :id_usuario");
        $update->bindParam(':nome_usuario', $usuario, PDO::PARAM_STR);
        $update->bindParam(':email', $email, PDO::PARAM_STR);
        $update->bindParam(':telefone', $telefone, PDO::PARAM_STR);
        $update->bindParam(':senha', $senha, PDO::PARAM_STR);
        $update->bindParam(':adm', $adm, PDO::PARAM_BOOL);
        $update->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $update->execute();
        
        unset($select);
        unset($update);
        unset($conn);

        header("Location: usuarios.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <title>Usuarios</title>
    </head>
    <body>
        <a href="usuarios.php">Voltar</a>
        <form action="alterarUsuario.php" method="post" name="frmAlterar">
            <fieldset style="width: 100px;">
                Nome: <input type="text" id="usuario" name="usuario" placeholder="Nome de usuário" value="<?php echo $varNome; ?>" required><br><br>
                Email: <input type="email" id="email" name="email" placeholder="E-Mail" value="<?php echo $varEmail; ?>" required><br><br>
                Telefone: <input type="tel" id="tlfn" name="tlfn" placeholder="(xx) xxxx-xxxx"
                pattern="\([0-9]{2}\) [0-9]{4,6}-[0-9]{3,4}$" value="<?php echo $varTlfn; ?>" required><br><br>
                Senha: <input type="password" id="senha" name="senha" placeholder="Senha" value="<?php echo $varSenha; ?>" required><br><br>
                Administrador: <input type="text" placeholder="ADM" name="adm" value="<?php echo $varAdm; ?>" required><br><br>
                <input type="submit" value="Salvar" name="submit"><br><br>
            </fieldset>
        </form>    
    </body>
</html>