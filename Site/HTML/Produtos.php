<?php
    ini_set ('display_errors', 1);
    error_reporting (E_ALL);
    session_start();
    include ("../PHP/Funcoes.php");
    $conn = conecta();

    if(isset($_SESSION['sessaoUsuario'])) {
        $sessaoUsuario = $_SESSION['sessaoUsuario'];
        $nome = $_SESSION['nome'];
        $adm = $_SESSION['adm'];
    }else {
        $sessaoUsuario = null;
        $nome = null;
        $adm = false;
    }

    unset($conn);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Byte Craft - Produtos</title>
    <link rel="stylesheet" href="../CSS/Base.css">
    <link rel="stylesheet" href="../CSS/Produtos.css">
    <link rel="stylesheet" href="../CSS/Carrinho.css"/>
    <link rel="icon" href="../Imagens/logocaixinha.svg">

    <script src="../JS/Home.js"></script>
<body>
<div class="grid-container">
        <div class="grid-logo">
            <a href="index.php">
                <img class="logo" src="../Imagens/logocaixinhacolor.svg" alt="Logomarca">
            </a>
        </div>
    <div  class="grid-item">
        <div >
            <a class="botao-menu" href="index.php" style="color: #000000" >Home</a>
        </div>
    </div>
    <div  class="grid-item">
        <div >
            <a class="botao-menu" href="Produtos.php" style="color: #000000" >Produtos</a>

        </div>
    </div>
    <div  class="grid-item">
        <div >
            <a class="botao-menu" href="Devops.php" style="color: #000000" >Devops</a>
        </div>
    </div>

    <div class="grid-carrinho">
        <a class="botao-menu" href="Carrinho.php" class="btn btn-primary" style="color: #000000">
            <img src="../Imagens/IconCart.svg" alt="Ícone de carrinho de compras" width="15" height="15" style="position: relative; top: 3px;">
            Carrinho
          </a>
          

    </div>
    <div class='grid-login'>
        <div class="botao-menu">
        <?php
            cabecalho($sessaoUsuario,  $nome, $adm);           
        ?>
        </div>
    </div>
    </div>
    <div class="home">
        <br>
        <h1 class="margem-titulo"><br>Produtos</h1>
            <img src="../Imagens//onda.png" alt="" class="onda">
    </div>
    <!-- Filtros -->
    <div class="filter">
    <form name="filtro" action="Produtos.php" method="POST">
        <div class="dropdown">
            <button class="dropdownbtn">Filtro</button>
            <div class="dropdown-content">
                <!-- Corrigindo os atributos 'for' nos labels -->
                <input type="checkbox" name='filtro[]' id="Pokémon" value="Pokémon">
                <label for="Pokémon">Pokémon</label>
                <input type="checkbox" name='filtro[]' id="Harry Potter" value="Harry Potter">
                <label for="Harry Potter">Harry Potter</label>
                <input type="checkbox" name='filtro[]' id="Capivara" value="Capivara">
                <label for="Capivara">Capivaras</label>
                <input type="checkbox" name='filtro[]'  id="Van Gogh" value="Van Gogh">
                <label for="Van Gogh">Van Gogh</label>
                <input type="checkbox" name='filtro[]' id="Star Wars" value="Star Wars">
                <label for="Star Wars">Star Wars</label>
                <input type="checkbox" name='filtro[]' id="Studio Ghibli" value="Studio Ghibli">
                <label for="Studio Ghibli">Studio Ghibli</label>
                <input type="checkbox" name='filtro[]' id="Demon Slayer" value="Demon Slayer">
                <label for="Demon Slayer">Demon Slayer</label>
                <input type="checkbox" name='filtro[]' id="Aleatório" value="Aleatório">
                <label for="Aleatório">Aleatório</label>
                <input type="checkbox" name='filtro[]' id="Botton" value="Botton">
                <label for="Botton">Botton</label>
                <input type="checkbox" name='filtro[]' id="Poster" value="Poster">
                <label for="Poster">Poster</label>
                <input type="submit" value='Filtrar' class='btn' name='categorias'></input>
                <br>

            </div>
        </div>
    </form>
</div>
        <!-- JS e loop -->
        <form>
            <div class="container">
                <?php
                // Certifique-se de ter a função `conecta()` definida para a conexão com o banco de dados
                $conn = conecta();
                $categorias=isset($_POST['filtro'])?$_POST['filtro']:null;
                if($categorias !== null)
                {
                    for($i=0;$i<count($categorias);$i++)
                    {
                        $categoria=$categorias[$i];
                        $query = ("SELECT * FROM tbl_produto WHERE categoria = '$categoria' AND qntd > 0 ORDER BY id_produto ASC");
                        $result = $conn->query($query);
                        if ($result->rowCount() > 0) {
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            $id = $row['id_produto'];
                            $name = $row['nome_produto'];
                            $imagem = $row['imagem'];
                            $description = $row['descricao'];
                            $vlr = number_format($row['vlr'], 2, ',', '.');
                            $qntd = $row['qntd'];
                                echo "<div class='product-card' >
                                <div ><img src='" . $imagem . "'> </div>
                                <h2>$name</h2>
                                <p>$description</p>
                                <h3>R$ $vlr</h3><h3>Quantidade em estoque: $qntd</h3>
                                <a href='../HTML/Carrinho.php?operacao=incluir&id=$id' class='btn-buy'>Comprar</a>
                                </div>";
                        
                        }
                        
                    }
                }
                }
                else
                    {
                        $query = "SELECT * FROM tbl_produto WHERE qntd>0 ORDER BY id_produto ASC";
                        $result = $conn->query($query);
                        if ($result->rowCount() > 0) {
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                $id = $row['id_produto'];
                                $name = $row['nome_produto'];
                                $imagem = $row['imagem'];
                                $description = $row['descricao'];
                                $vlr = number_format($row['vlr'], 2, ',', '.');
                                $qntd = $row['qntd'];
                                    echo "<div class='product-card' >
                                    <div ><img src='" . $imagem . "'> </div>
                                    <h2>$name</h2>
                                    <p>$description</p>
                                    <h3>R$ $vlr</h3><h3>Quantidade em estoque: $qntd</h3>
                                    <a href='../HTML/Carrinho.php?operacao=incluir&id=$id' class='btn-buy'>Comprar</a>
                                    </div>";
                    }
                }	
            }  
                        
                ?>
            </div>
        </form>

     
                     
        </div>
       
    </form>
    <a href='Produtos.php' class='btn-buy'>Voltar ao Topo</a>
<!-- Footer -->
<title>Footer Design</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body>

<footer class="footer">
     <div class="container-footer">
      <div class="row">
        <div class="footer-col">
          <h4>ByteCraft</h4>
          <ul>
            <li><a href="Devops.php">Sobre nós</a></li>
            <li><a href="Produtos.php">Nossos serviços</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h4>Ajuda</h4>
          <ul>
            <li><a href="#">Opções de pagamento: Fichas</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h4>Loja Online</h4>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="Produtos.php">Produtos</a></li>
            <li><a href="Devops.php">Devops</a></li>
            <li><a href="Carrinho.php">Carrinho</a></li>   
          </ul>
        </div>

        <div class="footer-col">
          <h4>Nossas Redes</h4>
          <div class="social-links">
            <a href="https://www.instagram.com/bbyte_craft/"><i class="fab fa-instagram"></i></a>
          </div>
        </div>
        
      </div>
     </div>
  </footer>
</body>
</html>
