<!DOCTYPE html>
<html>

<head>
    <title>Formulário de Produto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/crud.css">
    <link rel="icon" href="../img/Logos.svg">
</head>

<body>
    <h2>Formulário de Produto</h2>
    <form action="Adicionar_produto.php" method="POST" enctype="multipart/form-data">
        <label for="id_produto"></label>
        <input type="hidden" id="id_produto" name="id_produto"><br><br>

        <label for="nome_produto">Nome:</label>
        <input type="text" id="nome_produto" name="nome_produto"><br><br>

        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao"></textarea><br><br>

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

        <input type="submit" value="Enviar">
    </form>
</body>

</html>