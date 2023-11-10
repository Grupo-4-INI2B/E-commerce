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
     ini_set ('display_errors', 1);
     error_reporting (E_ALL);
     session_start();
     include ("../PHP/funcoes.php");
 
    if(!$_SESSION['adm']){ // Se não está logado ou não é administrador 
      header("Location: index.php");
      exit();
    }

    crud();
  ?>
  </table>
</body>

</html>