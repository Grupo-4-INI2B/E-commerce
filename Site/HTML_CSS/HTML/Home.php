<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/Home.css">
    <link rel="stylesheet" href="../CSS/Search-Box.css" />
    <script src="../JS/home.js"></script>
</head>
        <?php
            session_start();
            if (isset($_SESSION['loginCookie'])) {
                $sessaoConectado = $_SESSION['sessaoConectado'];
                echo "teste";
            } else { 
                $sessaoConectado = false; 
            }
        ?>
<body>
    <div class="grid-container">
        <div class="grid-logo">
            <img class="logo" src="../Imagens/logocaixinhacolor.svg" alt="Logomarca">
        </div>
    <div  class="grid-item">
        <div >
            <a href="Home.html" style="color: #000000" >Home</a>
        </div>
    </div>
    <div  class="grid-item">
        <div >
            <a href="Produtos.html" style="color: #000000" >Produtos</a>

        </div>
    </div>
    <div  class="grid-item">
        <div >
            <a href="Devops.html" style="color: #000000" >Devops</a>
        </div>
    </div>
    <div class="search-container">
        <form>
            <label for="search-input" class="search-icon"></label>
            <input type="text" class="search-input" id="search-input" width="30" height="15" required />
        </form>
    </div>

    <div class="grid-carrinho">
        <a href="Carrinho.html" class="btn btn-primary" style="color: #000000">
            <img src="../Imagens/IconCart.svg" alt="Ícone de carrinho de compras" width="15" height="15" style="position: relative; top: 3px;">
            Carrinho
          </a>
          

    </div>
    <div class="grid-login">
        <a href="login.html" class="cart" style="color: #000000">
        <img src="../Imagens/IconPerson.svg" alt="Ícone de Usuário" width="15" height="15" style="position: relative; top: 2px;">
        Entrar
    </a>
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
            <div class="navigation-buttons">
                <button class="pre-btn"><img src="../Imagens/caret-left-fill.svg" alt=""></button>
                <button class="nxt-btn"><img src="../Imagens/caret-right-fill.svg" alt=""></button>
            </div>
        
            <!-- Product Container -->
            <div class="product-container">
                
                <br>
                <!-- Product Card 1 -->
                <div class="product-card">
                    <img src="../Produtos E-commerce/Studio Ghibli/SG01.png" alt="Nome do Produto">
                    <h2>Adesivo Anime</h2>
                    <p>Studio Ghibli<br>01</p>
                    <p class="price">R$ 0,70</p>
                    <button type="submit" class="btn-buy">Comprar</button>
                </div>

                <div class="product-card">
                    <img src="../Produtos E-commerce/Studio Ghibli/SG02.png" alt="Nome do Produto">
                    <h2>Adesivo Anime</h2>
                    <p>Studio Ghibli<br>02</p>
                    <p class="price">R$ 0,70</p>
                    <button type="submit" class="btn-buy">Comprar</button>
                </div>

                <div class="product-card">
                    <img src="../Produtos E-commerce/Studio Ghibli/SG03.png" alt="Nome do Produto">
                    <h2>Adesivo Anime</h2>
                    <p>Studio Ghibli<br>03</p>
                    <p class="price">R$ 0,70</p>
                    <button class="btn-buy">Comprar</button>
                </div>

                <div class="product-card">
                    <img src="../Produtos E-commerce/Studio Ghibli/SG04.png" alt="Nome do Produto">
                    <h2>Adesivo Anime</h2>
                    <p>Studio Ghibli<br>04</p>
                    <p class="price">R$ 0,70</p>
                    <button class="btn-buy">Comprar</button>
                </div>

                <div class="product-card">
                    <img src="../Produtos E-commerce/Studio Ghibli/SG05.png" alt="Nome do Produto">
                    <h2>Adesivo Anime</h2>
                    <p>Studio Ghibli<br>05</p>
                    <p class="price">R$ 0,70</p>
                    <button class="btn-buy">Comprar</button>
                </div>
                <div class="product-card">
                    <img src="../Produtos E-commerce/Studio Ghibli/SG06.png" alt="Nome do Produto">
                    <h2>Adesivo Anime</h2>
                    <p>Studio Ghibli<br>06</p>
                    <p class="price">R$ 0,70</p>
                    <button class="btn-buy">Comprar</button>
                </div>

                <div class="product-card">
                    <img src="../Produtos E-commerce/Studio Ghibli/SG07.png" alt="Nome do Produto">
                    <h2>Adesivo Anime</h2>
                    <p>Studio Ghibli<br>07</p>
                    <p class="price">R$ 0,70</p>
                    <button class="btn-buy">Comprar</button>
                </div>

                <div class="product-card">
                    <img src="../Produtos E-commerce/Studio Ghibli/SG08.png" alt="Nome do Produto">
                    <h2>Adesivo Anime</h2>
                    <p>Studio Ghibli<br>08</p>
                    <p class="price">R$ 0,70</p>
                    <button class="btn-buy">Comprar</button>
                </div>

                <div class="product-card">
                    <img src="../Produtos E-commerce/Studio Ghibli/SG09.png" alt="Nome do Produto">
                    <h2>Adesivo Anime</h2>
                    <p>Studio Ghibli<br>09</p>
                    <p class="price">R$ 0,70</p>
                    <button class="btn-buy">Comprar</button>
                </div>

                <div class="product-card">
                    <img src=" ../Produtos E-commerce/Studio Ghibli/SG10.png" alt="Nome do Produto">
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
        <div>
            <h2 class="video" style="font-size: large;">Vídeo</h2>
            <iframe src="https://www.youtube.com/embed/ZstsPUKT5CI?si=Q7e-LowkpHzFFVwe" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
        <div class="Texto-do vídeo">
            <p class="subtitulo-video">Aqui você encontra os melhores produtos geek's do mercado.</p>
        </div>
    </div>
    <!---->
</body>
</html>