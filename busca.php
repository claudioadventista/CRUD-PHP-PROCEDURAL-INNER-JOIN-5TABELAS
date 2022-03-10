<?php

require_once 'conexao.php';


    
   
 

   if(isset($_POST['busca'])){
        $busca = $_POST['busca'];
        $sql = mysqli_query($conexao,"SELECT *  FROM cliente WHERE  nome LIKE '%$busca%' OR cpf LIKE '%$busca%' OR barra LIKE '%$busca%' ");     
        $num = mysqli_num_rows($sql);

        if($num >0){
            $cont = 1;
            echo "Total ".$num.'<br>';
            while($linha = mysqli_fetch_array($sql)) { 
                echo $cont;
                echo " Nome ".$linha['nome'].'<br>';
                $cont ++;
            }
        }else{
            echo "nada encontrado";
        }

   }
	