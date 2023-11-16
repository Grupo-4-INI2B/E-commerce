<?php 
  ini_set('display_errors', 1);
  error_reporting(E_ALL);
  session_start();
  include("../PHP/funcoes.php");

  $conn = conecta();

  if(!$_SESSION['adm']){ // Se não está logado ou não é administrador 
    header("Location: index.php");
    exit();
  }

  // calcula hoje
  $hoje = date('Y-m-d');
  // calcula ontem
  $ontem = date('Y-m-d', (strtotime ('-1 day' , strtotime ( $hoje ) )));

  if ($_POST) {
    // faz conexao 
    $conn = conecta();

    $datai = $_POST['datai'];
    $dataf = $_POST['dataf'];
    if(isset($_POST['HTML'])){
      $HTML = 'S';
    }else {
      $HTML = 'N';
    }


    if(isset($_POST['preVisualizacao'])){
      $preVisualizacao = 'I';
    }else{
      $preVisualizacao = 'D';
    }

    $SQLCompra = 
            "SELECT tbl_compra.id_compra, tbl_compra.data_compra, tbl_usuario.nome_usuario,
            SUM ( tbl_compra_produto.quantidade * tbl_produto.vlr ) total FROM tbl_compra
            INNER JOIN tbl_usuario ON tbl_compra.fk_usuario = tbl_usuario.id_usuario
            INNER JOIN tbl_compra_produto ON tbl_compra_produto.fk_compra = tbl_compra.id_compra
            INNER JOIN tbl_produto ON tbl_produto.id_produto = tbl_compra_produto.fk_produto
            WHERE tbl_compra.data_compra >= :datai AND tbl_compra.data_compra <= :dataf AND
            tbl_compra.status = 'Concluida'
            GROUP BY tbl_compra.id_compra, tbl_compra.data_compra, tbl_usuario.nome_usuario
            ORDER BY tbl_compra.data_compra"; 

    $SQLItensCompra = 
              "SELECT tbl_produto.nome_produto, tbl_produto.descricao, tbl_compra_produto.quantidade, tbl_produto.vlr,
              tbl_compra_produto.quantidade * tbl_produto.vlr subtotal
              FROM tbl_compra_produto
              INNER JOIN tbl_produto ON tbl_produto.id_produto = tbl_compra_produto.fk_produto
              WHERE tbl_compra_produto.fk_compra = :id_compra
              ORDER BY tbl_produto.descricao"; 

    // formata valores em reais 
    setlocale(LC_ALL, 'pt_BR.utf-8');

    $html = "<html>";

    // abre a consulta de COMPRA do periodo
    $compra = $conn->prepare($SQLCompra);
    $compra->bindParam(':datai', $datai, PDO::PARAM_STR);
    $compra->bindParam(':dataf', $dataf, PDO::PARAM_STR);

    $compra->execute();
    // prepara os ITENS     
    $itens_compra = $conn->prepare($SQLItensCompra);


      
    // fetch significa carregar proxima linha
    // qdo nao tiver mais nenhuma retorna FALSE pro while
    
    /////////////  M E S T R E ////////////////////   
    // carrega a proxima linha COMPRA

    $html .= "<br><br>
              <b>".
                sprintf('%3s', 'Id').
                sprintf('%12s','Data').
                sprintf('%50s','Nome').
                sprintf('%10s','$ tot').
              "</b>
              <br>";

    while ($linha_compra = $compra->fetch()) {
      $cod_compra = sprintf('%03s', $linha_compra['id_compra']);
      $data       = sprintf('%12s', $linha_compra['data_compra']);
      $cliente    = sprintf('%50s', $linha_compra['nome_usuario']);
      $total      = sprintf('%10s', number_format($linha_compra['total'], 2, ',', '.'));
        
      $html .= $cod_compra . $data . $cliente . $total . "<br>";               
      
      $itens_compra->bindParam(':id_compra', $linha_compra['id_compra'], PDO::PARAM_INT);
      // executa ITENS passando o codigo da COMPRA atual
      $itens_compra->execute();

      $html .= "<b>".
              sprintf('%20s','Prod').
              sprintf('%5s','Qtd').
              sprintf('%10s','$ unit').
              sprintf('%10s','$ sub').
              "</b><br>";

      /////////////  D E T A L H E  ////////////////////
      // carrega a proxima linha ITENS_COMPRA
      while ($linha_itens_compra = $itens_compra->fetch()) {
        $produto  = sprintf('%20s', $linha_itens_compra['descricao']);
        $qtd      = sprintf('%5s', $linha_itens_compra['quantidade']);
        $unit     = sprintf('%10s', number_format($linha_itens_compra['vlr'], 2, ',', '.'));
        $subtotal = sprintf('%10s', number_format($linha_itens_compra['subtotal'], 2, ',', '.'));

        $html .= $produto . $qtd . $unit . $subtotal . "<br>";
      } 
    }

    $html.="</html>";

    if($HTML == 'S'){
      echo $html;
    }else{

      if (CriaPDF ("Relatorio de Vendas", $html, "$hoje.pdf", $preVisualizacao))  {
        echo 'Gerado com sucesso';
      }else {
        echo 'Erro ao gerar';
      }

      header("Location: $hoje.pdf");
    }
  }
?>

<!DOCTYPE html>
<html lang="pt-BR">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Byte Craft - Relátorio</title>
    <link rel="stylesheet" href=""/>
  </head>

  <body>
    <form action='' method='POST'>
      Data inicial<br><input type='date' name='datai'><br>
      Data final<br><input type='date' name='dataf'><br>
      Imprimir na tela?<input type='radio' name='HTML'><br>
      Pré-vizualização?<input type='checkbox' name='preVisualizacao'><br>
      <input type='submit' value='Gerar'>
    </form>;
  </body>

</html>