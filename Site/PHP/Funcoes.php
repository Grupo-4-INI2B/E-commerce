<?php
    function conecta ($params) 
    {
      $varConn = new PDO($params);
      if (!$varConn) {
          echo "Não foi possível conectar";
      } else { return $varConn; }
    }

    
?>