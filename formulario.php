<div id="div_formulario">
            <div id="form-cadastro" class="titulo"></div>
            <form id="form_cadastro" name="frmEnviaDados" action="cadastro.php"  method="post" enctype="multipart/form-data"  >       
                <input id="id_cliente" type="hidden" name="id_cliente" value="" >
                <input id="idCliente" type="hidden" name="idCliente" value="" >
                <table class="tabela_menus" border="1" style="border-collapse: collapse" cellpadding="2" cellspacing="0">
                    <tr>
                        <td  class="tabela3 OS">
                            &nbsp O. S. <span class="nomeCPF"> CPF </span> <br>
                            <input class="orcamento" type="text" autocomplete="off" id="ordemServico" name="ordemServico" maxlength="5" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required >
                            <input class="orcamento" type="text" autocomplete="off" id="cpf2" name="cpf2"  maxlength="11" onkeypress='return event.charCode >= 48 && event.charCode <= 57' autocomplete="off" onkeyup="verificar2()"  >
                        </td>
                        <td colspan="2" class="tabela3">
                            &nbsp Nome<br>
                            <input id="nome" class="nome-form" type="text" name="nome" value="" autocomplete="off" required>
                        </td>
                        <td  class="tabela3">
                            &nbsp Telefone<br>
                            <input id="telefone" class="telefone-form" autocomplete="off" placeholder="(99)9999-9999" maxlength="14" type="text" name="telefone" value="" >
                        </td>	
                        <td  class="tabela3">
                            &nbsp Telefone 2<br>
                            <input id="telefone2" class="telefone-form" autocomplete="off" placeholder="(99)9999-9999" maxlength="14" type="text" name="telefone2" value="" >
                        </td>	   
                    </tr>
                    <tr>
                        <td class="tabela3">
                            &nbsp DT. Nascimento<br>
                                <input class="telefone-form" id="dtNascimento" type="date" name="dataNascimento">
                        </td>
                        <td class="tabela3" colspan="4">
                            &nbsp Endereço<br>
                                <input class="endereco-form" id="endereco"  type="text" name="endereco" >
                        </td>
                    </tr>
                    <tr>
                        <td class="tabela3">
                            &nbsp DT. Cadastro<br>
                                <input class="telefone-form" id="dtCadCliente" type="date" name="dataCadCliente">
                        </td>
                        <td class="tabela3" colspan="2">
                            &nbsp Email<br>
                                <input class="nome-form" id="email"  type="text" name="email" >
                        </td>
                        <td class="tabela3 barra-form" colspan="1">
                            &nbsp Barra Cliente<br>
                                <input class="telefone-form" id="barraCliente"  type="text" name="" disabled >
                        </td>
                        <td class="tabela3" colspan="1">
                            &nbsp Barra Cadastro<br>
                                <input class="telefone-form" id="barraCadastro"  type="text" name="" disabled >
                        </td>
                    </tr>
                    <tr>
                        <td class="tabela3">
                            &nbsp DT. Entrada<br>
                                <input class="telefone-form" id="dtEntrada" type="date" name="dtEntrada">
                        </td>
                       <!-- 
                        <td class="tabela3" colspan="2">
                            &nbsp Defeito<br>
                                <input class="nome-form" id="defeito"  type="text" name="defeito" required >
                        </td>
                        -->
                        <td  class="tabela3" colspan="2">
                            &nbsp Defeito<br>
                            <select id="select_defeito"  class="nome-form" name="id_defeito" >    
                                <option  class="nome-form" id="id_defeito" value=""></option>
                                <?php $listaDefeito = mysqli_query($conexao,"SELECT * FROM defeito ORDER BY nome_defeito ASC");                        
                                    while($defeitos = mysqli_fetch_array($listaDefeito)) {; ?>
                                        <option class="nome-form" value="<?php echo $defeitos['id']; ?>"><?php echo $defeitos['nome_defeito']; ?>
                                        </option>                             
                                <?php } ?>                                                                  
                            </select>
                        </td>
                         <td class="tabela3" colspan="2">
                            <span id="nDefeito" >&nbsp Novo Defeito</span><br>
                                <input class="nome-form" id="novoDefeito"  type="text" name="novoDefeito" >
                        </td>
                        <!--
                        <td  class="tabela3">
                            &nbsp Acessório<br>
                            <select id="select_acessorio"  class="nome-form" name="id_acessorio" >    
                                <option  class="nome-form" id="id_acessorio" value=""></option>
                                <?php $listaAcessorio = mysqli_query($conexao,"SELECT * FROM acessorio ORDER BY nome_acessorio ASC");                        
                                    while($acessorios = mysqli_fetch_array($listaAcessorio)) {; ?>
                                        <option class="nome-form" value="<?php echo $acessorios['id']; ?>"><?php echo $acessorios['nome_acessorio']; ?>
                                        </option>                             
                                <?php } ?>                                                                  
                            </select>
                        </td>
                                    -->
                        <!--
                         <td class="tabela3">
                            &nbsp Novo Acessório<br>
                                <input class="telefone-form" id="novoAcessorio"  type="text" name="novoAcessorio" >
                        </td>
                                    -->
                    </tr>
                    <tr>
                        <td class="tabela3">
                            &nbsp DT. Pronto<br>
                                <input class="telefone-form" id="dtPronto" type="date" name="dtPronto">
                        </td>
                        <td class="tabela3" colspan="2">
                            &nbsp Acessório<br>
                                <input class="nome-form" id="acessorio"  type="text" name="acessorio" required >
                        </td>
                         <td class="tabela3" colspan="2">
                            <span id="nAcessorio" >&nbsp Novo Acessório</span><br>
                                <input class="nome-form" id="novoAcessorio"  type="text" name="novoAcessorio" >
                        </td>
                    </tr>
                    <tr>
                        <td class="tabela3">
                            &nbsp DT. Saída<br>
                                <input class="telefone-form" id="dtSaida" type="date" name="dtSaida">
                        </td>
                        <td class="tabela3" colspan="4">
                            &nbsp Observação<br>
                                <input class="endereco-form" id="observacao" autocomplete="off" type="text" name="observacao">
                        </td>
                    </tr>
                    <tr>
                        <td class="tabela3" colspan="5">
                            &nbsp Material<br>
                            <textarea class="textarea_material" id="material" autocomplete="off" cols="10" rows="4" id="material" name="material"  autocomplete="off" maxlength="254" onKeyup="pri_mai(this);" ></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td  class="tabela3">
                            &nbsp Aparelho<br>
                            <select id="select_aparelho"  class="telefone-form" name="id_aparelho" >    
                                <option id="id_aparelho" value=""></option>                                  
                                <?php $listaAparelho = mysqli_query($conexao,"SELECT * FROM aparelho ORDER BY nome_aparelho ASC");               		  
                                while($aparelhos = mysqli_fetch_array($listaAparelho)) {; ?>                                      	
                                    <option value="<?php echo $aparelhos['id']; ?>"><?php echo $aparelhos['nome_aparelho']; ?></option>                                                                      	
                                <?php } ?>						  				  				  	                                                                                                                                                                                           
                            </select>
                        </td>
                        <td  class="tabela3">
                            &nbsp Marca<br>
                            <select id="select_marca" class="telefone-form" name="id_marca" >    
                                <option id="id_marca" value=""></option>                                  
                                <?php $listaMarca = mysqli_query($conexao,"SELECT * FROM marca ORDER BY nome_marca ASC");               		  
                                while($marcas = mysqli_fetch_array($listaMarca)) {; ?>                                      	
                                    <option value="<?php echo $marcas['id']; ?>"><?php echo $marcas['nome_marca']; ?></option>                                                                      	
                                <?php } ?>						  				  				  	                                                                                                                                                                                           
                            </select>
                        </td>
                        <td  class="tabela3">
                            &nbsp Estado<br>
                            <select id="select_estado" class="telefone-form"  name="id_estado" required >    
                                <option id="id_estado" value=""></option>                                  
                                <?php $listaEstado = mysqli_query($conexao,"SELECT * FROM estado ORDER BY nome_estado ASC");               		  
                                while($estados = mysqli_fetch_array($listaEstado)) {; ?>                                      	
                                    <option value="<?php echo $estados['id']; ?>"><?php echo $estados['nome_estado']; ?></option>                                                                      	
                                <?php } ?>						  				  				  	                                                                                                                                                                                           
                            </select>
                        </td>
                        <td class="tabela3 OS" >
                            &nbsp Modelo<br>
                                <input class="telefone-form" id="modelo" type="text" name="modelo">
                        </td>
                        <td class="tabela3 OS" >
                            &nbsp Nº série<br>
                                <input class="telefone-form" id="numeroSerie" type="text" name="numeroSerie">
                        </td>
                    </tr>
                    <tr>
                        <td class="tabela3 OS">
                        <span id="nAparelho" >&nbsp Novo Aparelho</span><br>
                                <input class="telefone-form" id="novoAparelho" type="text" autocomplete="off" name="novoAparelho" maxlength="25">
                        </td>
                        <td class="tabela3 OS">
                        <span id="nMarca" >&nbsp Nova Marca</span><br>
                                <input class="telefone-form" id="novaMarca" type="text" autocomplete="off" name="novaMarca" maxlength="25">
                        </td>
                         <td class="tabela3 OS">
                         <span id="nEstado" >&nbsp Novo Estado</span><br>
                                <input class="telefone-form" id="novoEstado" type="text" autocomplete="off" name="novoEstado" maxlength="25">
                        </td>              
                        <td  class="tabela3">
                        <span id="nModelo" >&nbsp Novo Modelo</span><br>
                                <input class="telefone-form" id="novoModelo" type="text" autocomplete="off" name="novaModelo" maxlength="25">
                        </td> 
                        <td  class="tabela3">
                            &nbsp Orçamento  &nbsp&nbsp&nbsp&nbsp&nbsp Desconto<br>
                            <input class="orcamento" id="orcamento" type="text" autocomplete="off" name="orcamento" maxlength="5" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            
                            <input class="orcamento" id="desconto" type="text" autocomplete="off" name="desconto" maxlength="5" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                <!-- <input  id="verifica" class="botao" type="submit" value="verificar" onclick="return buscar()">-->
                            
                        </td> 
                    </tr>
                    <tr>

                        <td  class="tabela3 flex">
                           
                            <input type="submit" id="submitCadastro" name="submitCadastro" class="botao cadastro" value=""  onclick="return validaForm()">
                            <a href="#" id="botaoExcluir" class="botao but-vermelho" style="width:50px;height:18px;padding:4px 4px 0 4px; text-align:center;"  OnClick="this.href='excluir_cadastro.php?codigo='+ id_cliente.value;return confirm('Confirma Exclusão da OS ' + ordemServico.value +'\n' + nome.value)" >exc</a>
                            <span class="botao" style="width:50px;height:18px;padding:4px 4px 0 4px;" onclick="return retornar()">VOLTAR</span>
                        
                        </td>
                         <td class="tabela3 OS">
                            Foto1 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Foto 2 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Foto 3<br>
                        </td>   
                    </tr>
                </table> 
            </form>
        </div>
