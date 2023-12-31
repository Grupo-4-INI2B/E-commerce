<?php
  //Função para conectar ao banco de dados
  function conecta () {
    $varConn = new PDO("pgsql:host=pgsql.projetoscti.com.br; dbname=projetoscti25; 
    user=projetoscti25; password=721492");
    if (!$varConn) {
      echo "Não foi possível conectar, por favor contatar "; 
    } else { 
      return $varConn; 
    }
  }

  //Funções para definir cookie e sessão
  function defineCookie($paramNome, $paramValor, $paramMinutos) {
    setcookie($paramNome, $paramValor, time() + $paramMinutos * 60); 
  }

  function defineSessao($nomeSessao ,$paramEmail) {
    session_start();
    $_SESSION[$nomeSessao] = $paramEmail;
  }

  //Funções para verificação de credenciais
  function verificaUser($paramSenha, $paramEmail)
  {
    $conn = conecta();
    $select = $conn->prepare("SELECT * FROM tbl_usuario WHERE email = :email AND senha = :senha AND excluido = false");
    $select->execute(['email' => $paramEmail, 'senha' => $paramSenha]);
    $row = $select->fetch();
    if($row) {
      defineSessao("sessaoUsuario", $paramEmail);
      $_SESSION['adm'] = $row['adm'];
      $_SESSION['email'] = $paramEmail;
      $_SESSION['nome'] = $row['nome_usuario'];
      $_SESSION['id_usuario'] = $row['id_usuario'];
      
      return true;
    } 
    return false;
  }

  function verificaEmail($paramEmail) {
    $conn = conecta();
    $select = $conn->query("SELECT email FROM tbl_usuario");
    while($row = $select->fetch()){
      $varEmail = $row['email'];
      if($paramEmail == $varEmail){
        return true;
      }
    }
    return false;
  }

  //Função de cabeçalho
  function cabecalho($sessaoUsuario, $nome, $adm) {
    if(!isset($sessaoUsuario)) {
      echo "<a class='botao-perfil' href='login.php' class='cart' style='color: #000000'>
      <img src='../Imagens/IconPerson.svg' alt='Ícone de Usuário' width='15' height='15' 
      style='position: relative; top: 2px;  font-size:20px;'>Entrar</a>";
    } else if(!$adm) {        
       echo "<a class='botao-perfil' href='perfil.php' class='cart' style='color: #000000'>
       <img src='../Imagens/IconPerson.svg' alt='Ícone de Usuário' width='15' height='15' 
       style='position: relative; top: 2px;   font-size:10px;'>Bem vindo, $nome</a>";
    } else  {
      echo "<a class='botao-perfil' href='perfil.php' class='cart' style='color: #000000'>
      <img src='../Imagens/IconPerson.svg' alt='Ícone de Usuário' width='15' height='15' 
      style='position: relative; top: 2px;  font-size:10px;'>Bem vindo administrador</a>";
    }
}
  //Função para envio de email
  //As referencias a outros arquivos deve ser feita de maneira global, 
  //ou seja, fora da função
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  use PHPMailer\PHPMailer\SMTP;
  function enviaEmail($pDestinatario, $pNome, $pAssunto, $pHtml) {
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/SMTP.php';
   
    //Variaveis de configuração do email(DEVE SER ALTERADO)
    $pRemetente = "bytecraft@projetoscti.com.br";
    $pSenha = "Byte#craft2023";
    $pSMTP = "smtp.projetoscti.com.br";

    //Configuração do PHP, para exibir erros
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    
    try {
      $mail = new PHPMailer(); //Instancia a classe PHPMailer
      
      //Configuração do servidor de email
      $mail->IsSMTP(); //Define que a mensagem será SMTP
      $mail->Host = $pSMTP; //Endereço do servidor SMTP
      $mail->SMTPAuth = true; //Autenticação SMTP    
      $mail->SMTPSecure = 'tls'; //Tipo de segurança
      $mail->Port = 587; //Porta de comunicação SMTP
      $mail->Username = $pRemetente; //Usuário do servidor SMTP
      $mail->Password = $pSenha; //Senha do servidor SMTP
      $mail->SMTPDebug = 2; //Habilita o debug do SMTP
      $mail-> SMTPOptions = array (
      'ssl' => array (
      'verificar_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true )); //Permite que o PHPMailer aceite certificados SSL não confiáveis

      //Configuração dos emails do remetente e do destinatário
      $mail->setFrom($pRemetente, 'ByteCraft'); //email do remetente
      $mail->addReplyTo($pUsuario); //Email para respossta, caso não queira que o usuário responda, coloque no.reply@...
      $mail->addAddress($pDestinatario, $pNome); //email do destinatário

      //Conteúdo do email
      $mail->IsHTML(true); //Se o email vai ser em HTML ou não 
      $mail->Subject = $pAssunto; //O assunto do email
      $mail->Body = $pHtml; //O conteúdo(corpo) do email em HTML
      $mail->CharSet = 'UTF-8'; //Codificação do email
      $mail->AltBody = 'seu email nao suporta html'; //Uma mensagem avisando destinatário que o seu email não suporta HTML
      $enviado = $mail->Send(); //Envia o email
      
      //Verifica se o email foi enviado
      if ($enviado) {
        echo "E-mail enviado com sucesso!";
      } else {
        echo "Não foi possível enviar o e-mail.";
        echo "<b>Informações do erro:</b> " . $mail->ErrorInfo;
      }

      //Execeções da biblioteca PHPMailer e do PHP(Instaciamento da classe exception)
    } catch (Exception $e) {
      echo $e->errorMessage(); //mensagens de erro do PHPMailer 
    } catch (\Exception $e) {
      echo $e->getMessage(); //mensagens de erro do PHP
    }
}

//Função para gerar PDF
function CriaPDF ($paramTitulo, $paramHtml, $paramArquivoPDF) {
  $arq = false;     
  try {  
    require "fpdf/html_table.php"; 
    // abre classe fpdf estendida com recurso que converte <table> em pdf
  
    $pdf = new PDF();  
    // cria um novo objeto $pdf da classe 'pdf' que estende 'fpdf' em 'html_table.php'
    $pdf->AddPage();  // cria uma pagina vazia
    $pdf->SetFont('helvetica','B',20);       
    $pdf->Write(5,$paramTitulo);    
    $pdf->SetFont('helvetica','',8);     
    $pdf->WriteHTML($paramHtml); // renderiza $html na pagina vazia
    ob_end_clean();    
    // fpdf requer tela vazia, essa instrucao 
    // libera a tela antes do output
    
    // gerando um arquivo 
    $pdf->Output($paramArquivoPDF,'F');
    // gerando um download 
    $pdf->Output('D',$paramArquivoPDF);  // disponibiliza o pdf gerado pra download
    $arq = true;
  } catch (Exception $e) {
    echo $e->getMessage(); // erros da aplicação - gerais
  }
  return $arq;
}




/*
* Função para executar frases sql
* marcelo c peres - 2023 
*/
  /*
  * Funçãoo para ExecutaSQL frases sql
  * marcelo c peres - 2023
  */

  function ExecutaSQL( $paramConn, $paramSQL ) 
  {

    $linhas = $paramConn->exec($paramSQL);
  
    if ($linhas > 0) { 
        return TRUE; 
    } else { 
        return FALSE; 
    }  
  }

  /*
  * Função para executasql frases sql
  * marcelo c peres - 2023
  */

  function ValorSQL($pConn, $pSQL) 
  {
   $linhas = $pConn->query($pSQL)->fetch();
  
   if ($linhas > 0) { 
       return $linhas[0]; 
   } else { 
       return "0"; 
   }  
  }


   
/*
* Função para gerar senhas aleatórias
*
* @author    Thiago Belem <contato@thiagobelem.net>
*
* @param integer $tamanho Tamanho da senha a ser gerada
* @param boolean $maiusculas Se terá letras maiúsculas
* @param boolean $numeros Se terá números
* @param boolean $simbolos Se terá símbolos
*
* @return string A senha gerada
*/
  function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false) {
    //$lmin = 'abcdefghijklmnopqrstuvwxyz';
    $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $num = '1234567890';
    $simb = '!@#$%*-';
    $retorno = '';
    $caracteres = '';

    //$caracteres .= $lmin;
    if ($maiusculas) $caracteres .= $lmai;
    if ($numeros) $caracteres .= $num;
    if ($simbolos) $caracteres .= $simb;

    $len = strlen($caracteres);
    for ($n = 1; $n <= $tamanho; $n++) {
    $rand = mt_rand(1, $len);
    $retorno .= $caracteres[$rand-1];
    }
    return $retorno;
  }

  function crud()
  {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    $conn = conecta();
    $query = "SELECT * FROM tbl_produto ORDER BY id_produto ASC";
    $result = $conn->query($query);

    if ($result) {
      echo "<table id='tabela'>";
      echo "<tr>";
      echo "<th>ID</th>";
      echo "<th>Nome</th>";
      echo "<th>Descrição</th>";
      echo "<th>Valor</th>";
      echo "<th>Código Visual</th>";
      echo "<th>Custo</th>";
      echo "<th>Margem de Lucro</th>";
      echo "<th>ICMS</th>";
      echo "<th>Quantidade</th>";
      echo "<th>Imagem</th>";
      echo "<th>Excluido</th>";
      echo "<th>Data de Exclusão</th>";
      echo "<th colspan='3'>Ações</th>";
      echo "</tr>";

      if ($result->rowCount() > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
          
          $id_produto = $row['id_produto'];
          $nome_produto = $row['nome_produto'];
          $descricao = $row['descricao'];
          $excluido = $row['excluido'];
          $vlr = $row['vlr'];
          if($row['dta_exclusao'] != null)
          {
            $data_exclusao = $row['dta_exclusao'];
          }
          else
          {
            $data_exclusao = "Não excluido";
          }
          
          $id_visual = $row['id_visual'];
          $custo = $row['custo'];
          $margem_lucro = $row['margem_lucro'];
          $icms = $row['icms'];
          $quantidade = $row['qntd'];
          $imagem=$row['imagem'];

          echo "<tr>";
          echo "<td>" . $id_produto . "</td>";
          echo "<td>" . $nome_produto . "</td>";
          echo "<td>" . $descricao . "</td>";
          echo "<td>" . $vlr . "</td>";
          echo "<td>" . $id_visual . "</td>";
          echo "<td>" . $custo . "</td>";
          echo "<td>" . $margem_lucro . "</td>";
          echo "<td>" . $icms . "</td>";
          echo "<td>" . $quantidade . "</td>";
          echo "<td> <img src='$imagem' alt='Sumiu' widht='150px' height='100px'> </td>";
          echo "<td>" . $excluido . "</td>";
          echo "<td>" . $data_exclusao . "</td>";
          echo "<td><a href='../HTML/formAdicionar.php?acao=adicionar'><img src='../Imagens/Adicionar.png' alt='Adicionar' width='30'></a></td>";
          echo "<td><a href='../PHP/deletarProduto.php?id=" . $id_produto . "&acao=excluir'><img src='../Imagens/X_vermelho.png' alt='Excluir' width='30'></a></td>";
          echo "<td><a href='../PHP/Form_alterarProduto.php?id=" . $id_produto . "&acao=alterar'><img src='../Imagens/Alterar.png' alt='Alterar' width='30'></a></td>";
          echo "</tr>";
      }

      echo "</table>";
  } else {
      echo "<p>Nenhum registro encontrado.</p>";
  }

  } else {
    echo "Erro ao executar a query.";
  }
  }

  /*Função para destruir cookie e sessão 
  Fonte: http://php.net/manual/pt_BR/function.session-destroy.php
  via https://pt.stackoverflow.com/questions/241268/como-destruir-todas-as-sessõ<es-do-php></es-do-php>
  */
  function destroiCookieSessao() {
    // Inicializa a sessão.
    // Se estiver sendo usado session_name("something"), não esqueça de usá-lo agora!
    session_start();
    
    // Apaga todas as variáveis da sessão
    $_SESSION = array();
    
    // Se é preciso matar a sessão, então os cookies de sessão também devem ser apagados.
    // Nota: Isto destruirá a sessão, e não apenas os dados!
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        ); 
    }
    
    // Por último, destrói a sessão
    session_destroy();
  }
 
?>
