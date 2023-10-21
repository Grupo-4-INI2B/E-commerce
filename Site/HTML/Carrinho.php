<?php
  ini_set ('display_errors', 1);
  error_reporting (E_ALL);
  session_start();
  include ("../PHP/Funcoes.php");
  $conn = conecta();  
  $session_id=session_id();
  if ( isset($_SESSION['sessaoUsuario']) ) {
    $login = $_SESSION['sessaoUsuario'];
    $codigoUsuario = ValorSQL($conn, " select id_usuario from tbl_usuario 
                                       where email = '$login'");
 }
 // existe alguma compra associada ao session_id ??
 $existe = intval ( ValorSQL($conn," select count(*) from tbl_compra inner join tbl_tmpcompra
                                                      on tbl_compra.id_compra = tbl_tmpcompra.fk_compra  
                                                      where tbl_tmpcompra.session = '$session_id' ") );
  $verificastatus = ValorSQL($conn," select status from tbl_compra inner join tbl_tmpcompra
                                                      on tbl_compra.id_compra = tbl_tmpcompra.fk_compra  
                                                      where tbl_tmpcompra.session = '$session_id' ");
 if ($existe) {
    $existe = true;
 } else {
    $existe = false;
 }
 echo $verificastatus;
 // se nao existe
 if($existe && $verificastatus=='Concluida')
 {
   $dataHoje = date('Y/m/d');
  
   $statusCompra = 'Pendente';

   ExecutaSQL($conn,"UPDATE tbl_compra SET status = '$statusCompra' WHERE fk_usuario = $codigoUsuario and status = 'Concluida'");
   echo $statusCompra;
   ExecutaSQL($conn," insert into tbl_compra (data_compra, status, fk_usuario) 
                       values ('$dataHoje','$statusCompra', $codigoUsuario) ");
                       echo $verificastatus;
   $codigoCompra = $conn->lastInsertId();

   // insere o tbl_tmpcompra
   ExecutaSQL($conn," insert into tbl_tmpcompra (fk_compra, session) 
                      values ($codigoCompra,'$session_id') ");
 }
 if (!$existe) {   
echo '1';
    $dataHoje = date('Y/m/d');
 
    $statusCompra = 'Pendente';

    // cria um registro de tbl_compra com o usuario nulo
    ExecutaSQL($conn," insert into tbl_compra (data_compra, status) 
                       values ('$dataHoje','$statusCompra') ");

    // recupera o codigo usado no auto-incremento
    $codigoCompra = $conn->lastInsertId();
    
    // insere o tbl_tmpcompra
    ExecutaSQL($conn," insert into tbl_tmpcompra (fk_compra, session) 
                       values ($codigoCompra,'$session_id') ");  
                       
 
 } else if($existe && $verificastatus=='Pendente'){
    $codigoCompra = intval ( ValorSQL($conn," select id_compra from tbl_compra
                                              inner join tbl_tmpcompra on tbl_compra.id_compra = 
                                              tbl_tmpcompra.fk_compra 
                                              where tbl_tmpcompra.session = '$session_id' "));

    // obtem o status dessa compra, se criou agora, entao eh 'pendente'
    $statusCompra = ValorSQL($conn, " select status from tbl_compra 
                                      where id_compra = $codigoCompra ");
 } 
 ////////////// se estiver logado atualiza e 'liga' a compra com o 
 ////////////// usuario
 if (isset($codigoUsuario)) {
    ExecutaSQL($conn,"update tbl_compra 
                         set fk_usuario = $codigoUsuario 
                      where 
                         fk_usuario is null and 
                         id_compra = $codigoCompra"); 
 }

 // se o carrinho foi chamado por COMPRAR, EXCLUIR ou FECHAR

 if ($_GET) { 
     
    $operacao      = $_GET['operacao'];
    $codigoProduto = $_GET['id'];
    // obtem a qtd atual desse produto no carrinho  
    $quantidade = intval ( ValorSQL($conn," select quantidade 
                                            from tbl_compra_produto 
                                            where 
                                               fk_produto = $codigoProduto and 
                                               fk_compra = $codigoCompra ") ); 
    $quantidade2 = intval (ValorSQL($conn," select qntd 
                                            from tbl_produto 
                                            where id_produto = $codigoProduto")); 
    if ($operacao == 'incluir') {
        if ($quantidade == 0) {
            ExecutaSQL($conn,
                      " insert into tbl_compra_produto 
                        (fk_produto,fk_compra,quantidade) 
                        values ($codigoProduto,$codigoCompra,1) "); 
        }else 
        if($quantidade2 >= $quantidade+1){
          ExecutaSQL($conn,
                    " update tbl_compra_produto 
                         set quantidade = quantidade + 1 
                      where 
                         fk_produto = $codigoProduto and 
                         fk_compra = $codigoCompra");   
        }
    } else 
    if ($operacao == 'excluir') {
        echo "<br> >> Vamor excluir...<br>";     
        if ($quantidade <= 1) { 
            ExecutaSQL($conn," delete from 
                                  tbl_compra_produto 
                               where 
                                  fk_produto = $codigoProduto and 
                                  fk_compra = $codigoCompra ");         
        } 
        else {
          ExecutaSQL($conn," update tbl_compra_produto 
                                 set quantidade = quantidade - 1 
                             where 
                                fk_produto = $codigoProduto and 
                                fk_compra = $codigoCompra ");       
      }
    } else 
    if ($operacao == 'fechar') {
       echo "<br> >> Vamor fechar...<br>";  
       $statusCompra = 'Concluida';
        ExecutaSQL($conn,"UPDATE tbl_compra SET status = '$statusCompra' WHERE fk_usuario = $codigoUsuario and status = 'Pendente'");
        ExecutaSQL($conn,"DELETE FROM tbl_tmpcompra USING tbl_compra WHERE tbl_tmpcompra.fk_compra = $codigoCompra");
        header("Location: ../HTML/Pagamento.php");
       // faz um form pra colocar forma de pagamento
       // colocar opcao de pix, cartao, etc, etc
       // conforme orientacao da professora jovita, 
       // exclua fisicamente o tmpcompra referente a essa compra
       // ...   
    }
  }
 

  
  //   $sessaoUsuario = $_SESSION['sessaoUsuario'];
  //   $nome = $_SESSION['nome'];
  //   $adm = $_SESSION['adm'];
  //   $select = $conn->prepare("SELECT * FROM tbl_carrinho WHERE usuario = :id_usuario");
  //   $select->bindParam(':id_usuario', $_SESSION['id_usuario'], PDO::PARAM_INT);
  //   $select->execute();
  //   $row = $select->fetch();
  //   if($row) { //Se já houver um carrinho criado, ele adiciona os produtos ao carrinho já existente.
  //     array_push($_SESSION['carrinho']['id_produto'], $row['id_produto']);
  //     $id=$_SESSION['carrinho']['id_produto'];
  //   }
  //   if(isset($_GET['id']) ){
  //     array_push($_SESSION['carrinho']['id_produto'], $_GET['id']);
  //     $id= $_SESSION['carrinho']['id_produto'];
  //   }
  // }else { //Se não houver sessão iniciada, ele cria um carrinho temporário.
  //   if(isset($_GET['id'])) {
  //     $id_produto=array();
  //     $id_produto[0]=$_GET['id'];
  //     array_push($_SESSION['carrinhoTpm']['id_produto'], $id_produto[0]);
      
  //     // $id = $_SESSION['carrinhoTpm']['id_produto'];
  //   }
  //   $sessaoUsuario = null;
  //   $nome = null;
  //   $adm = false;
  // }
  
  
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
            <img src="../Imagens/IconCart.svg" alt="Ícone de carrinho de compra" width="15" height="15" style="position: relative; top: 3px;">
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
          <a href="../HTML/Produtos.php" class="continue">Continuar comprando</a>
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
             
                
                <?php
                // echo $id;
                //     $select = $conn->prepare('SELECT nome_produto, vlr, categoria, imagem FROM tbl_produto WHERE id_produto=:id_produto ORDER BY id_produto ASC ');
                //     $select->bindParam(':id_produto', $id, PDO::PARAM_INT);
                //     $select->execute();
                //     $row = $select->fetch(PDO::FETCH_ASSOC);
                //         foreach($select as $row){
                //           $diretorioimg = $row['imagem'];
                //           $nome_produto = $row['nome_produto'];
                //           $vlr = $row['vlr'];
                //           $categoria = $row['categoria'];
                //           echo  "<div class='cartSection'>
                //                 <img src='$diretorioimg' alt='' class='itemImg' />
                //                 <p class='itemNumber'>$categoria</p>
                //                 <h3>$nome_produto</h3>
                //                 <p> <input type='text'  class='qty' placeholder='3'/> $vlr</p>";               
                //           }
                //         if($row==null)
                //          {
                //             echo "<h1>Seu carrinho está vazio</h1>";
                //          }
                $sql = " select tbl_produto.id_produto, 
                          tbl_produto.nome_produto,
                          tbl_compra_produto.quantidade, 
                          tbl_produto.imagem,
                          tbl_produto.vlr, 
                          tbl_produto.vlr * tbl_compra_produto.quantidade as sub  
                              from tbl_produto
                                  inner join tbl_compra_produto on 
                                      tbl_produto.id_produto = tbl_compra_produto.fk_produto 
                              where tbl_compra_produto.fk_compra = $codigoCompra";
   
                $select = $conn->query($sql);
                // cria table com itens no carrinho e seus subtotais
                while ( $linha = $select->fetch() ) {
                      $codigoProduto = $linha['id_produto'];
                      $nome_produto      = $linha['nome_produto'];
                      $quant         = $linha['quantidade'];
                      $vunit         = $linha['vlr'];
                      $sub           = $linha['sub'];
                      $imagem        = $linha['imagem'];
                      echo "
                            <div class='infoWrap'> 
                              <div class='cartSection'>
                                <img src='$imagem' alt='' class='itemImg'>
                                <h3>$nome_produto</h3>
                                <p>Quantidade: $quant</p>
                                <p>Valor unitário: $vunit</p>
                                <div class='prodTotal cartSection'>
                                  <p>Subtotal: $sub</p>
                                </div>
                                <a href='Carrinho.php?operacao=excluir&id=$codigoProduto'>Excluir</a>
                                <a href='Carrinho.php?operacao=incluir&id=$codigoProduto'>Adicionar</a>
                            </div>";    
                }
                
                echo "</table>";
                
                // calcula o total e mostra junto com o status da compra     
                $total = ValorSQL($conn," select sum (tbl_produto.vlr * tbl_compra_produto.quantidade)  
                                          from tbl_produto 
                                                inner join tbl_compra_produto on 
                                                  tbl_produto.id_produto = tbl_compra_produto.fk_produto                           
                                          where tbl_compra_produto.fk_compra = $codigoCompra "); 

                echo "Status da compra: $statusCompra<br>";
                echo "Total: $total <br><br>";
                
                // se o login foi obtido (se esta logado), mostra link 'fechar carrinho' 
                if ( isset($login) ) 
                {
                  if ($statusCompra == 'Pendente' && $login <> '') {
                    echo "<a href='Carrinho.php?operacao=fechar&id=0'>Fechar o carrinho</a>";         
                  }
                }

                // link pra voltar pra home
                echo "<br>
                      <a href='index.php'>Home</a>";  
                ?>
              
                 
              </div>  
          
              
              <!-- <div class="prodTotal cartSection">
                <p>$15.00</p>
              </div>
                    <div class="cartSection removeWrap">
                 <a href="#" class="remove">x</a>
              </div>
            </div>
            </li>
            <li class="items even">
              

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
            
            <li class="items even">Item 2</li>
       
          </ul>
        </div> -->
              
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