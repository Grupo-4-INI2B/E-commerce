<?php
include "Funcoes.php";

$conn = conecta();

            $id= $_POST['id_produto'];
           
            // Verifique se o formulário foi enviado
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nomeImagem = $_FILES["imagem"]["name"];
                $tipoImagem = $_FILES["imagem"]["type"];
                $tamanhoImagem = $_FILES["imagem"]["size"];
                $dadosImagem = file_get_contents($_FILES["imagem"]["tmp_name"]);
            
                // Defina o caminho onde deseja armazenar a imagem no servidor
                if($id > 1100 && $id < 1200)
                {
                $caminhoDiretorio = "../Produtos_E-commerce/Aleatório/";
                }
                else
                if($id > 1200 && $id < 1300)
                {
                $caminhoDiretorio = "../Produtos_E-commerce/Capivaras/";
                }
                else
                if($id > 1300 && $id < 1400)
                {
                $caminhoDiretorio = "../Produtos_E-commerce/Demon Slayer/";
                }
                else
                if($id > 1400 && $id < 1500)
                {
                $caminhoDiretorio = "../Produtos_E-commerce/Harry Potter/";
                }
                else
                if($id > 1500 && $id < 1600)
                {
                $caminhoDiretorio = "../Produtos_E-commerce/Pokemons/";
                }
                else
                if($id > 1600 && $id < 1700)
                {
                $caminhoDiretorio = "../Produtos_E-commerce/Star Wars/";
                }
                else
                if($id > 1700 && $id < 1800)
                {
                $caminhoDiretorio = "../Produtos_E-commerce/Studio_Ghibli/";
                }
                else
                if($id > 1800 && $id < 1900)
                {
                $caminhoDiretorio = "../Produtos_E-commerce/Van Gogh/";
                }
                $caminhoImagem = $caminhoDiretorio . $nomeImagem;
            
                // Verifique se o arquivo é uma imagem válido (opcional)
                $permitirTipos = array("image/jpeg", "image/png", "image/gif");
                if (!in_array($tipoImagem, $permitirTipos)) {
                    echo "Somente imagens JPEG, PNG e GIF são permitidas.";
                    exit();
                }
            
                // Verifique se o tamanho do arquivo é aceitável (opcional)
                if ($tamanhoImagem > 3000000) { // 3 MB
                    echo "A imagem é muito grande. O tamanho máximo permitido é 3 MB.";
                    exit();
                }
                // Mova a imagem para o diretório desejado no servidor
                if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminhoImagem)) {
                    // The image was uploaded successfully, and now you can insert the data into the database.
                    $params = array(
                        ':id_produto'=> $_POST['id_produto'],
                        ':nome' => $_POST['nome_produto'],
                        ':descricao' => $_POST['descricao'],
                        ':preco' => $_POST['vlr'],
                        ':codigovisual' => $_POST['id_visual'],
                        ':custo' => $_POST['custo'],
                        ':margem_lucro' => $_POST['margem_lucro'],
                        ':icms' => $_POST['icms'],
                        ':imagem' => $caminhoImagem, // Save the image path in the database.
                        ':excluido' => '0',
                        ':quantidade' => $_POST['qntd'],
                        ':categoria' => $_POST['categoria']
                    );
                    $sql = "INSERT INTO tbl_produto (
                        id_produto, nome_produto, descricao, vlr, id_visual, custo, margem_lucro, icms, imagem, excluido, qntd, categoria
                    ) VALUES (
                        :id_produto, :nome, :descricao, :preco, :codigovisual, :custo, :margem_lucro, :icms, :imagem, :excluido, :quantidade, :categoria
                    )";
                
                    $stmt = $conn->prepare($sql);
                    if ($stmt->execute($params)) {
                        header("Location: ./Crud.php");
                        exit();
                    } else {
                        echo "Erro ao inserir o produto no banco de dados.";
                    }
                } else {
                    echo "Erro ao fazer o upload da imagem.";
                }
            }
    ?>
