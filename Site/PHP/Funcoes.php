<?php
  function conecta ($params) {
    $varConn = new PDO($params);
    if (!$varConn) {
      echo "Não foi possível conectar, por favor contatar "; 
    } else { 
      return $varConn; 
    }
  }

  function funcaoLogin($paramEmail, $paramSenha, $paramAdm) {
    $conn = conecta();
    $select = $conn->query("SELECT (senha, adm) FROM tbl_usuario WHERE email = $paramEmail");
    $linha = $select->fetch();
    $varSenha = $linha['senha'];
    $varAdm = $linha['adm'];

    return ();
  }

  function DefineCookie($paramNome, $paramValor, $paramMinutos) {
    setcookie($paramNome, $paramValor, time() + $paramMinutos * 60); 
  }
?>