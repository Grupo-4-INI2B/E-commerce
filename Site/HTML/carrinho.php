<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
include("../PHP/funcoes.php");
$conn = conecta();
$session_id = session_id();

if (isset($_SESSION['sessaoUsuario'])) { //Se o usuário estiver logado.
  $login = $_SESSION['sessaoUsuario']; //Pega o login(email) do usuário.
  $nome=ValorSQL($conn, "SELECT nome_usuario FROM tbl_usuario WHERE email = '$login'"); //Pega o nome do usuário.
  $adm=ValorSQL($conn, "SELECT adm FROM tbl_usuario WHERE email = '$login'"); //Pega o adm do usuário.
  $codigoUsuario = ValorSQL($conn, " SELECT id_usuario FROM tbl_usuario 
                                     WHERE email = '$login'"); //Seleciona o id do usuário aonde ele for igual ao login(email).
} else { //Se o usuário não estiver logado.
  $login = null; //O login(email) do usuário é nulo.
  $codigoUsuario = null; //O código do usuário é nulo.
  $nome = null; //O nome do usuário é nulo.
  $adm = null; //O adm do usuário é nulo.
}

//existe alguma compra associada ao session_id ??
$existe = intval(ValorSQL($conn, "SELECT count(*) FROM tbl_compra INNER JOIN tbl_tmpcompra ON tbl_compra.id_compra = tbl_tmpcompra.fk_compra  
  WHERE tbl_tmpcompra.session = '$session_id'")); //Verifica se existe alguma compra associada ao session_id.
$verificastatus = ValorSQL($conn, "SELECT status FROM tbl_compra INNER JOIN tbl_tmpcompra ON tbl_compra.id_compra = tbl_tmpcompra.fk_compra  
  WHERE tbl_tmpcompra.session = '$session_id'"); //Verifica qual o estado atual da compra associada ao session_id.

//Se existir, ele é true, se não existir, ele é false.
if ($existe) {
  $existe = true;
} else {
  $existe = false;
}

$dataHoje = date("Y-m-d H:i:s"); //Pega a data e hora atual.

if (!$existe) {   // se não existe.
  $statusCompra = 'Pendente'; //O status da compra é pendente.

  //Cria um registro de tbl_compra com o usuario nulo.
  ExecutaSQL($conn, "INSERT INTO tbl_compra (data_compra, status) VALUES ('$dataHoje', '$statusCompra')");

  //Recupera o codigo usado no auto-incremento.
  $codigoCompra = $conn->lastInsertId();

  //Insere o tbl_tmpcompra
  ExecutaSQL($conn, "INSERT INTO tbl_tmpcompra (fk_compra, session) VALUES ('$codigoCompra', '$session_id')");
} else { //Se ele existe e a compra estiver pendente.
  $codigoCompra = intval(ValorSQL($conn, "SELECT id_compra FROM tbl_compra
                                             INNER JOIN tbl_tmpcompra ON tbl_compra.id_compra = tbl_tmpcompra.fk_compra 
                                             WHERE tbl_tmpcompra.session = '$session_id'")); //Pega o id da compra.

  //Obtém o status dessa compra, se criou agora, entao é 'pendente'.
  $statusCompra = ValorSQL($conn, "SELECT status FROM tbl_compra WHERE id_compra = $codigoCompra");
}

if (isset($codigoUsuario)) { //Se o código do usuário estiver definido(quando está logado).
  ExecutaSQL($conn, "UPDATE tbl_compra 
                        SET fk_usuario = $codigoUsuario 
                        WHERE 
                          fk_usuario IS NULL AND 
                          id_compra = $codigoCompra");
}

// se o carrinho foi chamado por COMPRAR, EXCLUIR ou FECHAR
if ($_GET) { //Quando o usuário clica em comprar em produtos e é redirecionado para carrinho ou quando clica em adcionar, excluir ou fechar em carrinho.    
  $operacao = $_GET['operacao']; //Pega a operação que o usuário realizou.
  $codigoProduto = $_GET['id']; //Pega o id do produto.

  //Obtém a quantidade atual desse produto no carrinho.  
  $quantidade = intval(ValorSQL($conn, "SELECT quantidade FROM tbl_compra_produto WHERE fk_produto = $codigoProduto AND fk_compra = $codigoCompra"));
  //Obtém a quantidade atual desse produto no estoque.    
  $quantidade2 = intval(ValorSQL($conn, "SELECT qntd FROM tbl_produto WHERE id_produto = $codigoProduto"));

  if ($operacao == 'incluir') { //Se a operação for incluir.
    if ($quantidade == 0) {
      //Insere o id do produto, o id da compra e a quantidade na tabela tbl_compra_produto. 
      ExecutaSQL($conn, "INSERT INTO tbl_compra_produto (fk_produto, fk_compra, quantidade) VALUES ($codigoProduto, $codigoCompra, 1)");
    } else if ($quantidade2 >= $quantidade + 1) {
      ExecutaSQL($conn, "UPDATE tbl_compra_produto 
                           SET quantidade = quantidade + 1 
                           WHERE 
                            fk_produto = $codigoProduto 
                            AND fk_compra = $codigoCompra"); //Atualiza a quantidade do produto na tabela tbl_compra_produto.   
    }
  } else if ($operacao == 'excluir') { //Se a operação for excluir.
    if ($quantidade <= 1) {
      //Exclui o produto da tabela tbl_compra_produto. 
      ExecutaSQL($conn, "DELETE FROM tbl_compra_produto WHERE fk_produto = $codigoProduto AND fk_compra = $codigoCompra");
    } else {
      //Atualiza a quantidade do produto na tabela tbl_compra_produto.
      ExecutaSQL($conn, "UPDATE tbl_compra_produto SET quantidade = quantidade - 1 WHERE fk_produto = $codigoProduto AND fk_compra = $codigoCompra");
    }
  } else if ($operacao == 'fechar') { //Se a operação for fechar(terminar a compra).
    $statusCompra = 'Concluida'; //O status da compra é concluida.

    //Atualiza o status da compra para concluida.
    ExecutaSQL($conn, "UPDATE tbl_produto 
                         SET qntd = tbl_produto.qntd - tbl_compra_produto.quantidade 
                         FROM tbl_compra_produto
                         WHERE tbl_produto.id_produto = tbl_compra_produto.fk_produto AND tbl_compra_produto.fk_compra = $codigoCompra");
    $idproduto=ValorSQL($conn,"SELECT fk_produto FROM tbl_compra_produto WHERE fk_compra = $codigoCompra");      
    ValorSQL($conn,"UPDATE tbl_produto SET excluido = true, dta_exclusao = '$dataHoje' 
                    FROM tbl_compra_produto WHERE tbl_produto.qntd = 0 AND tbl_produto.id_produto = $idproduto;");

    //Atualiza o status da compra para concluida.
    ExecutaSQL($conn,"UPDATE tbl_compra SET status = '$statusCompra' WHERE fk_usuario = $codigoUsuario and status = 'Pendente'");
echo $codigoCompra;
      $sql=("SELECT tbl_compra.id_compra, tbl_compra.data_compra, tbl_compra.fk_usuario,
                          tbl_compra_produto.fk_produto, tbl_compra_produto.quantidade
                          FROM tbl_compra INNER JOIN tbl_compra_produto
                          ON tbl_compra.id_compra=tbl_compra_produto.fk_compra
                          WHERE tbl_compra.id_compra=$codigoCompra;");
      $select = $conn->query($sql);

    // cria table com itens no carrinho e seus subtotais
      while ($linha = $select->fetch()) {
      $id_compra=$linha['id_compra'];
      $dataCompra = $linha['data_compra'];
      $id_produto = $linha['fk_produto'];
      $quantidade = $linha['quantidade'];
      $fk_usuario = $linha['fk_usuario'];
      $sql2=("SELECT nome_produto,vlr FROM tbl_produto WHERE id_produto=$id_produto;");
      $select2 = $conn->query($sql2);
      while($linha2 = $select2->fetch()){
        $nome_produto=$linha2['nome_produto'];
        $sub=$linha2['vlr'];
        $vlr_total=$vlr*$quantidade;
      }
      $sql3=("SELECT nome_usuario FROM tbl_usuario WHERE id_usuario=$fk_usuario;");
      $select3 = $conn->query($sql3);
      while( $linha3 = $select3->fetch()){
        $nome_usuario=$linha3['nome_usuario'];
      } 
    }

    //Deleta da compra temporário.
    ExecutaSQL($conn, "DELETE FROM tbl_tmpcompra USING tbl_compra WHERE tbl_tmpcompra.fk_compra = $codigoCompra");

    //Redereciona para a página de pagamento.
    header("Location: ../HTML/pagamento.php");
  }else if($_GET['operacao'] == 'apagar') { //Se a operação for destruir.
    ExecutaSQL($conn, "DELETE FROM tbl_tmpcompra USING tbl_compra WHERE tbl_tmpcompra.fk_compra = $codigoCompra");
    header("Location: ../HTML/carrinho.php");
  }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Byte Craft - Carrinho</title>
  <link rel="stylesheet" href="../CSS/base.css">
  <link rel="stylesheet" href="../CSS/carrinho.css">
  <link rel="stylesheet" href="../CSS/Search-Box.css" />
  <link rel="icon" href="../Imagens/logocaixinha.svg">
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
        <a class="botao-menu" href="produtos.php" style="color: #000000">Produtos</a>
      </div>
    </div>

    <div class="grid-item">
      <div>
        <a class="botao-menu" href="devops.php" style="color: #000000">Devops</a>
      </div>
    </div>


    <div class="grid-carrinho">
      <a class="botao-menu" href="carrinho.php" class="btn btn-primary" style="color: #000000">
        <img src="../Imagens/IconCart.svg" alt="Ícone de carrinho de compra" width="15" height="15" style="position: relative; top: 3px;">
        Carrinho
      </a>
    </div>

    <div class='grid-login'>
        <div class="botao-menu">
        <?php
            cabecalho($login,  $nome, $adm);           
        ?>
        </div>
    </div>
  </div>

  <div class="home">
    <h1 class="margem-titulo"><br>Suas compras</h1>
    <img src="../Imagens//onda.png" alt="" class="onda">
  </div>

  <!--Corpo principal do carrinho-->
  <div id="grid-container-carrinho">
    <div class="heading cf">
      <h1>Meu Carrinho</h1>
      <a href="../HTML/produtos.php" class="continue">Continuar comprando</a>
    </div>

    <div class="cart">
      <ul class="cartWrap">
        <li class="items odd">
          <div class="infoWrap">
            <?php
            $sql = "select tbl_produto.id_produto, tbl_produto.nome_produto, tbl_compra_produto.quantidade, tbl_produto.imagem,
                    tbl_produto.vlr, tbl_produto.vlr * tbl_compra_produto.quantidade as sub from tbl_produto inner join tbl_compra_produto 
                    on tbl_produto.id_produto = tbl_compra_produto.fk_produto 
                    where tbl_compra_produto.fk_compra = $codigoCompra
            ";
            $select = $conn->query($sql);

            // cria table com itens no carrinho e seus subtotais
            while ($linha = $select->fetch()) {
              $codigoProduto = $linha['id_produto'];
              $nome_produto = $linha['nome_produto'];
              $quant = $linha['quantidade'];
              $vunit = $linha['vlr'];
              $sub = $linha['sub'];
              $imagem = $linha['imagem'];
              echo " <div class='grid-card'>
                  <div class='cartSection'>
                    <img src='$imagem' alt='' class='itemImg'>
                    <h3>$nome_produto</h3>
                    <p>Quantidade: $quant</p>
                    <br>
                    <p>Valor unitário R$: $vunit,00</p>
                    <br>
                    <p>Subtotal R$: $sub,00</p>
                    <br>
                    <a href='carrinho.php?operacao=incluir&id=$codigoProduto' class='include' >Adicionar</a>
                    <a href='carrinho.php?operacao=excluir&id=$codigoProduto' class='remove'>Excluir</a>
                    </div>
                  </div>";
            }

            // calcula o total e mostra junto com o status da compra     
            $total = ValorSQL($conn, "select sum (tbl_produto.vlr * tbl_compra_produto.quantidade) from tbl_produto inner join tbl_compra_produto on 
            tbl_produto.id_produto = tbl_compra_produto.fk_produto where tbl_compra_produto.fk_compra = $codigoCompra");
            // se o login foi obtido (se esta logado), mostra link 'fechar carrinho' 

              if($codigoCompra==0)
              {
                echo "<h1 class='margem-titulo'>Seu carrinho está vazio</h1>";
              }else{
                if (isset($login)) {
                    if ($statusCompra == 'Pendente' && $login <> '') {
                      echo"<div class='subtotal cf'>
                              <ul>
                                <li class='totalRow'><span class='label'>Satus da compra</span><span class='value'>$statusCompra</span></li>
                                <li class='totalRow final'><span class='label'>Total R$: </span><span class='value'>$total,00</span></li>
                                <li class='totalRow'><a href='confirmaCompra.php?total=$total' class='btn'>Finalizar compra</a></li>
                                <br><br><br><br><br>
                                <li class='totalRow'><a href='carrinho.php?operacao=apagar&id=0' class= 'btn-home'>Limpar o carrinho</a></li>
                                <br><br><br><br><br>
                                <li class='totalRow'><a href='index.php' class='btn-home'>Voltar ao home</a></li>
                              </ul>
                          </div>";
                          } 
                        } 
                      }

            ?>
          </div>
    </div>
  </div>
  <a href='carrinho.php' class='btn-buy'>Voltar ao Topo</a>

  <!--Footer-->
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
            <li><a href="#">Opções de pagamento: Fichas</a></li>
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
