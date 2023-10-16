<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Byte Craft - Home</title>
    <link rel="stylesheet" href="../CSS/Base.css">
    <link rel="stylesheet" href="../CSS/Home.css">
    <link rel="stylesheet" href="../CSS/Search-Box.css" />
    <script src="../JS/Home.js"></script>
</head>
</html>
<?php
    ini_set ('display_errors', 1);
    error_reporting (E_ALL);
    session_start();
    include ("../../PHP/Funcoes.php");
    $conn = conecta();

    $nome = "";

    if(isset($_SESSION['sessaoUsuario'])) {
        $sessaoUsuario = $_SESSION['sessaoUsuario'];
        $nome = $_SESSION['nome'];
    }

?>
<body>
    <div class="grid-container">
        <div class="grid-logo">
            <a href="Home.html">
                <img class="logo" src="../Imagens/logocaixinhacolor.svg" alt="Logomarca">
            </a>
        </div>
    <div  class="grid-item">
        <div >
            <a class="botao-menu"ws href="Home.html" style="color: #000000" >Home</a>
        </div>
    </div>
    <div  class="grid-item">
        <div >
            <a class="botao-menu" href="Produtos.html" style="color: #000000" >Produtos</a>

        </div>
    </div>
    <div  class="grid-item">
        <div >
            <a class="botao-menu" href="Devops.html" style="color: #000000" >Devops</a>
        </div>
    </div>
    <div class="div-pesquisa">

    </div>

    <div class="grid-carrinho">
        <a class="botao-menu" href="Carrinho.html" class="btn btn-primary" style="color: #000000">
            <img src="../Imagens/IconCart.svg" alt="Ícone de carrinho de compras" width="15" height="15" style="position: relative; top: 3px;">
            Carrinho
          </a>
          

    </div>
    <div class="grid-login">
        <?php
            echo $nome;
            if(isset($sessaoUsuario)) {        
                echo "<a class='botao-menu' href='Perfil.php' class='cart' style='color: #000000'>
                <img src='../Imagens/IconPerson.svg' alt='Ícone de Usuário' width='15' height='15' 
                style='position: relative; top: 2px;'Bem vindo, $nome</a>";
            }else {
                echo "<a class='botao-menu' href='Login.php' class='cart' style='color: #000000'>
                <img src='../Imagens/IconPerson.svg' alt='Ícone de Usuário' width='15' height='15' 
                style='position: relative; top: 2px;'>Entrar</a>";
            } //Não funciona
        ?>
    
        </div>
    </div>
    <div class="home">
        <br>
        <h1 class="margem-titulo">Os Melhores<br>Produtos Geek's</h1>
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
                <form action="">
                    <button name="ver_mais" value="Ver Mais" class="vermais">Ver mais</button>
                </form>
            </div>
            <div class="div-foto">
                <img src="../Imagens/image.png" alt="" id="foto">
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
                    <p class="price">R$ 0,70</p>
                    <button type="submit" class="btn-buy">Comprar</button>
                </div>

                <div class="product-card">
                    <img src="../Produtos_E-commerce/Studio_Ghibli/SG02.png" alt="Nome do Produto">
                    <h2>Adesivo Anime</h2>
                    <p>Studio Ghibli<br>02</p>
                    <p class="price">R$ 0,70</p>
                    <button type="submit" class="btn-buy">Comprar</button>
                </div>

                <div class="product-card">
                    <img src="../Produtos_E-commerce/Studio_Ghibli/SG03.png" alt="Nome do Produto">
                    <h2>Adesivo Anime</h2>
                    <p>Studio Ghibli<br>03</p>
                    <p class="price">R$ 0,70</p>
                    <button class="btn-buy">Comprar</button>
                </div>

                <div class="product-card">
                    <img src="../Produtos_E-commerce/Studio_Ghibli/SG04.png" alt="Nome do Produto">
                    <h2>Adesivo Anime</h2>
                    <p>Studio Ghibli<br>04</p>
                    <p class="price">R$ 0,70</p>
                    <button class="btn-buy">Comprar</button>
                </div>

                <div class="product-card">
                    <img src="../Produtos_E-commerce/Studio_Ghibli/SG05.png" alt="Nome do Produto">
                    <h2>Adesivo Anime</h2>
                    <p>Studio Ghibli<br>05</p>
                    <p class="price">R$ 0,70</p>
                    <button class="btn-buy">Comprar</button>
                </div>
                <div class="product-card">
                    <img src="../Produtos_E-commerce/Studio_Ghibli/SG06.png" alt="Nome do Produto">
                    <h2>Adesivo Anime</h2>
                    <p>Studio Ghibli<br>06</p>
                    <p class="price">R$ 0,70</p>
                    <button class="btn-buy">Comprar</button>
                </div>

                <div class="product-card">
                    <img src="../Produtos_E-commerce/Studio_Ghibli/SG07.png" alt="Nome do Produto">
                    <h2>Adesivo Anime</h2>
                    <p>Studio Ghibli<br>07</p>
                    <p class="price">R$ 0,70</p>
                    <button class="btn-buy">Comprar</button>
                </div>

                <div class="product-card">
                    <img src="../Produtos_E-commerce/Studio_Ghibli/SG08.png" alt="Nome do Produto">
                    <h2>Adesivo Anime</h2>
                    <p>Studio Ghibli<br>08</p>
                    <p class="price">R$ 0,70</p>
                    <button class="btn-buy">Comprar</button>
                </div>

                <div class="product-card">
                    <img src="../Produtos_E-commerce/Studio_Ghibli/SG09.png" alt="Nome do Produto">
                    <h2>Adesivo Anime</h2>
                    <p>Studio Ghibli<br>09</p>
                    <p class="price">R$ 0,70</p>
                    <button class="btn-buy">Comprar</button>
                </div>

                <div class="product-card">
                    <img src=" ../Produtos_E-commerce/Studio_Ghibli/SG10.png" alt="Nome do Produto">
                    <h2>Adesivo Anime</h2>
                    <p>Studio Ghibli<br>10</p>
                    <p class="price">R$ 0,70</p>
                    <button class="btn-buy">Comprar</button>
                </div>

        
                <!-- Adicione mais Product Cards aqui, se necessário -->
        
            </div>

        </div>


    
        
    </div>
    <div class="video-container">
        <h1 class="video" style="font-size: large;">Vídeo</h1>
        <div class="teste">
            <div class="video-e-titulo">
                    <iframe src="https://www.youtube.com/embed/jIQ6UV2onyI?si=rc-Xb3Av7zGyVwOW" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
            <div class="Texto-do vídeo">
                    <p class="subtitulo-video">
                        "Prepare-se para uma explosão de criatividade e diversão com nossos stickers de animes, Star Wars, Harry Potter, capivaras e muito mais!  <br> Descubra os adesivos mais legais e em alta no momento neste vídeo promocional emocionante.<br> Personalize seus pertences como nunca antes e mergulhe no universo épico dos animes, na galáxia distante de Star Wars e na adorável companhia das capivaras mais fofas. <br>Não perca a chance de tornar seus pertences ainda mais incríveis e com a sua cara. <br>Venha conferir e leve a magia para suas conversas agora mesmo."<br>⚡🤓🪄🌟🐹</p>
            </div>
        </div>
        
    </div>


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
            <li><a href="#">Sobre nós</a></li>
            <li><a href="#">Nossos serviços</a></li>
            <li><a href="#">Politica de privacidade</a></li>
            <li><a href="#">Nossos Contribuintes</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Ajuda</h4>
          <ul>
            <li><a href="#">FAQ</a></li>
            <li><a href="#">Envio</a></li>
            <li><a href="#">Devolução</a></li>
            <li><a href="#">Status do Pedido</a></li>
            <li><a href="#">Opções de pagamento</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Loja Online</h4>
          <ul>
            <li><a href="#">Anime</a></li>
            <li><a href="#">Capivaras</a></li>
            <li><a href="#">Van Googh</a></li>
            <li><a href="#">Star wars</a></li>
            <li><a href="#">Harry Potter</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Nossas Redes</h4>
          <div class="social-links">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
          </div>
        </div>
      </div>
     </div>
  </footer>

</body>
</html>