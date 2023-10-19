<?php
    ini_set ('display_errors', 1);
    error_reporting (E_ALL);
    session_start();
    include ("../PHP/Funcoes.php");

    if(isset($_SESSION['sessaoUsuario'])) {
      $sessaoUsuario = $_SESSION['sessaoUsuario'];
      $nome = $_SESSION['nome'];
      $adm = $_SESSION['adm'];
    }else {
      $sessaoUsuario = null;
      $nome = null;
      $adm = false;
    }

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Byte Craft - Devops</title>
    <link rel="stylesheet" href="../CSS/Base.css">
    <link rel="stylesheet" href="../CSS/Devops.css">
    <link rel="stylesheet" href="../CSS/Search-Box.css" />
    <script src="../JS/Home.js"></script>
</head>
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
    <div class="search-container">
        <form>
            <label for="search-input" class="search-icon"></label>
            <input type="text" class="search-input" id="search-input" width="30" height="15" required />
        </form>
    </div>

    <div class="grid-carrinho">
        <a class="botao-menu" href="Carrinho.php" class="btn btn-primary" style="color: #000000">
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
    <div class="home">
        <br>
        <h1 class="margem-titulo">Os Nossos Dev's</h1>
            <img src="../Imagens//onda.png" alt="" class="onda">
    </div>
    <div class="grid-container2">
        <div class="gustavo">
            <img src="../Imagens/gustavo.png" width="160" height="160">
            <br>
            <H2>Gustavo Polido</H2>
            <h3> Número 16</h3>
        </div>
        <div class="heitor">
             <img src="../Imagens/heitor.jpg" width="160" height="160">
             <br>
            <H2> Heitor Lima</H2>
            <h3> Número 17</h3>
        </div>
        <div class="igor">
            <img src="../Imagens/igor.jpg" width="160" height="160">
            <br>
            <H2> Igor Zamparo</H2>
            <h3> Número 18</h3>
        </div>
        <div class="janaina">
            <img src="../Imagens/janaina.jpg" width="160" height="160">
            <br>
            <H2> Janaina Silva</H2>
            <h3> Número 19</h3>
        </div>
        <div class="juliana">
            <img src="../Imagens/juliana.jpg" width="160" height="160">
            <br>
            <H2> Juliana Tano</H2>
            <h3> Número 20</h3>
        </div>
      </div>
      <div class="infogeral">
              <h3>A ByteCraft é uma loja online criada a partir de um projeto curricular
                que abrange as disciplinas de Gestão de Negócios, Aplicativos I, Banco de 
                Dados e PHP, ministradas pelos professores Jovita Mercedes H. Baenas, Débora Aires, 
                José Vieira e Marcelo Cabello. Desenvolvida para amantes da cultura 
                Geek em geral, nossa loja </h3>
              <h4> Colégio Técnico Industrial “Prof. Isaac 
                  Portal Roldán” - Câmpus de Bauru </h4>  
      </div>
    </div>
</body>

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