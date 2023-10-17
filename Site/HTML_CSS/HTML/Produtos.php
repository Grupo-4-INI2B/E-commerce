<?php
    ini_set ('display_errors', 1);
    error_reporting (E_ALL);
    session_start();
    include ("../../PHP/Funcoes.php");
    $conn = conecta();

    if(isset($_SESSION['sessaoUsuario'])) {
        $sessaoUsuario = $_SESSION['sessaoUsuario'];
        $nome = $_SESSION['nome'];
    }else {
        $sessaoUsuario = null;
        $nome = null;
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
    <link rel="stylesheet" href="../CSS/search-Box.css" />
    <script src="../JS/Home.js"></script>
</head>
<body>
    <div class="grid-container">
        <div class="grid-logo">
            <a href="index.php">
                <img class="logo" src="../Imagens/logocaixinhacolor.svg" alt="Logomarca">
            </a>
        </div>
        <div class="grid-item">
            <div>
                <a class="botao-menu" href="index.php" style="color: #000000">Home</a>
            </div>
        </div>
        <div class="grid-item">
            <div>
                <a class="botao-menu" href="Produtos.php" style="color: #000000">Produtos</a>
            </div>
        </div>
        <div class="grid-item">
            <div>
                <a class="botao-menu" href="Devops.php" style="color: #000000">Devops</a>
            </div>
        </div>

        <div class="search-container">
            <div class="buscar">
                <img src="../Imagens/search.svg" alt="Busca">
                <input type="text" name="busca" placeholder="Faça uma busca">
            </div>
        </div>
        <script src="../JS/Produtos.js"></script>

        <div class="grid-carrinho">
            <a class="botao-menu" href="Carrinho.php" style="color: #000000">
                <img src="../Imagens/IconCart.svg" alt="Ícone de carrinho de compras" width="15" height="15" style="position: relative; top: 3px;">
                Carrinho
            </a>
        </div>
        <div class="grid-login">
            <?php
                cabecalho($sessaoUsuario,  $nome);           
            ?>
        </div>
    </div>
    <div class="home">
        <br>
        <h1 class="margem-titulo">Os Nossos<br>Produtos</h1>
        <img src="../Imagens/onda.png" alt="" class="onda">
    </div>
    </div>
    <!-- Filtros -->
    <div class="filter">
        <label for="filter-select">Filtrar por:</label>
        <select id="filter-select">
            <option value="todos">Todos</option>
            <option value="Studio Ghibli">Studio Ghibli</option>
            <option value="Demon Slayer">Demon Slayer</option>
            <option value="Capivaras">Capivaras</option>
            <option value="Pokemons">Pokemons</option>
            <option value="Star Wars">Star Wars</option>
            <option value="Van Gogh">Van Gogh</option>
        </select>
    </div>
    <!-- JS e loop -->
    <form>
        <div class="container"></div>
        <script src="../JS/Produtos.js"> </script>
    </form>

<!-- Footer -->
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
                    <li><a href="#">Van Gogh</a></li>
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
