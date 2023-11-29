<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
include("../PHP/funcoes.php");

$conn = conecta();

if (!$_SESSION['adm']) { // Se não está logado ou não é administrador
    header("Location: index.php");
    exit();
}

$hoje = date('Y-m-d');
$ontem = date('Y-m-d', strtotime('-1 day', strtotime($hoje)));

if ($_POST) {
    $conn = conecta();

    $datai = $_POST['datai'];
    $dataf = $_POST['dataf'];

    $HTML = isset($_POST['HTML']) ? 'S' : 'N';
    $preVisualizacao = isset($_POST['preVisualizacao']) ? 'I' : 'D';

    $SQLCompra = "SELECT tbl_compra.id_compra, tbl_compra.data_compra, tbl_usuario.nome_usuario,
        SUM(tbl_compra_produto.quantidade * tbl_produto.vlr) total FROM tbl_compra
        INNER JOIN tbl_usuario ON tbl_compra.fk_usuario = tbl_usuario.id_usuario
        INNER JOIN tbl_compra_produto ON tbl_compra_produto.fk_compra = tbl_compra.id_compra
        INNER JOIN tbl_produto ON tbl_produto.id_produto = tbl_compra_produto.fk_produto
        WHERE tbl_compra.data_compra >= :datai AND tbl_compra.data_compra <= :dataf AND
        tbl_compra.status = 'Concluida'
        GROUP BY tbl_compra.id_compra, tbl_compra.data_compra, tbl_usuario.nome_usuario
        ORDER BY tbl_compra.data_compra";

    $SQLItensCompra = "SELECT tbl_produto.nome_produto, tbl_produto.descricao, tbl_compra_produto.quantidade, tbl_produto.vlr,
        tbl_compra_produto.quantidade * tbl_produto.vlr subtotal
        FROM tbl_compra_produto
        INNER JOIN tbl_produto ON tbl_produto.id_produto = tbl_compra_produto.fk_produto
        WHERE tbl_compra_produto.fk_compra = :id_compra
        ORDER BY tbl_produto.descricao";

    setlocale(LC_ALL, 'pt_BR.utf-8');

    $html = "<html>";

    $compra = $conn->prepare($SQLCompra);
    $compra->bindParam(':datai', $datai, PDO::PARAM_STR);
    $compra->bindParam(':dataf', $dataf, PDO::PARAM_STR);

    $compra->execute();

    $itens_compra = $conn->prepare($SQLItensCompra);

    $html .= "<head><meta charset='UTF-8' />
              <meta name='viewport' content='width=device-width, initial-scale=1.0' />
              <title>Byte Craft - Relatório</title>
              <link rel='stylesheet' href='../CSS/relatorio.css' /></head>";


    while ($linha_compra = $compra->fetch()) {
        $cod_compra = sprintf('%03s', $linha_compra['id_compra']);
        $data = $linha_compra['data_compra'];
        $cliente = $linha_compra['nome_usuario'];
        $total = number_format($linha_compra['total'], 2, ',', '.');
        $html .= "<body><table>
                <br>
                <tr><th colspan='4'>Comprador</th></tr>
                <tr>
                <td style='background-color:#F6BE00'>Id</td>
                <td style='background-color:#F6BE00'>Data</td>
                <td style='background-color:#F6BE00'>Nome</td>
                <td style='background-color:#F6BE00'>Total</td>
              </tr>";
        $html .= "<tr><td>$cod_compra</td><td>$data</td><td>$cliente</td><td>$total</td></tr>";

        $itens_compra->bindParam(':id_compra', $linha_compra['id_compra'], PDO::PARAM_INT);
        $itens_compra->execute();

        $html .= "<tr><th colspan='4'>Produtos</th></tr>
                  <tr>
                    <td style='background-color:#F6BE00'>Produto</td>
                    <td style='background-color:#F6BE00'>Quantidade</td>
                    <td style='background-color:#F6BE00'>Valor Unitário</td>
                    <td style='background-color:#F6BE00'>Subtotal</td>
                  </tr>
                  <tr><hr></tr>";

        while ($linha_itens_compra = $itens_compra->fetch()) {
            $produto = $linha_itens_compra['nome_produto'];
            $qtd = $linha_itens_compra['quantidade'];
            $unit = number_format($linha_itens_compra['vlr'], 2, ',', '.');
            $subtotal = number_format($linha_itens_compra['subtotal'], 2, ',', '.');

            $html .= "<tr><td>$produto</td><td>$qtd</td><td>$unit</td><td>$subtotal</td></tr>";
        }
    }

    $html .= "</table></body></html>";

    if ($HTML == 'S') {
        echo $html;
    } else {
        if (CriaPDF("Relatorio de Vendas", $html, "$hoje.pdf", $preVisualizacao)) {
            echo 'Gerado com sucesso';
        } else {
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
    <title>Byte Craft - Relatório</title>
    <link rel="stylesheet" href="../CSS/relatorio.css" />
</head>

<body>
    <form action='' method='POST'>
        Data inicial<br><input type='date' name='datai'><br>
        Data final<br><input type='date' name='dataf'><br>
        Imprimir na tela?<input type='radio' name='HTML'><br>
        Pré-vizualização do pdf?<input type='checkbox' name='preVisualizacao'><br>
        <a href="relatorio.php" class="limpar">Limpar Campos</a><br>
        <input type='submit' value='Gerar'>
    </form>
    
</body>

</html>
