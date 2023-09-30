<?php
    display_errors ('display_errors', 1);
    error_reporting (E_ALL);

    include ("Functions.php");

    $conn = conecta();

    $id_produto = $_POST['id_produto'];
    $quantidade = $_POST['quantidade'];
?>