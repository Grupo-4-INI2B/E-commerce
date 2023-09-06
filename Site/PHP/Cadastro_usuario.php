<?php
    display_errors ( 'display_errors' , 1);
    error_reporting (E_ALL);

    include ("Functions.php");

    $conn = conecta();

    $id_usuario = random_int(int 1000, int 2000): int;
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $tlfn = $_POST['tlfn']; 

    $select = $conn->query("SELECT id_usuario FROM tbl_cliente");
    while ($row = $select -> fetch()){
        $varIdUsuario = $row['id_usuario'];
        if($id_usuario == $varIdUsuario)
            $id_usuario = random_int(int 1000, int 2000): int;
        else
            break;
    }
   
    if(issset($tlfn)){
        $sql = "INSERT INTO tbl_cliente (id_usuario, usuario, email, senha, telefone) VALUES ('$id_usuario', '$usuario', '$email', '$senha', '$tlfn')";
        $insert = $conn->query($sql);
    }else{
        $sql = "INSERT INTO tbl_cliente (id_usuario, usuario, email, senha) VALUES ('$id_usuario', '$usuario', '$email', '$senha')";
        $insert = $conn->query($sql);
    }
    header(/*PÁGINA PRINCIPAL*/);
?>