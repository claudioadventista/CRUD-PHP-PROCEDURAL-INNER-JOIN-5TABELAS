<?php

require_once 'conexao.php';
require_once 'funcoes.php';

// pega o horário atual
date_default_timezone_set('America/Sao_Paulo');

// função que gera a barra
function gera_barra(){
    $aray= mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9);
    return $aray;
    }

/******************************************************************************************    
 * 
 * 
 *                                    Cadastro Existente 
 * 
 *                                   
 ******************************************************************************************/

if((isset($_POST['submitCadastro']))AND($_POST['submitCadastro']=="EXISTENTE")){

   $codigo = $_POST['id_cliente'];
   // alteração na tabela cliente
   $telefone   = $_POST['telefone'];
   if((empty($_POST['telefone'])) AND (isset($_POST['telefone2']))){
       $telefone = $_POST['telefone2']; 
       $telefone2   = ''; 
   }else{
       $telefone2   = $_POST['telefone2'];    
   }
   $endereco   = $_POST['endereco'];
   $email      = $_POST['email'];
   $cpf        = $_POST['cpf2'];

    $id_aparelho    = $_POST['id_aparelho'];
    // cadastra um novo aparelho
    if((isset($_POST['novoAparelho']))AND($_POST['novoAparelho']<>"")){
        $novoAparelho = maiusculo($_POST['novoAparelho']);

        $sql = "INSERT INTO aparelho (nome_aparelho) VALUES ('$novoAparelho')";
        mysqli_query($conexao, $sql) or die('Error: '.mysqli_error($conexao));
        
        $buscaAparelho = mysqli_query($conexao, "SELECT id FROM aparelho WHERE nome_aparelho='$novoAparelho' ");
        $resultAparelho = mysqli_num_rows($buscaAparelho);

        // se retornar apenas um resultado, salva tudo o que foi pedido do novo cliente, só foi pedido o id
        if ($resultAparelho == 1) {
            $id_novoAparelho = mysqli_fetch_array($buscaAparelho);
            $id_aparelho = $id_novoAparelho['id'];
        };
    };

    $id_marca       = $_POST['id_marca'];
    // cadastra uma nova marca
    if((isset($_POST['novaMarca']))AND($_POST['novaMarca']<>"")){
        $novaMarca = maiusculo($_POST['novaMarca']);
        $sql = "INSERT INTO marca (nome_marca) VALUES ('$novaMarca')";
        mysqli_query($conexao, $sql) or die('Error: '.mysqli_error($conexao));

        $buscaMarca = mysqli_query($conexao, "SELECT id FROM marca WHERE nome_marca='$novaMarca' ");
        $resultMarca = mysqli_num_rows($buscaMarca);

        // se retornar apenas um resultado, salva tudo o que foi pedido do novo cliente, só foi pedido o id
        if ($resultMarca == 1) {
            $id_novaMarca = mysqli_fetch_array($buscaMarca);
            $id_marca = $id_novaMarca['id'];
        };

    };

    $id_defeito       = $_POST['id_defeito'];
    if((isset($_POST['novoDefeito']))AND($_POST['novoDefeito']<>"")){
        $novoDefeito = $_POST['novoDefeito'];

        $sql = "INSERT INTO defeito (nome_defeito) VALUES ('$novoDefeito')";
        mysqli_query($conexao, $sql) or die('Error: '.mysqli_error($conexao));
        
        $buscaDefeito = mysqli_query($conexao, "SELECT id FROM defeito WHERE nome_defeito='$novoDefeito' ");
        $resultDefeito = mysqli_num_rows($buscaDefeito);

        // se retornar apenas um resultado, salva tudo o que foi pedido do novo cliente, só foi pedido o id
        if ($resultDefeito == 1) {
            $id_novoDefeito = mysqli_fetch_array($buscaDefeito);
            $id_defeito = $id_novoDefeito['id'];
        };
    };

    // pega o valor do numero de cadastro do cliente para somar mais um
    $ssql = mysqli_query($conexao,"SELECT numeroCadastro FROM cliente WHERE  id = '$codigo'");
    $numCadastro = mysqli_fetch_array($ssql);
    $numeroCadastro = $numCadastro['numeroCadastro'] + 1;
    
    mysqli_query($conexao, "SET NAMES 'utf8';");
    $sql = "UPDATE cliente SET telefone='$telefone', telefone2='$telefone2', endereco='$endereco', email='$email', cpf='$cpf', numeroCadastro='$numeroCadastro'
    WHERE id='$codigo'"; 
    mysqli_query($conexao, $sql) or die('Error: '.mysqli_error($conexao)); 
   
    // cria um novo cadastro existente
    $ordemServico    = $_POST['ordemServico'];
    $id_cliente      = $_POST['id_cliente'];
    $id_estado       = $_POST['id_estado'];
    if(empty($_POST['dtEntrada'])){
        $dataEntrada = date("Y-m-d");
    }else{
        $dataEntrada = $_POST['dtEntrada'];
    };
    $modelo          = $_POST['modelo'];
    $numeroSerie     = $_POST['numeroSerie'];
    $defeito         = $_POST['defeito'];
    $dtPronto        = $_POST['dtPronto'];
    $acessorio       = $_POST['acessorio'];
    $dtSaida         = $_POST['dtSaida'];
    $observacao      = $_POST['observacao'];
    $material        = $_POST['material'];
    $orcamento       = $_POST['orcamento'];
    

    retornar:
    $barra           = gera_barra();
    // validação do código de barras
    // faz uma consulta para verificar se existe o codigo de barra gerado
    $buscaBarra = mysqli_query($conexao, "SELECT barra FROM cadastro WHERE barra='$barra' ");
    $resultadoes = mysqli_num_rows($buscaBarra);
    if ($resultadoes != 0) {
        // se existir, volta e gera outro codigo
        goto retornar;
    };

    //print_r($_POST);
    //exit;
    
    mysqli_query($conexao, "SET NAMES 'utf8';");
    $sql = "INSERT INTO cadastro (ordem_servico, id_cliente, id_aparelho, id_marca, id_estado, id_defeito, dataEntrada, 
    numeroSerie, modelo, defeitoReclamado, dataPronto, acessorio, dataSaida, obs, material, orcamento, barra ) 
    VALUES ('$ordemServico','$id_cliente','$id_aparelho','$id_marca','$id_estado','$id_defeito','$dataEntrada','$numeroSerie',
    '$modelo','$defeito','$dtPronto','$acessorio','$dtSaida','$observacao','$material','$orcamento','$barra')";
    mysqli_query($conexao, $sql) or die('Error: '.mysqli_error($conexao));
    header('Location:index.php');
    exit;
    
}

/******************************************************************************************    
 * 
 * 
 *                                    Novo Cadastro 
 * 
 *                                   
 ******************************************************************************************/

//if((isset($_POST['controle']))AND($_POST['controle']=="NOVO")){
if((isset($_POST['submitCadastro']))AND($_POST['submitCadastro']=="NOVO")){
    
   // echo $_POST['submitCadastro'];
   // exit;

    $nome           = $_POST['nome'];
    $telefone       = $_POST['telefone'];
    if((empty($_POST['telefone'])) AND (isset($_POST['telefone2']))){
        $telefone = $_POST['telefone2']; 
        $telefone2  = ''; 
    }else{
        $telefone2  = $_POST['telefone2'];    
    }
    $endereco   = $_POST['endereco'];
    $dataNascimento = $_POST['dataNascimento'];
    if(empty($_POST['dataCadCliente'])){
        $dataCadCliente = date("Y-m-d");
    }else{
        $dataCadCliente = $_POST['dataCadCliente'];
    };
    $email          = $_POST['email'];
    $cpf            = $_POST['cpf2'];
   
    voltar:
    $barra      = gera_barra();
    // validação do código de barras
    // faz uma consulta para verificar se existe o codigo de barra gerado
    $buscaBarra = mysqli_query($conexao, "SELECT barra FROM cliente WHERE barra='$barra' ");
    $resultadoes = mysqli_num_rows($buscaBarra);
    if ($resultadoes != 0) {
        // se existir, volta e gera outro codigo
        goto voltar;
    };

    // primeiro cadastro o novo cliente
    mysqli_query($conexao, "SET NAMES 'utf8';");
    $sql = "INSERT INTO cliente (nome, telefone, telefone2, endereco, cpf, dataNascimento, dataCadastro, email, barra, numeroCadastro) 
    VALUES ('$nome','$telefone','$telefone2','$endereco','$cpf','$dataNascimento','$dataCadCliente','$email','$barra','1')";
    mysqli_query($conexao, $sql) or die('Error: '.mysqli_error($conexao));

    // faz uma busca e pega o id do novo cliente cadastrado
    $buscaCliente = mysqli_query($conexao, "SELECT id FROM cliente WHERE nome='$nome' AND cpf='$cpf' AND barra='$barra' ");
    $result = mysqli_num_rows($buscaCliente);

    // se retornar apenas um resultado, salva tudo o que foi pedido do novo cliente, só foi pedido o id
    if ($result == 1) {
        $id_recuperado = mysqli_fetch_array($buscaCliente);
    };

    $id_aparelho    = $_POST['id_aparelho'];
    // cadastra um novo aparelho
    if((isset($_POST['novoAparelho']))AND($_POST['novoAparelho']<>"")){
        $novoAparelho = maiusculo($_POST['novoAparelho']);

        $sql = "INSERT INTO aparelho (nome_aparelho) VALUES ('$novoAparelho')";
        mysqli_query($conexao, $sql) or die('Error: '.mysqli_error($conexao));
        
        $buscaAparelho = mysqli_query($conexao, "SELECT id FROM aparelho WHERE nome_aparelho='$novoAparelho' ");
        $resultAparelho = mysqli_num_rows($buscaAparelho);

        // se retornar apenas um resultado, salva tudo o que foi pedido do novo cliente, só foi pedido o id
        if ($resultAparelho == 1) {
            $id_novoAparelho = mysqli_fetch_array($buscaAparelho);
            $id_aparelho = $id_novoAparelho['id'];
        };
    };

    $id_marca       = $_POST['id_marca'];
    // cadastra uma nova marca
    if((isset($_POST['novaMarca']))AND($_POST['novaMarca']<>"")){
        $novaMarca = maiusculo($_POST['novaMarca']);
        $sql = "INSERT INTO marca (nome_marca) VALUES ('$novaMarca')";
        mysqli_query($conexao, $sql) or die('Error: '.mysqli_error($conexao));

        $buscaMarca = mysqli_query($conexao, "SELECT id FROM marca WHERE nome_marca='$novaMarca' ");
        $resultMarca = mysqli_num_rows($buscaMarca);

        // se retornar apenas um resultado, salva tudo o que foi pedido do novo cliente, só foi pedido o id
        if ($resultMarca == 1) {
            $id_novaMarca = mysqli_fetch_array($buscaMarca);
            $id_marca = $id_novaMarca['id'];
        };

    };

    $id_defeito       = $_POST['id_defeito'];
    if((isset($_POST['novoDefeito']))AND($_POST['novoDefeito']<>"")){
        $novoDefeito = $_POST['novoDefeito'];
        $sql = "INSERT INTO defeito (nome_defeito) VALUES ('$novoDefeito')";
        mysqli_query($conexao, $sql) or die('Error: '.mysqli_error($conexao));
        
        $buscaDefeito = mysqli_query($conexao, "SELECT id FROM defeito WHERE nome_defeito='$novoDefeito' ");
        $resultDefeito = mysqli_num_rows($buscaDefeito);

        // se retornar apenas um resultado, salva tudo o que foi pedido do novo cliente, só foi pedido o id
        if ($resultDefeito == 1) {
            $id_novoDefeito = mysqli_fetch_array($buscaDefeito);
            $id_defeito = $id_novoDefeito['id'];
        };
    };

    $ordem_servico  = $_POST['ordemServico'];
    $id_cliente     = $id_recuperado['id']; // transfere o id para id_cliente
    
    $id_estado      = $_POST['id_estado'];

    if(empty($_POST['dtEntrada'])){
        $dataEntrada = date("Y-m-d");
    }else{
        $dataEntrada = $_POST['dtEntrada'];
    };
   
    aqui:
    $barraCadastro  = gera_barra();
    // validação do código de barras
    // faz uma consulta para verificar se existe o codigo de barra gerado
    $barraCad = mysqli_query($conexao, "SELECT barra FROM cadastro WHERE barra='$barraCadastro' ");
    $resultadoBarraCadastro = mysqli_num_rows($barraCad);
    if ($resultadoBarraCadastro != 0) {
        // se existir, volta e gera outro codigo
        goto aqui;
    };

    $modelo          = maiusculo($_POST['modelo']);
    $numeroSerie     = maiusculo($_POST['numeroSerie']);
    $defeito         = $_POST['defeito'];
    $dtPronto        = $_POST['dtPronto'];
    $acessorio       = $_POST['acessorio'];
    $dtSaida         = $_POST['dtSaida'];
    $observacao      = $_POST['observacao'];
    $material        = $_POST['material'];
    $orcamento       = $_POST['orcamento'];

    // depois de tudo pronto, realiza o novo cadastro
    mysqli_query($conexao, "SET NAMES 'utf8';");
    $sql = "INSERT INTO cadastro (ordem_servico, id_cliente, id_aparelho, id_marca, id_estado, id_defeito, barra, 
    numeroSerie, modelo, defeitoReclamado, acessorio, obs, material, orcamento, dataEntrada) 
    VALUES ('$ordem_servico','$id_cliente','$id_aparelho','$id_marca','$id_estado','$id_defeito','$barraCadastro',
    '$numeroSerie','$modelo','$defeito','$acessorio','$observacao','$material','$orcamento','$dataEntrada')";
    mysqli_query($conexao, $sql) or die('Error: '.mysqli_error($conexao));
    header('Location:index.php');

};

/******************************************************************************************    
 * 
 * 
 *                                    Altera Cadastro 
 * 
 *                                   
 ******************************************************************************************/


    if((isset($_POST['submitCadastro']))AND($_POST['submitCadastro']=="ALTERAR")){

         $codigo = $_POST['id_cliente'];// id do cadastro 
         $codigoCliente = $_POST['idCliente'];// id do cliente

         // alteração na tabela cliente
         $telefone   = $_POST['telefone'];
         if((empty($_POST['telefone'])) AND (isset($_POST['telefone2']))){
             $telefone = $_POST['telefone2']; 
             $telefone2   = ''; 
         }else{
             $telefone2   = $_POST['telefone2'];    
         }
         $endereco   = $_POST['endereco'];
         $email      = $_POST['email'];
         $cpf        = $_POST['cpf2'];
        
         mysqli_query($conexao, "SET NAMES 'utf8';");
         $sql = "UPDATE cliente SET telefone='$telefone', telefone2='$telefone2', endereco='$endereco', email='$email', cpf='$cpf' 
         WHERE id='$codigoCliente'"; 
         mysqli_query($conexao, $sql) or die('Error: '.mysqli_error($conexao)); 

         // alteração na tabela cadastro
        if(($_POST['id_estado']=="2") AND (empty($_POST['dtPronto']))){
            $dtPronto    = date("Y-m-d");
        }else{
            $dtPronto    = $_POST['dtPronto'];
        };

        if(($_POST['id_estado']=="3") AND (empty($_POST['dtSaida']))){
            $dtSaida    = date("Y-m-d");
        }else{
            $dtSaida         = $_POST['dtSaida'];
        };

        $material        = $_POST['material'];
        $orcamento       = $_POST['orcamento'];
        $id_estado       = $_POST['id_estado'];
        $observacao      = $_POST['observacao'];
        $modelo          = $_POST['modelo'];
        $numeroSerie     = $_POST['numeroSerie'];
    
        // depois de tudo pronto, realiza o novo cadastro
        mysqli_query($conexao, "SET NAMES 'utf8';");
        $sql = "UPDATE cadastro SET dataPronto='$dtPronto', dataSaida='$dtSaida', material='$material', 
        orcamento='$orcamento', id_estado='$id_estado', obs='$observacao', modelo='$modelo', numeroSerie='$numeroSerie'
        WHERE id='$codigo'";  


        mysqli_query($conexao, $sql) or die('Error: '.mysqli_error($conexao));
        header('Location:index.php');

    }


/******************************************************************************************    
 * 
 * 
 *                                    Alterar Cliente 
 * 
 *                                   
 ******************************************************************************************/




    if((isset($_POST['id_AltCliente']))AND($_POST['id_AltCliente']<>"")){

        $codigo             = $_POST['id_AltCliente'];// id do cliente

        $cpf                = $_POST['cpf'];
        $nome = $_POST['nome'];
        $dataNascimento     = $_POST['dataNascimento'];

        if(empty($_POST['dataCadCliente'])){
            $dataCadCliente = date("Y-m-d");
        }else{
            $dataCadCliente = $_POST['dataCadCliente'];
        };

        // alteração na tabela cliente
        $telefone           = $_POST['telefone'];
        if((empty($_POST['telefone'])) AND (isset($_POST['telefone2']))){
            $telefone       = $_POST['telefone2']; 
            $telefone2      = ''; 
        }else{
            $telefone2      = $_POST['telefone2'];    
        }
        $endereco           = $_POST['endereco'];
        $email              = $_POST['email'];
        
       
        mysqli_query($conexao, "SET NAMES 'utf8';");
        $sql = "UPDATE cliente SET nome='$nome', dataCadastro='$dataCadCliente', dataNascimento='$dataNascimento', telefone='$telefone', telefone2='$telefone2', endereco='$endereco', email='$email', cpf='$cpf' 
        WHERE id='$codigo'"; 
        mysqli_query($conexao, $sql) or die('Error: '.mysqli_error($conexao)); 

        // alteração na tabela cadastro
       if(($_POST['id_estado']=="2") AND (empty($_POST['dtPronto']))){
           $dtPronto    = date("Y-m-d");
       }else{
           $dtPronto    = $_POST['dtPronto'];
       };

       if(($_POST['id_estado']=="3") AND (empty($_POST['dtSaida']))){
           $dtSaida    = date("Y-m-d");
       }else{
           $dtSaida         = $_POST['dtSaida'];
       };

       $material        = $_POST['material'];
       $orcamento       = $_POST['orcamento'];
       $id_estado       = $_POST['id_estado'];
       $observacao      = $_POST['observacao'];
       $modelo          = $_POST['modelo'];
       $numeroSerie     = $_POST['numeroSerie'];
   
       // depois de tudo pronto, realiza o novo cadastro
       mysqli_query($conexao, "SET NAMES 'utf8';");
       $sql = "UPDATE cadastro SET dataPronto='$dtPronto', dataSaida='$dtSaida', material='$material', 
       orcamento='$orcamento', id_estado='$id_estado', obs='$observacao', modelo='$modelo', numeroSerie='$numeroSerie'
       WHERE id='$codigo'";  


       mysqli_query($conexao, $sql) or die('Error: '.mysqli_error($conexao));
       header('Location:index.php');

   }

