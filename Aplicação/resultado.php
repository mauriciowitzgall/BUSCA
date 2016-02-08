
<?php

include "includes.php";
$tpl = new Template("templates/chamadas.html");

include "cabecalho.html";
include "controle/conexao.php";

$filtro_produto=$_POST["filtro_produto"];



$tpl = new Template("templates/linha_horizontal.html");
$tpl->block("BLOCK_HR");
$tpl->show();


//Inicio da listagem
$tpl_filtro = new Template("templates/filtro1.html");
$tpl_filtro->FORM_ONLOAD = "";
$tpl_filtro->FORM_LINK = "resultado.php";
$tpl_filtro->FORM_NOME = "form_filtro";
$tpl_filtro->block("BLOCK_FORM");

//Filtro Produto
$tpl_filtro->CAMPO_TITULO = "Nome do Produto";
$tpl_filtro->block("BLOCK_CAMPO_TITULO");
$tpl_filtro->CAMPO_TIPO = "text";
$tpl_filtro->CAMPO_QTDCARACTERES = "";
$tpl_filtro->CAMPO_NOME = "filtro_produto";
$tpl_filtro->CAMPO_TAMANHO = "50";
$tpl_filtro->CAMPO_VALOR = $filtro_produto;
$tpl_filtro->block("BLOCK_CAMPO_PADRAO");
$tpl_filtro->block("BLOCK_CAMPO");
$tpl_filtro->block("BLOCK_ESPACO");
$tpl_filtro->block("BLOCK_COLUNA");
$tpl_filtro->block("BLOCK_LINHA");

$tpl_filtro->block("BLOCK_FILTRO_CAMPOS");
$tpl_filtro->block("BLOCK_QUEBRA");
$tpl_filtro->show();

//BOTOES DE FILTRO
$tpl4 = new Template("templates/botoes1.html");
//Botão Pesquisar
$tpl4->COLUNA_TAMANHO = "100px";
$tpl4->COLUNA_ALINHAMENTO = "left";
$tpl4->block("BLOCK_BOTAOPADRAO_SUBMIT");
$tpl4->block("BLOCK_BOTAOPADRAO_PESQUISAR");
$tpl4->block("BLOCK_BOTAOPADRAO");
$tpl4->block("BLOCK_COLUNA");

//Botão Limpar filtro
$tpl4->COLUNA_LINK_ARQUIVO = "index.php";
$tpl4->COLUNA_LINK_TARGET = "";
$tpl4->COLUNA_TAMANHO = "";
$tpl4->COLUNA_ALINHAMENTO = "left";
$tpl4->block("BLOCK_COLUNA_LINK");
$tpl4->block("BLOCK_BOTAOPADRAO_SIMPLES");
$tpl4->block("BLOCK_BOTAOPADRAO_LIMPAR");
$tpl4->block("BLOCK_BOTAOPADRAO");
$tpl4->block("BLOCK_COLUNA");
$tpl4->block("BLOCK_LINHA");
$tpl4->block("BLOCK_BOTOES");
$tpl4->show();


//LISTAGEM
$tpl = new Template("templates/lista2.html");
$tpl->block("BLOCK_TABELA_CHEIA");

$tpl->CABECALHO_COLUNA_COLSPAN = "5";
$tpl->CABECALHO_COLUNA_TAMANHO = "";
$tpl->CABECALHO_COLUNA_NOME = "PRODUTO";
$tpl->block("BLOCK_CABECALHO_COLUNA");
$tpl->CABECALHO_COLUNA_COLSPAN = "2";
$tpl->CABECALHO_COLUNA_TAMANHO = "";
$tpl->CABECALHO_COLUNA_NOME = "QUANTIDADE";
$tpl->block("BLOCK_CABECALHO_COLUNA");
$tpl->CABECALHO_COLUNA_COLSPAN = "";
$tpl->CABECALHO_COLUNA_TAMANHO = "";
$tpl->CABECALHO_COLUNA_NOME = "VALOR UNITÁRIO MÉDIO";
$tpl->block("BLOCK_CABECALHO_COLUNA");
$tpl->CABECALHO_COLUNA_COLSPAN = "2";
$tpl->CABECALHO_COLUNA_TAMANHO = "";
$tpl->CABECALHO_COLUNA_NOME = "QUIOSQUE";
$tpl->block("BLOCK_CABECALHO_COLUNA");

$tpl->block("BLOCK_CABECALHO_LINHA");
$tpl->block("BLOCK_CABECALHO");


//Listagem

if ($filtro_produto!="") {
    $sql_filtro.=" and pro_nome like '%$filtro_produto%' ";
}

$sqlfil = ""; 
for ($i=1;$i<=$banco_qtd;$i++) {
    //(SELECT max(sai_datacadastro) FROM $banco_nome[$i].saidas JOIN $banco_nome[$i].saidas_produtos on sai_codigo=saipro_saida WHERE sai_quiosque=etq_quiosque and saipro_produto=pro_codigo) as ultima_venda
    $sqlfil.="
    SELECT pro_nome, SUM(etq_quantidade) as qtd , protip_sigla, AVG( etq_valorunitario ) valuni, pro_codigo,pro_tipocontagem,qui_nome,pro_marca,pro_volume, prorec_nome
    FROM $banco_nome[$i].produtos
    join $banco_nome[$i].estoque on (etq_produto=pro_codigo)
    left join $banco_nome[$i].produtos_recipientes on (pro_recipiente=prorec_codigo)
    left join $banco_nome[$i].quiosques on (etq_quiosque=qui_codigo)
    left JOIN $banco_nome[$i].produtos_tipo ON ( pro_tipocontagem = protip_codigo ) 
    WHERE 1
    $sql_filtro
    GROUP BY pro_codigo,etq_quiosque
    ";
    if ($i!=$banco_qtd) { $sqlfil.=" UNION "; }
}
$sql= "   
 SELECT * FROM (
    $sqlfil
 ) as todos
 ORDER BY pro_nome    
";

//Paginação
$query = mysql_query($sql);
if (!$query)
    die("Erro SQL Principal Paginação:" . mysql_error());
$linhas = mysql_num_rows($query);
$por_pagina = $usuario_paginacao;
$paginaatual = $_POST["paginaatual"];
$paginas = ceil($linhas / $por_pagina);
//Se é a primeira vez que acessa a pagina então começar na pagina 1
if (($paginaatual == "") || ($paginas < $paginaatual) || ($paginaatual <= 0)) {
    $paginaatual = 1;
}
$comeco = ($paginaatual - 1) * $por_pagina;
$tpl->PAGINAS = "$paginas";
$tpl->PAGINAATUAL = "$paginaatual";
$tpl->PASTA_ICONES = "$icones";
$tpl->block("BLOCK_PAGINACAO");
$sql = $sql . " LIMIT $comeco,$por_pagina ";


if (!$query=mysql_query($sql)) die("Erro SQL 1:".mysql_error());
while ($dados=mysql_fetch_assoc($query)) {
    $produto_codigo=$dados["pro_codigo"];
    $produto_nome=$dados["pro_nome"];
    $qtd = $dados["qtd"];
    $sigla = $dados["protip_sigla"];
    $valuni = $dados["valuni"];
    $produto = $dados["pro_codigo"];
    $tipo_contagem = $dados["pro_tipocontagem"];
    $quiosque_nome = $dados["qui_nome"];
    $marca = $dados["pro_marca"];
    $volume = $dados["pro_volume"];
    $recipiente = $dados["prorec_nome"];

    //Produto 
    //Código
    $tpl->COLUNA_TAMANHO = "";
    $tpl->COLUNA_ALINHAMENTO = "right";
    $tpl->TEXTO = "$produto";
    $tpl->block("BLOCK_TEXTO");
    $tpl->block("BLOCK_CONTEUDO");
    $tpl->block("BLOCK_COLUNA");
    //Nome 
    $tpl->COLUNA_TAMANHO = "";
    $tpl->COLUNA_ALINHAMENTO = "left";
    $tpl->TEXTO = "$produto_nome";
    $tpl->block("BLOCK_TEXTO");
    $tpl->block("BLOCK_CONTEUDO");
    $tpl->block("BLOCK_COLUNA");
    //Marca    
    $tpl->COLUNA_TAMANHO = "";
    $tpl->COLUNA_ALINHAMENTO = "left";
    $tpl->TEXTO = "$marca";
    $tpl->block("BLOCK_TEXTO");
    $tpl->block("BLOCK_CONTEUDO");
    $tpl->block("BLOCK_COLUNA");
    //Recipiente    
    $tpl->COLUNA_TAMANHO = "";
    $tpl->COLUNA_ALINHAMENTO = "left";
    $tpl->TEXTO = "$recipiente";
    $tpl->block("BLOCK_TEXTO");
    $tpl->block("BLOCK_CONTEUDO");
    $tpl->block("BLOCK_COLUNA");
    //Volume    
    $tpl->COLUNA_TAMANHO = "";
    $tpl->COLUNA_ALINHAMENTO = "left";
    $tpl->TEXTO = "$volume";
    $tpl->block("BLOCK_TEXTO");
    $tpl->block("BLOCK_CONTEUDO");
    $tpl->block("BLOCK_COLUNA");


    //Quantidade
    $tpl->COLUNA_TAMANHO = "";
    $tpl->COLUNA_ALINHAMENTO = "right";
    if ($tipo_contagem == 1)
        $tpl->TEXTO = number_format($qtd, 0);
    else
        $tpl->TEXTO = number_format($qtd, 3, ',', '.');
    $tpl->block("BLOCK_TEXTO");
    $tpl->block("BLOCK_CONTEUDO");
    $tpl->block("BLOCK_COLUNA");
    $tpl->COLUNA_TAMANHO = "";
    $tpl->COLUNA_ALINHAMENTO = "";
    $tpl->TEXTO = "$sigla";
    $tpl->block("BLOCK_TEXTO");
    $tpl->block("BLOCK_CONTEUDO");
    $tpl->block("BLOCK_COLUNA");

    //Valor Unitario Médio
    $tpl->COLUNA_TAMANHO = "";
    $tpl->COLUNA_ALINHAMENTO = "right";
    $tpl->TEXTO = "R$ " . number_format($valuni, 2, ',', '.');
    $tpl->block("BLOCK_TEXTO");
    $tpl->block("BLOCK_CONTEUDO");
    $tpl->block("BLOCK_COLUNA");

    //Quiosque
    $tpl->COLUNA_TAMANHO = "";
    $tpl->COLUNA_ALINHAMENTO = "right";
    $tpl->TEXTO = "$quiosque_nome";
    $tpl->block("BLOCK_TEXTO");
    $tpl->block("BLOCK_CONTEUDO");
    $tpl->block("BLOCK_COLUNA");
    $tpl->COLUNA_ALINHAMENTO = "left";
    $tpl->CONTEUDO_LINK_ARQUIVO = "quiosque.php?produto=$produto_codigo";
    $tpl->block("BLOCK_CONTEUDO_LINK");
    $tpl->ICONE_TAMANHO = "15px";
    $tpl->ICONE_NOMEARQUIVO = "procurar.png";
    $tpl->ICONE_CAMINHO = "$icones";
    $tpl->ICONE_DICA = "Visualizar Detalhes";
    $tpl->ICONE_NOMEALTERNATIVO = "Ver";
    $tpl->block("BLOCK_ICONE");
    $tpl->block("BLOCK_CONTEUDO");
    $tpl->block("BLOCK_COLUNA");

    
    $tpl->block("BLOCK_LINHA_PADRAO");
    $tpl->block("BLOCK_LINHA");
    
}

$tpl->block("BLOCK_CORPO");
$tpl->block("BLOCK_LISTAGEM");
$tpl->show();

include "baixo.php";
?>
