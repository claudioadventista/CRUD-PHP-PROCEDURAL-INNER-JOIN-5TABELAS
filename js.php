<script>
    // -------------------------------- Tratamento para validação do Cpf ------------------------------
                
    // VERIFICA E VALIDA O CPF DIGITADO NO CAMPO CPF
    function isValidCPF(cpf) {
        if (typeof cpf !== 'string') return false
        if (cpf == "12345678909") return false
        
        cpf = cpf.replace(/[^\d]+/g, '')
        if (cpf.length !== 11 || !!cpf.match(/(\d)\1{10}/)) return false
        
        cpf = cpf.split('')
        const validator = cpf
            .filter((digit, index, array) => index >= array.length - 2 && digit)
            .map( el => +el )
        const toValidate = pop => cpf
            .filter((digit, index, array) => index < array.length - pop && digit)
            .map(el => +el)
        const rest = (count, pop) => (toValidate(pop)
            .reduce((soma, el, i) => soma + el * (count - i), 0) * 10) % 11 % 10
        return !(rest(10,2) !== validator[0] || rest(11,1) !== validator[1])
    }

   
        // ESSA FUNÇÃO USA NA PÁGINA index.ph E NÁ PÁGINA duplicado.php, 
        // E PREENCHE O FORMULÁRIO PARA ALTERAÇÃO E VISUALIZAÇÃO DE CADASTRO
        function buscaNoBanco3(){
            let texto = document.getElementById('buscaCad').value;
            fetch('http://localhost:80/inner_join_mysql_tres_tabelas/buscaCadastro.php?busca=' + texto)
            .then(response => {// retorna a requisição fetch
                if (response.ok) {// se reornar ok
                return response.json();// converte num objeto json
                }
            })

            .then(json => {
                if(json == "zero"){
                alert("nada encontrado");
                buscaCad.value="";
                buscaCad.focus();
                }else if(json == "mais_de_um"){
                    alert("Mais de uma O.S encontrada");
                }else{
                    submitCadastro.value ="ALTERAR";
                    id_cliente.value = buscaCad.value; 
                    idCliente.value = json.cliente_id;
                    tabela_exibicao.style.display="none";
                    pesquisa.style.display="none";
                    div_formulario.style.display="block";
                   // botaoExcluir.style.visibility="visible";
                    ordemServico.value = json.cadastro_ordem;
                    //defeito.value = json.cadastro_defeitoReclamado;
                    dtEntrada.value = json.cadastro_dataEntrada; 
                    dtPronto.value = json.cadastro_dataPronto;
                    dtSaida.value = json.cadastro_dataSaida;
                    material.value = json.cadastro_material;
                    observacao.value = json.cadastro_obs;
                    orcamento.value = json.cadastro_orcamento;
                    acessorio.value = json.cadastro_acessorio;
                    modelo.value = json.cadastro_modelo;
                    numeroSerie.value = json.cadastro_numeroSerie;
                    id_aparelho.value = json.aparelho_id;
                    id_aparelho.text = json.aparelho_nome;
                    id_marca.value = json.marca_id;
                    id_marca.text = json.marca_nome;
                    id_estado.value = json.estado_id;
                    id_estado.text = json.estado_nome;
                    id_defeito.value = json.defeito_id;
                    id_defeito.text = json.defeito_nome;
                    barraCadastro.value = json.cadastro_barra;
                    nome.value = json.cliente_nome;
                    cpf2.value = json.cliente_cpf;
                   // cpf.disabled = 'true';
                    telefone.value = json.cliente_telefone;
                    telefone2.value = json.cliente_telefone2;
                    endereco.value = json.cliente_endereco;
                    dtNascimento.value = json.cliente_dataNascimento;
                    dtCadCliente.value = json.cliente_dataCadastro;
                    email.value = json.cliente_email;
                    barraCliente.value = json.cliente_barra;     
                }
            })

            .catch(error => {
                alert("erro ao tentar alterar");
            });  
        };
    
    // LIMPA E REABILITA OS CAMPOS DO FORMULÁRIO
    function retornar(){
        // limpa todos os campos do formulário
        submitCadastro.disabled ="";
        submitCadastro.style.background ="lightgreen";
        submitCadastro.style.color ="#000";
        submitCadastro.style.borderColor ="#999";
        submitCadastro.style.cursor ="pointer";
        form_cadastro.reset();
        reabilitaCampos();
        div_formulario.style.display="none";
        pesquisa.style.display="block";
        tabela_exibicao.style.display="block";
        verifica.style.visibility="hidden";
        botaoExcluir.style.visibility="visible";
        submitCadastro.style.visibility="visible";
        return false;
    };
 
    // MÁSCARA DO TELEFONE
    /* Máscaras ER */
    function mascara(o,f){
        v_obj=o
        v_fun=f
        setTimeout("execmascara()",1)
    }
    function execmascara(){
        v_obj.value=v_fun(v_obj.value)
    }
    function mtel(v){
        v=v.replace(/\D/g,""); //Remove tudo o que não é dígito
        //v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos e um espaço
        v=v.replace(/^(\d{2})(\d)/g,"($1)$2"); //Coloca parênteses em volta dos dois primeiros dígitos
        v=v.replace(/(\d)(\d{4})$/,"$1-$2"); //Coloca hífen entre o quarto e o quinto dígitos
        return v;
    }
    function id( el ){
        return document.getElementById( el );
    }
    window.onload = function(){
        id('telefone').onkeyup = function(){
            mascara( this, mtel );
        }
        id('telefone2').onkeyup = function(){
            mascara( this, mtel );
        }
    }

    // FUNÇÃO QUE VALIDA O FORMULÁRIO
    function validaForm(){
        if(ordemServico.value==""){
            alert("campo O.S. em branco");
            return false;
        };
        if(nome.value==""){
            alert("campo Nome em branco");
            return false;
        };
        // Não permite cadastrar com os dois campos, defeito e novo defeito em branco
        if(select_defeito.value=="" && novoDefeito.value==""){
            alert("campo Defeito em branco");
            return false;
        };
        // Não permite cadastrar com os dois campos, defeito e novo defeito preenchidos
        if(select_defeito.value!="" && novoDefeito.value!=""){
            alert("campos Defeito e Novo Defdeito estão preenchidos");
            return false;
        };
        if(select_aparelho.value=="" && novoAparelho.value==""){
            alert("campos Aparelho e Novo Aparelho em branco");
            return false;
        };
         // Não permite cadastrar com os dois campos, aparelho e novo aparelho preenchidos
         if(select_aparelho.value!="" && novoAparelho.value!=""){
            alert("campos Aparelho e Novo Aparelho estão preenchidos");
            return false;
        };

        if(select_marca.value=="" && novaMarca.value==""){
            alert("campos Marca e Nova Marca em branco");
            return false;
        };
        if(select_marca.value!="" && novaMarca.value!=""){
            alert("campos Marca e Nova Marca em preenchidos");
            return false;
        };

        if(select_estado.value==""){
            alert("campo Estado em branco");
            return false;
        };
    };  

    // VALIDA OS CAMPOS DE ENTRADA DA PÁGINA duplicado.php
    function valida(){
                // retira os espaços para comparar o valor digitado
                if( cpfbusca.value.trim()==""){
                    alert("Campo de pesquuisa em branco");
                    cpfbusca.value='';
                    cpfbusca.focus();
                return false;
                };
            };
            function validaData(){
                if(data.value==""){
                    alert("Campo data de nascimento em branco");
                return false;
                };
            };
        function volta(){
            window.history.back();
        }

</script>
