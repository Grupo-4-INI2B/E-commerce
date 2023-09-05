<?php
    function conecta ($params = "") 
    {
      if ($params == "") {
        $params = "pgsql:host=pgsql.projetoscti.com.br; dbname=projetocti25z; user=projetocti25; password=721492";
      }

      $varConn = new PDO($params);
      
      if (!$varConn) {
        echo "Não foi possível conectar";
      } else { return $varConn; }
    }

    function nomeToupper($no){
      $nov = " ";
      for($i = 1; $i <= strlen($no); $i++){
        $n = substr($no, $i-1, 1); //Posição anterior
        $x = substr($no, $i, 1); //Posição
        if($i == 1 /*Prenome*/){
          $nov .= strtoupper($n);
        }
        if($n == " " /*Sobrenome*/){
            if($x == "d" || $x == "D"){
              $nov .= strtolower($x);
            }else{$nov .= strtoupper($x);}
        }else{$nov .= strtolower($x);}
      }
      return $nov;
    }

    function varHTML($nom, $id, $id_chmd, $nome, $mtcl, $dtanas, $email){
      echo"
        <form action='$nom' method='post'>
          <fieldset style='width: 100px;'>
            Seu nome: <input type='text' placeholder='nome' name='nome_aluno' value='$nome'><br><br>
            Seu núm. de chamada: <input type='text' placeholder='Número da chamada' name='id_chamada' value='$id'><br><br>
            Num. da matrÍcula: <input type='text' placeholder='Matrícula' name='matricula' value='$mtcl'><br><br>
            Sua dta de nascimento: <input type='text' placeholder='DTA_NAS' name='dta_nas' value='$dtanas'><br><br>
            Seu email: <input type='email' placeholder='EMAIL' name='email' value='$email'><br><br>
        ";
      if($id_chmd <> ""){
        echo"
              <input type='hidden' name='id_ant' value='$id_chmd'><br><br> 
              <input type='submit' value='Salvar' name='submit'><br><br> 
            </fieldset>
          </form>
        ";
      }else{
        echo"
              <input type='submit' value='Salvar' name='submit'><br><br>
            </fieldset>
          </form>";  
      }  
    }
?>