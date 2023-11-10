<?php
   ini_set ('display_errors', 1);
   error_reporting (E_ALL);
   session_start();
   include ("../PHP/funcoes.php");

   if(!$_SESSION['adm']){ // Se não está logado ou não é administrador 
       header("Location: ../HTML/login.php");
       exit();
}
    
    if (isset($_GET['id'])) {
        $id_produto = $_GET['id'];

        // Conecte-se ao banco de dados e recupere os dados do produto com base no ID
        $conn = conecta();
        $query = "SELECT * FROM tbl_produto WHERE id_produto = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id_produto, PDO::PARAM_INT);
        $stmt->execute();

        // Verifique se o produto existe
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $nome = $row['nome_produto'];
            $descricao = $row['descricao'];
            $excluido = $row['excluido'];
            $preco = $row['vlr'];
            $data_exclusao = $row['dta_exclusao'];
            $codigovisual = $row['id_visual'];
            $custo = $row['custo'];
            $margem_lucro = $row['margem_lucro'];
            $icms = $row['icms'];
            $imagem = $row['imagem'];
            $quantidade = $row['qntd'];
            $categoria = $row['categoria'];
    ?>
            <!DOCTYPE html>
            <html>

            <head>
                <title>Editar Produto</title>
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta charset="utf-8">
                <link rel="stylesheet" href="../CSS/crud.css">
            </head>

            <body>
                <h1>Editar Produto</h1>
                <form action="alterarProduto.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_produto" value="<?php echo $id_produto; ?>">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" value="<?php echo $nome; ?>"><br>
                    <label for="descricao">Descrição:</label>
                    <textarea name="descricao"><?php echo $descricao; ?></textarea><br>
                    <label for="excluido">Excluído:</label>
                    <input type="checkbox" name="excluido" value="1" <?php if ($excluido == 1) echo 'checked'; ?>><br>
                    <label for="preco">Preço:</label>
                    <input type="text" name="preco" value="<?php echo $preco; ?>"><br>
                    <label for="data_exclusao">Data de Exclusão:</label>
                    <input type="datetime-local" name="data_exclusao" value="<?php echo $data_exclusao; ?>"><br>
                    <label for="codigovisual">Código Visual:</label>
                    <input type="text" name="codigovisual" value="<?php echo $codigovisual; ?>"><br>
                    <label for="custo">Custo:</label>
                    <input type="text" name="custo" value="<?php echo $custo; ?>"><br>
                    <label for="margem_lucro">Margem de Lucro:</label>
                    <input type="text" name="margem_lucro" value="<?php echo $margem_lucro; ?>"><br>
                    <label for="icms">ICMS:</label>
                    <input type="text" name="icms" value="<?php echo $icms; ?>"><br>
                    <label for="imagem">Imagem:</label>
                    <input type="file" name="imagem" value="<?php echo "<img src='$imagem' alt='Imagem do Produto'>"?>" ><br>
                    <label for="quantidade">Quantidade:</label>
                    <input type="text" name="quantidade" value="<?php echo $quantidade; ?>"><br>
                    <label for="categoria">Categoria:</label>
                    <input type="text" name="categoria" value="<?php echo $categoria; ?>"><br>
                    <input type="hidden" name="imagem_existente" value="<?php echo $imagem; ?>">
                    <input type="submit" value="Salvar Alterações">
                </form>
            </body>

            </html>
    <?php
        } else {
            echo "Produto não encontrado.";
        }
    } else {
        echo "ID do produto não fornecido.";
    }
    ?>