<?php
include "Funcoes.php";

$conn = conecta();

        if(isset($_POST['nome_produto']) && isset($_POST['descricao']) && isset($_POST['vlr']) && isset($_POST['id_visual']) && isset($_POST['custo']) && isset($_POST['margem_lucro']) && isset($_POST['icms']) && isset($_POST['qntd']))
        {
            $sql = "SELECT MIN(id_produto) AS menor_id FROM tbl_produto";
            $result = $conn->query($sql);
            if($result->rowCount() > 0){
                // Exibe o menor id_produto
                $row = $result->fetch();
            }
            else
            {
                echo "Não há produtos cadastrados.";
            }
        $params = [
            'id_produto'=>$row['menor_id']+1,
            ':nome_produto' => $_POST['nome_produto'],
            ':descricao' => $_POST['descricao'],
            ':vlr' => $_POST['vlr'],
            ':codigovisual' => $_POST['id_visual'],
            ':custo' => $_POST['custo'],
            ':margem_lucro' => $_POST['margem_lucro'],
            ':icms' => $_POST['icms'],
            ':qntd' => $_POST['qntd'],
            ':excluido' => '0'
        ];
        $sql = "INSERT INTO tbl_produto(
                id_produto,nome_produto, descricao, vlr, id_visual,excluido, custo, margem_lucro, icms, qntd)
                VALUES (
                :id_produto,:nome_produto, :descricao, :vlr, :codigovisual, :excluido,:custo, :margem_lucro, :icms, :qntd
                )";

        $stmt = $conn->prepare($sql);
        if ($stmt->execute($params)) {
            header("Location: Crud.php");
            exit();
        } else {
            echo "Erro ao inserir o produto no banco de dados.";
        }
        }
        else
        {
            echo "Não recebeu dados do form.";
        }
    ?>
