<?php
    ini_set ( 'display_errors' , 1); 
    error_reporting (E_ALL);
 
    include("Funcoes.php");

    $conn = conecta("pgsql:host=localhost; dbname=turma72b; user=mcperes; password=ct1ct1");
    $seunome = "heitor";

    $id_chmd = $_GET['id_chmd'];

    $select = $conn->query("SELECT * FROM $seunome WHERE id_chamada = $id_chmd")->fetch();

    $id = $select['id_chamada'];
    $nome = $select['nome_aluno'];
    $matricula =$select['matricula'];

    $varHTML = "
        <form action='salvarDados.php' method='post'>
            <br>Id<br>
            <input type='text' name='id_chmd' value='$id'>
            <br>Nome<br>
            <input type='text' name='nome_aluno' value='$nome'>
            <br>Matricula<br>
            <input type='text' name='matricula' value='$matricula'>
            <input type='hidden' name='id_ant' value='$id_chmd'>
            <input type='submit' value='Salvar'>
        </form>
    ";
     
   echo $varHTML;

   unset($select);
   unset($conn);
?>