


<!DOCTYPE html>
<html lang="pt-BR">    
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Byte Craft - Confirmação de compra</title>
    <link rel="stylesheet" href="../CSS/Perfil.css">
    <link rel="stylesheet" href="../CSS/confirmaCompra.css">

</head>


<body>
    <form name="frmLogin" method="post" action="../PHP/Login_usuario.php">
    <div class="main-login">
        <div class="login-container">

            <div class="left-login">
                <img src="../Imagens/logocaixinhabranco.svg">

                <h1>Confirmação de compra!<br></h1>
                <h3>Quase lá...</h3>
            </div>
            <div class="right-login">
                <div class="card-login">
                <?php
                   $total = $_GET['total'];
                   echo "<p>Total a ser pago em fichas: R$$total,00</p>
                    <a class='btn' href='carrinho.php?operacao=fechar&id=0'>Finalizar compra</a>
                    <br><br>
                    <a class='btn' href='index.php'>Voltar ao home</a>";
                ?>
                </div>
            </div>
        </div>
    </div>
</form>
</body>

</html>

