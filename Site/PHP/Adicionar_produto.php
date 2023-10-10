<?php
include "Funcoes.php";

$conn = conecta();


        $params = [
            ':nome_produto' => $_POST['nome_produto'],
            ':descricao' => $_POST['descricao'],
            ':vlr' => $_POST['vlr'],
            ':codigovisual' => $_POST['id_visual'],
            ':custo' => $_POST['custo'],
            ':margem_lucro' => $_POST['margem_lucro'],
            ':icms' => $_POST['icms'],
            ':qntd' => $_POST['qntd'],
            ':categoria' => $_POST['categoria']
        ];
        $sql = "INSERT INTO tbl_produto(
                nome_produto, descricao, vlr, codigovisual, custo, margem_lucro, icms, imagem, qntd)
                VALUES (
                :nome_produto, :descricao, :vlr, :codigovisual, :custo, :margem_lucro, :icms, :imagem, :qntd
                )";

        $stmt = $conn->prepare($sql);
        if ($stmt->execute($params)) {
            header("Location: /crud.php");
            exit();
        } else {
            echo "Erro ao inserir o produto no banco de dados.";
        }
?>
