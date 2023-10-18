<?php
include "Funcoes.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Conecte-se ao banco de dados
    $conn = conecta();
    
    // Obtenha os dados do formulário
    $id_produto = $_POST['id_produto'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $excluido = isset($_POST['excluido']) ? 1 : 0;
    $preco = $_POST['preco'];
    $codigovisual = $_POST['codigovisual'];
    $custo = $_POST['custo'];
    $margem_lucro = $_POST['margem_lucro'];
    $icms = $_POST['icms'];
    $quantidade = $_POST['quantidade'];
    $imagem = $_POST['imagem'];
    $categoria = $_POST['categoria'];
    
    // Verifique se o formulário enviou uma imagem
    if (isset($_FILES["imagem"]) && $_FILES["imagem"]["size"] > 0) {
        $nomeImagem = $_FILES["imagem"]["name"];
        $tipoImagem = $_FILES["imagem"]["type"];
        $tamanhoImagem = $_FILES["imagem"]["size"];
        $caminhoDiretorio = "../HTML_CSS/Produtos_E-commerce";
        $caminhoImagem = $caminhoDiretorio . $nomeImagem;
    
        // Verifique se o arquivo é uma imagem válida
        $permitirTipos = array("image/jpeg", "image/png", "image/gif");
        if (!in_array($tipoImagem, $permitirTipos)) {
            echo "Somente imagens JPEG, PNG e GIF são permitidas.";
            exit();
        }
    
        // Verifique se o tamanho do arquivo é aceitável
        if ($tamanhoImagem > 3000000) { // 3 MB
            echo "A imagem é muito grande. O tamanho máximo permitido é 3 MB.";
            exit();
        }
    
        // Mova a imagem para o diretório desejado no servidor
        if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminhoImagem)) {
            // A imagem foi carregada com sucesso
            $imagem = $caminhoImagem;
        } else {
            echo "Erro ao fazer o upload da imagem.";
            exit();
        }
    }
    
    // Se o formulário não enviou uma nova imagem, mantenha a imagem existente
    if (empty($imagem)) {
        $imagem = $_POST['imagem_existente'];
    }
    
    // Prepare e execute a consulta SQL
    $query = "UPDATE tbl_produto SET nome_produto = :nome, descricao = :descricao, excluido = :excluido, vlr = :preco, dta_exclusao = :data_exclusao, id_visual = :codigovisual, custo = :custo, margem_lucro = :margem_lucro, icms = :icms, imagem = :imagem, qntd = :quantidade, categoria=:categoria WHERE id_produto = :id_produto";
    
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id_produto', $id_produto, PDO::PARAM_INT); // Assumindo que id_produto é um número (inteiro)
    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
    $stmt->bindParam(':excluido', $excluido, PDO::PARAM_BOOL);
    $stmt->bindParam(':preco', $preco, PDO::PARAM_INT);
    $stmt->bindParam(':data_exclusao', $data_exclusao, PDO::PARAM_STR);
    $stmt->bindParam(':codigovisual', $codigovisual, PDO::PARAM_STR);
    $stmt->bindParam(':custo', $custo, PDO::PARAM_INT);
    $stmt->bindParam(':margem_lucro', $margem_lucro, PDO::PARAM_INT);
    $stmt->bindParam(':icms', $icms, PDO::PARAM_INT);
    $stmt->bindParam(':imagem', $imagem, PDO::PARAM_STR);
    $stmt->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);
    $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);
    
    if ($stmt->execute()) {
        echo "Produto atualizado com sucesso.";
        header("Location: ../HTML/Crud.php");
    } else {
        echo "Erro ao atualizar o produto.";
    }
}
?>
