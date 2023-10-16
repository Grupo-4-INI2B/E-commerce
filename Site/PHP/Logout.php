<?php

   ini_set ('display_errors', 1);
   error_reporting (E_ALL);
   session_start();

   unset($_SESSION['sessaoUsuario']); 
 
   header('Location: ../HTML_CSS/HTML/index.php');
?>