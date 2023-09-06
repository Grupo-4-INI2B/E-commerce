<?php
    ini_set ( 'display_errors' , 1); 
    error_reporting (E_ALL); 

    include("Funcoes.php");

    $conn = conecta("pgsql:host=localhost; dbname=turma72b; user=mcperes; password=ct1ct1");
      
    $row = [
        'id_chmd' => $_POST['id_chmd'],
        'nome_aluno' => $_POST['nome_aluno'],
        'matricula' => $_POST['matricula'],
        'ant' => $_POST['id_ant']
    ];
    
    $update = $conn->prepare('UPDATE heitor SET id_chamada = :id_chmd, nome_aluno = :nome_aluno, matricula = :matricula WHERE id_chamada = :ant');
    $update->execute($row);
    
    header('Location: tabelaAluno.php');

    unset($update);
    unset($conn);
?>