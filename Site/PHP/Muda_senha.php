<?php
    
ini_set ( 'display_errors' , 1);    error_reporting (E_ALL);
    
    include ("Funcoes.php");
    $conn = conecta();
    
    $email = $_POST['email'];
    $codigo = $_POST['codigo'];
    $paramCodigo = $_POST['codigo'];

    if($paramCodigo == $codigo) {
        $update  = ("UPDATE tbl_usuario SET senha = $senha WHERE email = $email");
        $conn->query($update);
        header("Location: ../../HTML_CSS/HTML/index.php");
    }
?>

<!DOCTYPE html>
<html>
</html>