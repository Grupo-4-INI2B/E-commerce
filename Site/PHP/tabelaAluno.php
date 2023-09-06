<?php
    ini_set ( 'display_errors' , 1); 
    error_reporting (E_ALL); 

    include("Funcoes.php");

    $conn = conecta("pgsql:host=localhost; dbname=turma72b; user=mcperes; password=ct1ct1");
    $seunome = "heitor";
    $select = $conn->query("SELECT * FROM $seunome ORDER BY nome_aluno");
       
    echo"<h1>Tabela de alunos</h1>";

    echo"
    <table border = '2'>
        <tr>
            <th> Número de chamada   </th>
            <th> Nome                </th>
            <th> Número de matrícula </th>
        </tr>    
    ";

    while ($row = $select -> fetch()){
        $varId = $row['id_chamada'];
        $varNome = $row['nome_aluno'];
        $varMtc = $row['matricula']; 

        echo"
                <tr>
                    <td> 
                        <a href = 'formAluno.php?id_chmd=$varId'> $varId </a>  
                    </td>
                    <td> $varNome </td>
                    <td> $varMtc </td>
                </tr>
            ";
    }

    echo "</table>";

    unset($conn);
?>