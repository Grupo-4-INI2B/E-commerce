<?php
  function conecta ($params) {
    $varConn = new PDO($params);
    if (!$varConn) {
      echo "Não foi possível conectar, por favor contatar "; 
    } else { 
      return $varConn; 
    }
  }

  function DefineCookie($paramNome, $paramValor, $paramMinutos) {
    setcookie($paramNome, $paramValor, time() + $paramMinutos * 60); 
  }
?>