<?php

require_once 'conexao.php';


if((isset($_POST['busca']))AND($_POST['busca']<>"")){
    $busca = $_POST['busca'];
    $query = mysqli_query($conexao,"SELECT * FROM cliente WHERE excluir ='' AND nome LIKE '%$busca%' OR cpf = '$busca' OR endereco LIKE '%$busca%' OR barra = '$busca' OR telefone = '$busca' OR email = '$busca' ");
    $total = mysqli_num_rows($query);   
};

if((isset($_POST['buscaCadastro']))AND($_POST['buscaCadastro']<>"")){
    $busca = $_POST['buscaCadastro'];
    $query = mysqli_query($conexao,"SELECT * FROM cadastro WHERE id_cliente ='$busca' ");
    $total = mysqli_num_rows($query);   
};


if((isset($_POST['data']))AND($_POST['data']<>"")){
    $busca = $_POST['data'];
    $query = mysqli_query($conexao,"SELECT * FROM cliente WHERE dataNascimento = '$busca' AND excluir ='' ");
    $total = mysqli_num_rows($query); 
};

?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

        <title>CRUD_inner_join_json </title>
    
        <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
        <meta name="referrer" content="default" id="meta_referrer" />
        <meta http-equiv="cache-control" content="no-cache">
        <meta http-equiv="expires" content="Mon, 22 Jul 2002 11:12:01 GMT">

        <link rel="stylesheet" type="text/css" href="estilo.css" />
</head>
    <body>
        <div class="container">
            <div id="pesquisa" class="pesquisa">
                <b>Digite o nome, cpf, telefone, endereço, email ou codigo de barra</b>
                
                <!-- primeiro formulário de pesquisa --> 
                <form id="formulario" name="frmEnviaDados" class="form-horizontal" action="duplicado.php"  method="post">
                    <input id="cpfbusca" type="text" name="busca" placeholder="Digite aqui para pesquisar" autocomplete="off">
                    <input class="botao but-azul" type="submit" value="buscar" onclick="return valida()">
                    <a href="index.php" class="botao" style="padding:4px;" > VOLTAR </a> 
                    <input id="buscaCliente" type="hidden" name="buscaCad" autocomplete="off" />
                </form>
                <!--
                <b>Digite o ID do cliente, cpf ou codigo de barra, para listar todos os cadastros do cliente</b>
                <form id="formularioCadastro" name="frmEnviaDados" class="form-horizontal" action="duplicado.php"  method="post">
                    <input id="cpf" type="text" name="buscaCadastro" placeholder="Digite aqui para pesquisar" autocomplete="off">
                    <input class="botao but-azul" type="submit" value="buscar cadastro(s)"> 
                
                </form>
                -->
                <b>Digite a data de nascimento</b>
                <form id="formulario" name="frmEnviaDados" class="form-horizontal" action="duplicado.php"  method="post">
                    <input id="data" type="date" name="data" placeholder="Digite aqui para pesquisar" autocomplete="off">
                    <input class="botao but-azul" type="submit" value="busca pela  data de  nascimento"  onclick="return validaData()">
                </form>
            </div>

            <div id="div_formulario2" class="formulario">
                <div class="titulo">alteração de cliente</div>
                <form id="form_cadastro" name="frmEnviaDados" class="form-horizontal" action="cadastro.php"  method="post" enctype="multipart/form-data"  >       
                    <!--<input id="id_cliente" type="hidden" name="id_cliente" value="" >-->
                    <input id="id_AltCliente" type="hidden" name="id_AltCliente" value="" > 
                    <table class="tabela_menus" border="1" style="border-collapse: collapse" cellpadding="2" cellspacing="0">
                        <thead>
                            <tr>
                                <td  class="tabela3 OS">
                                    CPF <span class="nomeCPF"> &nbsp&nbsp&nbspCADASTRO </span><br>
                                    <input class="orcamento" style="width:60%;" type="text" autocomplete="off" id="cpf2Cliente" name="cpf"  maxlength="11" onkeypress='return event.charCode >= 48 && event.charCode <= 57' autocomplete="off" onkeyup="verificarCliente2()"  >
                                    <input class="orcamento" style="width:25%; margin-left:4%" type="text" id="numeroCadastro" disabled  >
                                </td>
                                <td colspan="3" class="tabela3">
                                    Nome<br>
                                    <input id="nomeCliente" class="nome-form" type="text" name="nome" value="" autocomplete="off">
                                </td>
                                <td  class="tabela3">
                                    Telefone<br>
                                    <input id="telefoneCliente" class="telefone-form" autocomplete="off" placeholder="(99)9999-9999" maxlength="14" type="text" name="telefone" value="" >
                                </td>	
                                <td  class="tabela3">
                                    Telefone 2<br>
                                    <input id="telefone2Cliente" class="telefone-form" autocomplete="off" placeholder="(99)9999-9999" maxlength="14" type="text" name="telefone2" value="" >
                                </td>	   
                            </tr>
                            <tr class="divNovoCadastro">
                                <td class="tabela3">
                                    DT. Nascimento<br>
                                    <input class="telefone-form" id="dataNascimentoCliente" type="date" name="dataNascimento">
                                </td>
                                <td class="tabela3" colspan="4">
                                    Endereço<br>
                                    <input class="endereco-form" id="enderecoCliente" autocomplete="off"  type="text" name="endereco" >
                                </td>
                                <td class="tabela3" colspan="2">
                                    Email<br>
                                        <input class="telefone-form" id="emailCliente" autocomplete="off"  type="text" name="email" >
                                </td>
                            </tr>
                            <tr class="divNovoCadastro">
                                <td class="tabela3">
                                    DT. Cadastro<br>
                                    <input class="telefone-form" id="dataCadClienteCliente" type="date" name="dataCadCliente">
                                </td>
                                <td class="tabela3">
                                    Barra<br>
                                    <input class="endereco-form" id="barraCliente2"  type="text" name="barra" disabled >
                                </td>                           
                                <td class="tabela3 nc">
                                    
                                    N/C<br>
                                    <input class="nome-form" id=""  type="text" name="" disabled >
                                    
                                </td>
                            </tr>  
                            <tr>         
                                <td  class="tabela3 flex">
                                    <input type="submit"  id="submitCadastro2" name="submitCadastro" class="botao cadastro" value="ALTERAR">
                                    <a href="#" class="botao but-vermelho"  style="width:50px;height:18px;padding:4px 4px 0 4px; text-align:center;"  OnClick="this.href='excluir_cliente.php?codigo='+ id_AltCliente.value;return confirm('Confirma Exclusão da ' +'\n' + nome.value)" >exc</a>
                                    <span class="botao" style="width:50px;height:18px;padding:4px 4px 0 4px;" onclick="return retornar()">VOLTAR</span>
                                </td>
                            </tr>
                        </thead>
                    </table>
                </form>
            </div>
                
                <?php 
                if((isset($_POST['busca']))AND($_POST['busca']<>"")OR(isset($_POST['data']))AND($_POST['data']<>"")){ ?>
            
            <div id="tabela_exibicao">
                <div class="titulo">exibição de cadastro&nbsp&nbsp <?php echo $total;?></div>
                <table class="tabela_menus" border="1" style="border-collapse: collapse" cellpadding="2" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="tabela2">
                                ID
                            </th>
                            <th  class="tabela2">
                                Nome do cliente
                            </th>
                            <th  class="tabela2">
                                Tel.
                            </th>
                            <th  class="tabela2">
                                Nº Cadastro
                            </th>
                            <th  class="tabela2">
                                CPF
                            </th>
                            <th  class="tabela2">
                                Dt Nascimento
                            </th>
                            <th  class="tabela2">
                                Email
                            </th>	
                            <th  class="tabela2">
                                Barra
                            </th>	
                            <th class="funcoes">
                                Funções <br>
                            </th>
                        </tr>
                    </thead>  
                    <tbody>
                    <?php
                        while ($linha = mysqli_fetch_array($query,MYSQLI_ASSOC)) {;?>
                             <tr onmouseover="javascript:style.background='#ffbc75'"  onmouseout="javascript:style.background=''">
                                <td class="tdCenter">
                                    <form id="formularioCadastro" name="frmEnviaDados" action="duplicado.php"  method="post">  
                                        <input class=" botao cadastro" style="padding:0;width:25px;height:15px;font-size:10px" type="submit" name="buscaCadastro" value="<?php echo $linha['id']; ?>"> 
                                    </form>
                                </td>                          
                                <td><?php echo $linha['nome']; ?></td>
                                <td><?php echo $linha['telefone']; ?></td>
                                <td class="tdCenter"><?php echo $linha['numeroCadastro']; ?></td>
                                <td class="tdCenter"><?php echo $linha['cpf']; ?></td>
                                
                                <td class="tdCenter"><?php if($linha['dataNascimento']<>'0000-00-00'){echo date("d/m/Y",strtotime($linha['dataNascimento']));} ?></td>
                                <td><?php echo $linha['email']; ?></td>
                                <td class="tdCenter"><?php echo $linha['barra']; ?></td>
                                <td >
                                    <span class="botao  but-azul" onclick="buscaCliente.value='<?php echo $linha['id']; ?>'; buscaNoBanco4()" >alt</span>        
                                    <a href="excluir_cliente.php?codigo=<?= $linha['id']; ?>" class="botao but-vermelho"  OnClick="return confirm('Confirma Exclusão da OS <?php echo $linha['id']; ?>' +'\n'+'<?php echo $linha['nome']; ?>')" >exc</a>
                                </td>
                            </tr>
                    <?php };} ?>
                    </tbody>
                </table>
            </div>
            <div class="tabela_exibicao">
                <?php
                    require_once 'formulario.php';
                ?>
            </div>
            <?php
                if((isset($_POST['buscaCadastro']))AND($_POST['buscaCadastro']<>"")){     
            ?>
            <div id="tabela_exibicao" class="tabela_exibicao">
                <div class="titulo">cadastro do mesmo cliente &nbsp&nbsp <?php echo $total;?></div>
                <table class="tabela_menus" border="1" style="border-collapse: collapse" cellpadding="2" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="tabela2">
                                ID do cadastro
                            </th>
                            <th class="tabela2">
                                O.S.
                            </th>
                            <th class="tabela2">
                                Data de entrada
                            </th>
                            <th class="tabela2">
                                Data de saída
                            </th>
                            <th  class="tabela2">
                                Código de Barra
                            </th>   
                            <th class="funcoes">
                                Funções &nbsp&nbsp&nbsp <span class="botao" style="padding:4px;" onclick="volta()">Voltar</span><br>
                            </th>
                        </tr>
                    </thead>  
                    <tbody>
                        <input type="hidden" id="buscaCad" value="" >
                        <?php
                            while ($linha = mysqli_fetch_array($query,MYSQLI_ASSOC)) {;?>
                                 <tr onmouseover="javascript:style.background='#ffbc75'"  onmouseout="javascript:style.background=''">
                                    <td class="td tdCenter"><?php echo $linha['id']; ?></td>   
                                    <td class="td tdCenter"><?php echo $linha['ordem_servico']; ?></td>
                                    <td class="td tdCenter"><?php echo date("d/m/Y", strtotime($linha['dataEntrada'])); ?></td>  
                                    <td class="td tdCenter"><?php if($linha['dataSaida']<>'0000-00-00'){echo date("d/m/Y", strtotime($linha['dataSaida']));} ?></td>                        
                                    <td class="td tdCenter"><?php echo $linha['barra']; ?></td>
                                    <td >
                                        <span class="botao but-azul" onclick="buscaCad.value='<?php echo $linha['barra']; ?>'; buscaNoBanco3(); ocultaBotão()" >Ver</span>   
                                    </td>
                                </tr>
                        <?php };?>
                    </tbody>
                </table>
            </div>

            <?php };
                require_once 'js.php';
            ?>       
        </div>
        <script>
         

          // Página duplicado.php, botão alt, preenche o formulário que altera os dados do cliente
          function buscaNoBanco4(){
                let texto = document.getElementById('buscaCliente').value;
                fetch('http://localhost:80/inner_join_mysql_tres_tabelas/buscaCadastro.php?cliente=' + texto)
                .then(response => {// retorna a requisição fetch
                    if (response.ok) {// se reornar ok
                    return response.json();// converte num objeto json
                    
                    }
                })

                .then(json => {
                    if(json == "zero"){
                    }else{
                        id_AltCliente.value = json.id;
                        pesquisa.style.display="none"; 
                        tabela_exibicao.style.display="none";
                        div_formulario2.style.display="block";
                        nomeCliente.value = json.nome;
                        cpf2Cliente.value = json.cpf;
                        telefoneCliente.value = json.telefone;
                        telefone2Cliente.value = json.telefone2;
                        enderecoCliente.value = json.endereco;
                        dataNascimentoCliente.value = json.dataNascimento;
                        dataCadClienteCliente.value = json.dataCadastro;
                        emailCliente.value = json.email;
                        barraCliente2.value = json.barra;  
                        numeroCadastro.value = json.numeroCadastro;  
                    }
                })

                .catch(error => {
                    alert("erro");
                });  
            };


            // Permite alterar o CPF do cliente
            function buscaNoBanco5(){
                let texto = document.getElementById('cpf2Cliente').value;
                
                fetch('http://localhost:80/inner_join_mysql_tres_tabelas/buscaCadastro.php?buscaCPF=' + texto)
                .then(response => {// retorna a requisição fetch
                    if (response.ok) {// se reornar ok
                    return response.json();// converte num objeto json
                    }
                })

                .then(json => {
                    if (json > 0){
                        alert("CPF já cadastrado");
                    }else{
                        submitCadastro.disabled ="";
                        submitCadastro2.disabled ="";
                        submitCadastro.style.background ="lightgreen";
                        submitCadastro2.style.background ="lightgreen";
                        submitCadastro.style.color ="#000";
                        submitCadastro2.style.color ="#000";
                        submitCadastro.style.borderColor ="#999";
                        submitCadastro2.style.borderColor ="#999";
                        submitCadastro.style.cursor ="pointer";
                        submitCadastro2.style.cursor ="pointer";
                        cpf2Cliente.style.background ="#fff";
                        cpf2Cliente.style.color ="#000";            
                     };   
                })

                .catch(error => {
                    alert("erro");
                });  
            };

             // Mostra se o CPF digitado é válido ou não
             function verificarCliente2(){
                let cpf2 =  document.getElementById('cpf2Cliente');  
                if(cpf2Cliente.value.length >0){
                    submitCadastro.disabled ="true";
                    submitCadastro2.disabled ="true";
                    submitCadastro.style.background ="#f1f1f1";
                    submitCadastro2.style.background ="#f1f1f1";
                    submitCadastro.style.color ="#aaa";
                    submitCadastro2.style.color ="#aaa";
                    submitCadastro.style.borderColor ="#aaa";
                    submitCadastro2.style.borderColor ="#aaa";
                    submitCadastro.style.cursor ="default";
                    submitCadastro2.style.cursor ="default";

                    if(cpf2Cliente.value.length == 11){
                        // verifica se todos os caracers do campo são números
                        if (!isNaN(cpf2Cliente.value)){
                            // faz a validação
                            var resultado2 = isValidCPF(cpf2Cliente.value);
                            // mostra o resultado
                            if(resultado2 ===true){
                                buscaNoBanco5();
                            }else{
                                cpf2Cliente.style.background = "#f00";
                                cpf2Cliente.style.color ="#fff";           
                            } 
                        }
                    }else{
                        cpf2Cliente.style.background = "#fff";
                        cpf2Cliente.style.color ="#000";
                    };
                }else{
                    submitCadastro.disabled ="";
                    submitCadastro2.disabled ="";
                    submitCadastro.style.background ="lightgreen";
                    submitCadastro2.style.background ="lightgreen";
                    submitCadastro.style.color ="#000";
                    submitCadastro2.style.color ="#000";
                    submitCadastro.style.borderColor ="#999";
                    submitCadastro2.style.borderColor ="#999";
                    submitCadastro.style.cursor ="pointer";
                    submitCadastro2.style.cursor ="pointer";
                }
            };
            // Botão VOLTAR
            function retornar(){
                div_formulario.style.display="none";
                div_formulario2.style.display="none";
                pesquisa.style.display="block";
                tabela_exibicao.style.display="block";
                submitCadastro2.disabled ="";
                submitCadastro2.style.background ="lightgreen";
                submitCadastro2.style.color ="#000";
                submitCadastro2.style.borderColor ="#999";
                submitCadastro2.style.cursor ="pointer";
                cpf2Cliente.style.background = "#fff";
                cpf2Cliente.style.color = "#000";
                return false;
            };
            
            //  Função para ocultar os botões de alterar e excluir e fazer outras modificações, 
            //  ao abrir o formulário para visualizar o cadastro no botão Ver
            function ocultaBotão(){
                botaoExcluir.style.visibility="hidden";
                submitCadastro.style.visibility="hidden"; 
                document.getElementById("form-cadastro").innerHTML="visualização de cadastro";
                nome.setAttribute("readonly",true);
                telefone.setAttribute("readonly",true);
                telefone2.setAttribute("readonly",true);
                ordemServico.setAttribute("readonly",true);
                cpf2.setAttribute("readonly",true);
                dtNascimento.setAttribute("readonly",true);
                endereco.setAttribute("readonly",true);
                dtCadCliente.setAttribute("readonly",true);
                email.setAttribute("readonly",true);
                dtEntrada.setAttribute("readonly",true);
                select_defeito.disabled="true";
                novoDefeito.style.visibility="hidden";
                nDefeito.style.visibility="hidden";
                dtPronto.setAttribute("readonly",true);
                acessorio.setAttribute("readonly",true);
                novoAcessorio.style.visibility="hidden";
                nAcessorio.style.visibility="hidden";
                dtSaida.setAttribute("readonly",true);
                observacao.setAttribute("readonly",true);
                material.setAttribute("readonly",true);
                select_aparelho.disabled="true";
                novoAparelho.style.visibility="hidden";
                nAparelho.style.visibility="hidden";
                select_marca.disabled="true";
                novaMarca.style.visibility="hidden";
                nMarca.style.visibility="hidden";
                select_estado.disabled="true";
                novoEstado.style.visibility="hidden";
                nEstado.style.visibility="hidden";
                modelo.setAttribute("readonly",true);
                novoModelo.style.visibility="hidden";
                nModelo.style.visibility="hidden";
                numeroSerie.setAttribute("readonly",true);
                orcamento.setAttribute("readonly",true);
                desconto.setAttribute("readonly",true);

            }
            
        </script>
    </body>
</html>
           



