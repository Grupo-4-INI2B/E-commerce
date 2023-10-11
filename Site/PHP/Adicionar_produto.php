<?php
include "Funcoes.php";

$conn = conecta();

        if(isset($_POST['nome_produto']) && isset($_POST['descricao']) && isset($_POST['vlr']) && isset($_POST['id_visual']) && isset($_POST['custo']) && isset($_POST['margem_lucro']) && isset($_POST['icms']) && isset($_POST['qntd']))
        {
            $sql = "SELECT MAX(id_produto) AS maior_id FROM tbl_produto";
            $result = $conn->query($sql);
            if($result->rowCount() > 0){
                
                $row = $result->fetch();
            }
            else
            {
                echo "Não há produtos cadastrados.";
            }
            // Verifique se o formulário foi enviado
           
            $nomeImagem = $_FILES["imagem"]["name"];
            $tipoImagem = $_FILES["imagem"]["type"];
            $tamanhoImagem = $_FILES["imagem"]["size"];
            $dadosImagem = file_get_contents($_FILES["imagem"]["tmp_name"]);

            // Defina o caminho onde deseja armazenar a imagem no servidor
            $caminhoDiretorio = "../HTML_CSS/Produtos_E-commerce/";
            $caminhoImagem = $caminhoDiretorio . $nomeImagem;

            // Verifique se o tamanho do arquivo é aceitável (opcional)
            if ($tamanhoImagem > 3000000) { // 3 MB
                echo "A imagem é muito grande. O tamanho máximo permitido é 3 MB.";
                exit();
            }
            $params = [
                ':id_produto' => ($row['maior_id'] + 1),
                ':nome_produto' => $_POST['nome_produto'],
                ':descricao' => $_POST['descricao'],
                ':vlr' => $_POST['vlr'],
                ':codigovisual' => $_POST['id_visual'],
                ':custo' => $_POST['custo'],
                ':dta_exclusao' => '2011-01-01 00:00:00',
                ':margem_lucro' => $_POST['margem_lucro'],
                ':icms' => $_POST['icms'],
                ':imagem' => $caminhoImagem, 
                ':qntd' => $_POST['qntd'],
                ':excluido' => '0'
            ]   ;
            
            $sql = "INSERT INTO tbl_produto (
                id_produto, nome_produto, descricao, vlr, dta_exclusao, id_visual, excluido, custo, margem_lucro, icms, qntd, imagem
            ) VALUES (
                :id_produto, :nome_produto, :descricao, :vlr, :dta_exclusao, :codigovisual, :excluido, :custo, :margem_lucro, :icms, :qntd, :imagem
            )";
            
            $stmt = $conn->prepare($sql);
            
            if ($stmt->execute($params)) {
                move_uploaded_file($_FILES['imagem']['tmp_name'], '../HTML_CSS/Produto_E-commerce/' . $_FILES['imagem']['name']);
                header("Location: Crud.php");
                exit();
            }
        else
        {
            echo "Não recebeu dados do form.";
        }
        }
    ?>
