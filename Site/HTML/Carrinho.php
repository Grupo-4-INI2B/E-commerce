<?php
  ini_set ('display_errors', 1);
  error_reporting (E_ALL);
  session_start();
  include ("../PHP/Funcoes.php");
  $conn = conecta();

  if(isset($_SESSION['sessaoUsuario'])) { //Verifica se há sessão iniciada.
    $sessaoUsuario = $_SESSION['sessaoUsuario'];
    $nome = $_SESSION['nome'];
    $adm = $_SESSION['adm'];

    $select = $conn->prepare("SELECT * FROM tbl_carrinho WHERE usuario = :id_usuario");
    $select->bindParam(':id_usuario', $_SESSION['id_usuario'], PDO::PARAM_INT);
    $select->execute();
    $row = $select->fetch();

    unset($select);
    
    if($row) { //Se já houver um carrinho criado, ele adiciona os produtos ao carrinho já existente.
      $_SESSION['carrinho']['id_produto'] += $row['id_produto'];
      $_SESSION['carrinho']['qntd'] += $row['qntd'];
    }

    if(isset($_GET['id_produto']) && isset($_GET['qntd'])) {
      //Vai adcionar o produto selecionado em Produtos ao carrinho.
      $_SESSION['carrinho']['id_produto'] += $_GET['id_produto'];
      $_SESSION['carrinho']['qntd'] += $_GET['qntd'];
    } else {
      header("Location: Produtos.php");
      exit();
    }

  }else { //Se não houver sessão iniciada, ele cria um carrinho temporário.
    $sessaoUsuario = null;
    $nome = null;
    $adm = false;
    if(isset($_GET['id_produto']) && isset($_GET['qntd'])) {
      //Vai adcionar o produto selecionado em Produtos ao carrinho temporário.
      $_SESSION['carrinhoTpm']['id_produto'] += $_GET['id_produto'];
      $_SESSION['carrinhoTpm']['qntd'] += $_GET['qntd'];
    } else {
      header("Location: Produtos.php");
      exit();
    }
  }

  unset($conn);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Byte Craft - Carrinho</title>
    <link rel="stylesheet" href="../CSS/Base.css">
    <link rel="stylesheet" href="../CSS/Carrinho.css">
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
    </a>
    </div>
    </div>
    <div class="home">
        <br>
        <h1 class="margem-titulo">Suas<br>compras</h1>
            <img src="../Imagens//onda.png" alt="" class="onda">
    </div>
    <div id="grid-container-carrinho">
        <div class="heading cf">
          <h1>Meu Carrinho</h1>
          <a href="../PHP/Produtos.php" class="continue">Continuar comprando</a>
        </div>
        <div class="cart">
      <!--    <ul class="tableHead">
            <li class="prodHeader">Product</li>
            <li>Quantity</li>
            <li>Total</li>
             <li>Remove</li>
          </ul>-->
          <ul class="cartWrap">
            <li class="items odd">
              
          <div class="infoWrap"> 
              <div class="cartSection">
              <img src="http://lorempixel.com/output/technics-q-c-300-300-4.jpg" alt="" class="itemImg" />
                <p class="itemNumber">#QUE-007544-002</p>
                <h3>Item Name 1</h3>
              
                 <p> <input type="text"  class="qty" placeholder="3"/> x $5.00</p>
              
                <p class="stockStatus"> In Stock</p>
              </div>  
          
              
              <div class="prodTotal cartSection">
                <p>$15.00</p>
              </div>
                    <div class="cartSection removeWrap">
                 <a href="#" class="remove">x</a>
              </div>
            </div>
            </li>
            <li class="items even">
              
             <div class="infoWrap"> 
              <div class="cartSection">
               
              <img src="http://lorempixel.com/output/technics-q-c-300-300-4.jpg" alt="" class="itemImg" />
                <p class="itemNumber">#QUE-007544-002</p>
                <h3>Item Name 1</h3>
              
                 <p> <input type="text"  class="qty" placeholder="3"/> x $5.00</p>
              
                <p class="stockStatus"> In Stock</p>
              </div>  
          
              
              <div class="prodTotal cartSection">
                <p>$15.00</p>
              </div>
                    <div class="cartSection removeWrap">
                 <a href="#" class="remove">x</a>
              </div>
            </div>
            </li>
            
                  <li class="items odd">
                   <div class="infoWrap"> 
              <div class="cartSection">
                  
              <img src="http://lorempixel.com/output/technics-q-c-300-300-4.jpg" alt="" class="itemImg" />
                <p class="itemNumber">#QUE-007544-002</p>
                <h3>Item Name 1</h3>
              
                 <p> <input type="text"  class="qty" placeholder="3"/> x $5.00</p>
              
                <p class="stockStatus out"> Out of Stock</p>
              </div>  
          
              
              <div class="prodTotal cartSection">
                <p>$15.00</p>
              </div>
                          <div class="cartSection removeWrap">
                 <a href="#" class="remove">x</a>
              </div>
                    </div>
            </li>
            <li class="items even">
             <div class="infoWrap"> 
              <div class="cartSection info">
                   
              <img src="http://lorempixel.com/output/technics-q-c-300-300-4.jpg" alt="" class="itemImg" />
                <p class="itemNumber">#QUE-007544-002</p>
                <h3>Item Name 1</h3>
              
                <p> <input type="text"  class="qty" placeholder="3"/> x $5.00</p>
              
                <p class="stockStatus"> In Stock</p>
                
              </div>  
          
              
              <div class="prodTotal cartSection">
                <p>$15.00</p>
              </div>
          
                  <div class="cartSection removeWrap">
                 <a href="#" class="remove">x</a>
              </div>
               </div>
            </li>
            
            
            <!--<li class="items even">Item 2</li>-->
       
          </ul>
        </div>
              
        <div class="subtotal cf">
          <ul>
            <li class="totalRow"><span class="label">Subtotal</span><span class="value">$35.00</span></li>
            
                <li class="totalRow"><span class="label">Embalagem</span><span class="value">$5.00</span></li>
            
                  <li class="totalRow final"><span class="label">Total</span><span class="value">$44.00</span></li>
            <li class="totalRow"><a href="#" class="btn continue">Checkout</a></li>
          </ul>
        </div>
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