<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <link rel="stylesheet" href="../CSS/crud.css">
  <link rel="icon" href="../Imagens/logocaixinha.svg">
</head>

<body>

  <?php
    if(!isset($_SESSION['sessaoUsuario']) || $_SESSION['adm'] == false) { // Se não está logado ou não é administrador 
      header("Location: ../HTML/Login.php");
      exit();
    }

    include("../PHP/Funcoes.php");
    crud();
  ?>
  </table>
</body>

</html>