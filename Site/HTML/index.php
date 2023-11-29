<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Byte Craft - Home</title>
    <link rel="stylesheet" href="../CSS/base.css">
    <link rel="stylesheet" href="../CSS/home.css">
    <link rel="stylesheet" href="../CSS/Search-Box.css" />
    <link rel="icon" href="../Imagens/logocaixinha.svg"> 
    <script src="../JS/home.js"></script>
</head>
</html>
<?php
    ini_set ('display_errors', 1);
    error_reporting (E_ALL);
    session_start();
    include ("../PHP/funcoes.php");
    if($_GET['id'] == 1){
        echo "<script>alert('Compra finalizada');</script>";
    }
    if(isset($_SESSION['sessaoUsuario'])){
        $sessaoUsuario = $_SESSION['sessaoUsuario'];
        $nome = $_SESSION['nome'];
        $adm = $_SESSION['adm'];
    } else {
        $sessaoUsuario = null;
        $nome = null;
        $adm = false;
    }
?>
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
            <a class="botao-menu" href="produtos.php" style="color: #000000" >Produtos</a>

        </div>
    </div>
    <div  class="grid-item">
        <div >
            <a class="botao-menu" href="devops.php" style="color: #000000" >Devops</a>
        </div>
    </div>
    

    <div class="grid-carrinho">
        <a class="botao-menu" href="carrinho.php" class="btn btn-primary" style="color: #000000">
            <img src="../Imagens/IconCart.svg" alt="Ícone de carrinho de compras" width="15" height="15" style="position: relative; top: 3px;">
            Carrinho
          </a>
          

    </div>
    <div class="grid-login">
      <?php
        cabecalho($sessaoUsuario,  $nome, $adm);           
      ?>
    </div>
    </div>
</div>

    <div class="home">
        <br>
        <h1 class="margem-titulo"><br>Os Melhores<br>Produtos Geek's</h1>
            <img src="../Imagens//onda.png" alt="" class="onda">
    </div>
    <div class="container">
        <div class="produtos">
            <div class="produtos-filho">
                <h2 class="titulo-produtos" style="font-size: large;">Produtos<br>Autênticos</h2>
                <p class="subtitulo-produtos">Criado de maneira acessível, especialmente para o seu gosto.</p>
                <p class="topicos">Produtos personalizados</p>
                <p class="topicos">Diversidade de estampas para sua escolha</p>
                <p class="topicos">Extremamente duráveis</p>
                <p class="topicos">Escolha seu favorito, despertando sua criatividade</p>
                <div class="div-foto">
                <img src="../Imagens/Imgmedia2.png" class='img_media' alt="Botton">
                <img src="../Imagens/ImgMedia1.jpeg" class='img_media' alt="Botton">
                <img src="../Imagens/ImgMedia3.png" class='img_media' alt="Botton">
                </div>
            <a href="produtos.php">
                <button name="ver_mais" value="Ver Mais" class="vermais">Ver mais</button>
                </a>
            </div>

        </div>

        
        <div class="produtos-populares">
            <h1 class="mais-vendidos" style="font-size: large;">Mais vendidos</h1>
            <div class="navigation-buttons">
                <button class="pre-btn"><img src="../Imagens/caret-left-fill.svg" alt=""></button>
                <button class="nxt-btn"><img src="../Imagens/caret-right-fill.svg" alt=""></button>
            </div>
        
            <!-- Product Container -->
            <div class="product-container">
                
                <br>
                <!-- Product Card 1 -->
                <div class="product-card">
                    <img src="../Produtos_E-commerce/Studio_Ghibli/SG01.png" alt="Nome do Produto">
                    <h2>Adesivo Anime</h2>
                    <p>Studio Ghibli<br>01</p>
                    <p class="price">R$ 1,00</p>
                    <a href='../HTML/carrinho.php?operacao=incluir&id=1701' class='btn-buy'>Comprar</a>
                </div>

                <div class="product-card">
                    <img src="../Produtos_E-commerce/Harry Potter/HP25.png" alt="Nome do Produto">
                    <h2>Adesivo Anime</h2>
                    <p>Harry Potter<br>25</p>
                    <p class="price">R$ 1,00</p>
                    <a href='../HTML/carrinho.php?operacao=incluir&id=1425' class='btn-buy'>Comprar</a>
                </div>

                <div class="product-card">
                    <img src="../Produtos_E-commerce/Pokemons/PK15.png" alt="Nome do Produto">
                    <h2>Adesivo Anime</h2>
                    <p>Pokémon<br>15</p>
                    <p class="price">R$ 1,00</p>
                    <a href='../HTML/carrinho.php?operacao=incluir&id=1515' class='btn-buy'>Comprar</a>
                </div>

                <div class="product-card">
                    <img src="../Produtos_E-commerce/Aleatório/AL01.png" alt="Nome do Produto">
                    <h2>Adesivo Anime</h2>
                    <p>Aleatório<br>01</p>
                    <p class="price">R$ 1,00</p>
                    <a href='../HTML/carrinho.php?operacao=incluir&id=1101' class='btn-buy'>Comprar</a>
                </div>

                <div class="product-card">
                    <img src="../Produtos_E-commerce/Van Gogh/VG21.png" alt="Nome do Produto">
                    <h2>Adesivo Anime</h2>
                    <p>Van Gogh<br>21</p>
                    <p class="price">R$ 1,00</p>
                    <a href='../HTML/carrinho.php?operacao=incluir&id=1821' class='btn-buy'>Comprar</a>
                </div>
                <div class="product-card">
                    <img src="../Produtos_E-commerce/Demon Slayer/DS01.png" alt="Nome do Produto">
                    <h2>Adesivo Anime</h2>
                    <p>Demon Slayer<br>01</p>
                    <p class="price">R$ 1,00</p>
                    <a href='../HTML/carrinho.php?operacao=incluir&id=1301' class='btn-buy'>Comprar</a>
                </div>

                <div class="product-card">
                    <img src="../Produtos_E-commerce/Star Wars/SW09.png" alt="Nome do Produto">
                    <h2>Adesivo Anime</h2>
                    <p>Star Wars<br>09</p>
                    <p class="price">R$ 1,00</p>
                    <a href='../HTML/carrinho.php?operacao=incluir&id=1609' class='btn-buy'>Comprar</a>
                </div>

                <div class="product-card">
                    <img src="../Produtos_E-commerce/Capivaras/CP41.png" alt="Nome do Produto">
                    <h2>Adesivo Anime</h2>
                    <p>Capivaras<br>41</p>
                    <p class="price">R$ 1,00</p>
                    <a href='../HTML/carrinho.php?operacao=incluir&id=1241' class='btn-buy'>Comprar</a>
                </div>

                <div class="product-card">
                    <img src="../Produtos_E-commerce/Demon Slayer/DS35.png" alt="Nome do Produto">
                    <h2>Adesivo Anime</h2>
                    <p>Demon Slayer<br>35</p>
                    <p class="price">R$ 1,00</p>
                    <a href='../HTML/carrinho.php?operacao=incluir&id=1335' class='btn-buy'>Comprar</a>
                </div>

                <div class="product-card">
                    <img src=" ../Produtos_E-commerce/Pokemons/PK46.png" alt="Nome do Produto">
                    <h2>Adesivo Anime</h2>
                    <p>Pokémon<br>46</p>
                    <p class="price">R$ 1,00</p>
                    <a href='../HTML/carrinho.php?operacao=incluir&id=1546' class='btn-buy'>Comprar</a>
                </div>

        
                <!-- Adicione mais Product Cards aqui, se necessário -->
        
            </div>

        </div>
        
    </div>
    <div class="video-container">

        <h1 class="video" style="font-size: large;">Conheça nossos produtos mais de perto!!!</h1>

        <div class="teste">
            <div class="video-e-titulo">
                <iframe src="https://www.youtube.com/embed/mRSY6UVr4zg?si=xFEXNLrf53BOczrm" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
            <div class="Texto-do vídeo">
                    <p class="subtitulo-video">
                        "Prepare-se para uma explosão de criatividade e diversão com nossos stickers de animes, Star Wars, Harry Potter, capivaras e muito mais!  <br> Descubra os adesivos mais legais e em alta no momento neste vídeo promocional emocionante.<br> Personalize seus pertences como nunca antes e mergulhe no universo épico dos animes, na galáxia distante de Star Wars e na adorável companhia das capivaras mais fofas. <br>Não perca a chance de tornar seus pertences ainda mais incríveis e com a sua cara. <br>Venha conferir e leve a magia para suas conversas agora mesmo."<br>⚡🤓🪄🌟🐹</p>
            </div>
        </div>
        
    </div>
    <div class="video-container">
        <div class="teste">
            <div class="imgs">
                <img src="../Imagens/img_media1.png" alt="" id="foto">
            </div>
            
        </div>
    </div>
    <a href='index.php' class='voltar' >Voltar ao Topo</a>

    <!--Footer-->
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
            <li><a href="devops.php">Sobre nós</a></li>
            <li><a href="produtos.php">Nossos serviços</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h4>Ajuda</h4>
          <ul>
            <li>Opções de pagamento: Fichas</li>
          </ul>
        </div>

        <div class="footer-col">
          <h4>Loja Online</h4>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="produtos.php">Produtos</a></li>
            <li><a href="devops.php">Devops</a></li>
            <li><a href="carrinho.php">Carrinho</a></li>   
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