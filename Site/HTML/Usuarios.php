<?php
    ini_set ('display_errors', 1);
    error_reporting (E_ALL);
    session_start();
    include ("../PHP/Funcoes.php");
    $conn = conecta();

    if(!$_SESSION['sessaoUsuario'] || $_SESSION['adm'] == false){ // Se não está logado ou não é administrador 
        header("Location: index.php");
        exit();
    }

    $select = $conn->query("SELECT * FROM tbl_usuario ORDER BY id_usuario");
       
    echo"<h1>Tabela de usuarios</h1>";

    echo"
    <a href='Perfil.php'>Voltar</a>
    <table border = '2'>
        <tr>
            <th> id de usuario </th>
            <th> Nome          </th>
            <th> Email         </th>
            <th> Telefone      </th>
            <th> Senha         </th>
            <th> Administrador </th>
        </tr>    
    ";

    while ($row = $select -> fetch()){
        if($row['excluido'] == false) { 
            $varId     = $row['id_usuario'];
            $varNome   = $row['nome_usuario'];
            $varEmail  = $row['email'];
            $varTlfn   = $row['telefone'];
            $senha     = $row['senha'];
            $varAdm    = $row['adm'];

            echo"
                    <tr>
                        <td> $varId    </td>
                        <td> $varNome  </td>
                        <td> 
                            <a href='mailto:$varEmail'> $varEmail </a> 
                        </td>
                        <td> $varTlfn  </td>
                        <td> $senha    </td>
                        <td> $varAdm   </td>
                        <td>
                            <a href = 'alterarUsuario.php?id_usuario=$varId'> <img src='../Imagens/alterar.png' alt='Sorry'  width='30'/> </a> 
                            <a href = 'Excluir_usuario.php?id_usuario=$varId'> <img src='../Imagens/excluir.png' alt='Sorry'  width='30'/> </a> 
                        </td>
                    </tr>
                ";
        }
    }
    echo "</table>";

    unset($select);    
    unset($conn);
?>
