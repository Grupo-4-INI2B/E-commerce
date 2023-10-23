<?php
    ini_set ('display_errors', 1);
    error_reporting (E_ALL);
    session_start();
    include ("../PHP/Funcoes.php");

    if(!$_SESSION['adm']){ // Se não está logado ou não é administrador 
        header("Location: ../HTML/Login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Formulário de Produto</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <link rel="stylesheet" href="../CSS/crud.css">
    </head>
    <body>
        <h2>Formulário de Produto</h2>
        <form action="../PHP/Adicionar_produto.php" method="POST" enctype="multipart/form-data">
            <label for="id_produto">Id Produto</label>
            <input type="number" id="id_produto" name="id_produto" ><br><br>

            <label for="nome_produto">Nome:</label>
            <input type="text" id="nome_produto" name="nome_produto" ><br><br>

            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" ></textarea><br><br>

            <label for="vlr">Preço:</label>
            <input type="text" id="vlr" name="vlr"><br><br>

            <label for="id_visual">Código Visual:</label>
            <input type="text" id="id_visual" name="id_visual"><br><br>

            <label for="custo">Custo:</label>
            <input type="text" id="custo" name="custo"><br><br>

            <label for="margem_lucro">Margem de Lucro:</label>
            <input type="text" id="margem_lucro" name="margem_lucro"><br><br>

            <label for="icms">ICMS:</label>
            <input type="text" id="icms" name="icms"><br><br>

            <label for="qntd">Quantidade:</label>
            <input type="text" id="qntd" name="qntd"><br><br>

            <label for="categoria">Id Categoria:</label>
            <input type="text" id="categoria" name="categoria"><br><br>

            <label for="imagem">Imagem:</label>
            <input type="file" id="imagem" name="imagem"><br><br>

            <input type="submit" value="Enviar">
        </form>
    </body>
</html>