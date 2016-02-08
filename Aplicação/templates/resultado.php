<?php

include "includes.php";
$tpl = new Template("templates/chamadas.html");

include "cabecalho.html";

//Pega valores do formulário ou lista de pontos de venda
if (!$pontodevenda = $_GET["pv"])
    $pontodevenda = $_POST["pv"];
if (!$db = $_GET["db"])
    $db = $_POST["db"];

if (!$filtro_produto = $_POST["filtro_produto"])
    $filtro_produto = $_GET["filtro_produto"];
if (!$filtro_categoria = $_POST["filtro_categoria"])
    $filtro_categoria = $_GET["filtro_categoria"];

$obj = new banco();
$obj->conectar();
$obj->selecionarDB($db);
$sql = "
    SELECT qui_nome, coo_codigo, coo_abreviacao, cid_nome, est_sigla, qui_fone1, qui_fone2, qui_email
    FROM quiosques
    JOIN cooperativas ON ( qui_cooperativa = coo_codigo ) 
    JOIN cidades ON ( qui_cidade = cid_codigo ) 
    JOIN estados ON ( cid_estado = est_codigo ) 
    WHERE qui_codigo =$pontodevenda
";
$dados = $obj->dados($sql);
$pontodevenda_nome = $dados["qui_nome"];
$cooperativa_nome = $dados["coo_abreviacao"];
$cooperativa = $dados["coo_codigo"];
$cidade_nome = $dados["cid_nome"];
$estado_sigla = $dados["est_sigla"];
$email = $dados["qui_email"];
$fone1 = $dados["qui_fone1"];
$fone2 = $dados["qui_fone2"];
if (($fone1 != "") && ($fone2 != ""))
    $telefones = "$fone1 ou $fone2";
else
    $telefones = "$fone1 $fone2";
$obj->desconecta();


//FORMULÁRIO
$tpl = new Template("templates/cadastro1.html");
//$tpl->FORM_NOME = "";
//$tpl->FORM_TARGET = "";
//$tpl->FORM_LINK = "";
//$tpl->block("BLOCK_FORM");
$tpl->COLUNA_TAMANHO = "";

//Pontos de Venda
$tpl->COLUNA_ALINHAMENTO = "right";
$tpl->TITULO = "Ponto de Venda";
$tpl->block("BLOCK_TITULO");
$tpl->block("BLOCK_CONTEUDO");
$tpl->block("BLOCK_COLUNA");
$tpl->COLUNA_ALINHAMENTO = "left";
//$tpl->COLUNA_TAMANHO = "";
$tpl->CAMPO_TIPO = "text";
$tpl->CAMPO_NOME = "pontovenda";
$tpl->CAMPO_VALOR = "$pontodevenda_nome";
$tpl->CAMPO_TAMANHO = "30";
//$tpl->block("BLOCK_CAMPO_OBRIGATORIO");
$tpl->block("BLOCK_CAMPO_PADRAO");
//$tpl->block("BLOCK_CAMPO_AUTOFOCO");
$tpl->block("BLOCK_CAMPO_DESABILITADO");
$tpl->block("BLOCK_CAMPO");
$tpl->block("BLOCK_CONTEUDO");
$tpl->block("BLOCK_COLUNA");


//Cooperativa
$tpl->COLUNA_ALINHAMENTO = "right";
$tpl->TITULO = "Grupo";
$tpl->block("BLOCK_TITULO");
$tpl->block("BLOCK_CONTEUDO");
$tpl->block("BLOCK_COLUNA");
$tpl->COLUNA_ALINHAMENTO = "left";
//$tpl->COLUNA_TAMANHO = "";
$tpl->CAMPO_TIPO = "text";
$tpl->CAMPO_NOME = "cooperativa";
$tpl->CAMPO_VALOR = "$cooperativa_nome";
$tpl->CAMPO_TAMANHO = "30";
//$tpl->block("BLOCK_CAMPO_OBRIGATORIO");
$tpl->block("BLOCK_CAMPO_PADRAO");
//$tpl->block("BLOCK_CAMPO_AUTOFOCO");
$tpl->block("BLOCK_CAMPO_DESABILITADO");
$tpl->block("BLOCK_CAMPO");
$tpl->block("BLOCK_CONTEUDO");
$tpl->block("BLOCK_COLUNA");


//Cidade
$tpl->COLUNA_ALINHAMENTO = "right";
$tpl->TITULO = "Cidade";
$tpl->block("BLOCK_TITULO");
$tpl->block("BLOCK_CONTEUDO");
$tpl->block("BLOCK_COLUNA");
$tpl->COLUNA_ALINHAMENTO = "left";
//$tpl->COLUNA_TAMANHO = "";
$tpl->CAMPO_TIPO = "text";
$tpl->CAMPO_NOME = "cidade";
$tpl->CAMPO_VALOR = "$cidade_nome";
$tpl->CAMPO_TAMANHO = "30";
//$tpl->block("BLOCK_CAMPO_OBRIGATORIO");
$tpl->block("BLOCK_CAMPO_PADRAO");
//$tpl->block("BLOCK_CAMPO_AUTOFOCO");
$tpl->block("BLOCK_CAMPO_DESABILITADO");
$tpl->block("BLOCK_CAMPO");
$tpl->block("BLOCK_CONTEUDO");
$tpl->block("BLOCK_COLUNA");
$tpl->block("BLOCK_LINHA");


//E-mail
$tpl->COLUNA_ALINHAMENTO = "right";
$tpl->TITULO = "E-mail";
$tpl->block("BLOCK_TITULO");
$tpl->block("BLOCK_CONTEUDO");
$tpl->block("BLOCK_COLUNA");
$tpl->COLUNA_ALINHAMENTO = "left";
//$tpl->COLUNA_TAMANHO = "";
$tpl->CAMPO_TIPO = "text";
$tpl->CAMPO_NOME = "email";
$tpl->CAMPO_VALOR = "$email";
$tpl->CAMPO_TAMANHO = "30";
//$tpl->block("BLOCK_CAMPO_OBRIGATORIO");
$tpl->block("BLOCK_CAMPO_PADRAO");
//$tpl->block("BLOCK_CAMPO_AUTOFOCO");
$tpl->block("BLOCK_CAMPO_DESABILITADO");
$tpl->block("BLOCK_CAMPO");
$tpl->block("BLOCK_CONTEUDO");
$tpl->block("BLOCK_COLUNA");

//Telefone
$tpl->COLUNA_ALINHAMENTO = "right";
$tpl->TITULO = "Telefones";
$tpl->block("BLOCK_TITULO");
$tpl->block("BLOCK_CONTEUDO");
$tpl->block("BLOCK_COLUNA");
$tpl->COLUNA_ALINHAMENTO = "left";
//$tpl->COLUNA_TAMANHO = "";
$tpl->CAMPO_TIPO = "text";
$tpl->CAMPO_NOME = "telefone";
$tpl->CAMPO_VALOR = "$telefones";
$tpl->CAMPO_TAMANHO = "30";
//$tpl->block("BLOCK_CAMPO_OBRIGATORIO");
$tpl->block("BLOCK_CAMPO_PADRAO");
//$tpl->block("BLOCK_CAMPO_AUTOFOCO");
$tpl->block("BLOCK_CAMPO_DESABILITADO");
$tpl->block("BLOCK_CAMPO");
$tpl->block("BLOCK_CONTEUDO");
$tpl->block("BLOCK_COLUNA");
$tpl->block("BLOCK_LINHA");

$tpl->show();

$tpl = new Template("templates/linha_horizontal.html");
$tpl->block("BLOCK_HR");
$tpl->show();

/*
  $tpl = new Template("templates/titulosimples.html");
  //$tpl->block("BLOCK_CENTRALIZAR");
  $tpl->LISTA_TITULO = "PRODUTOS:";
  $tpl->block("BLOCK_TITULO");
  $tpl->show();
 */

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

//Filtro Categoria
$tpl_filtro->CAMPO_TITULO = "Categoria";
$tpl_filtro->block("BLOCK_CAMPO_TITULO");
$tpl_filtro->SELECT_NOME = "filtro_categoria";
//$tpl_filtro->SELECT_ID = "";
//$tpl_filtro->SELECT_TAMANHO = "";
$tpl_filtro->block("BLOCK_SELECT_FILTRO");
$tpl_filtro->block("BLOCK_OPTION_PADRAO");
$obj = new banco();
$obj->conectar();
$obj->selecionarDB($db);
$sql = "
    SELECT cat_codigo, cat_nome
    FROM produtos_categorias    
    WHERE cat_cooperativa=$cooperativa
    ORDER BY cat_nome
";
$query = $obj->query($sql);
while ($dados = mysql_fetch_array($query)) {
    $codigo = $dados["cat_codigo"];
    $tpl_filtro->OPTION_VALOR = $dados["cat_codigo"];
    $tpl_filtro->OPTION_TEXTO = $dados["cat_nome"];
    if ($codigo == $filtro_categoria)
        $tpl_filtro->block("BLOCK_OPTION_SELECIONADO");
    $tpl_filtro->block("BLOCK_OPTION");
}
$tpl_filtro->block("BLOCK_SELECT");
$tpl_filtro->block("BLOCK_ESPACO");
$tpl_filtro->block("BLOCK_COLUNA");

$tpl_filtro->block("BLOCK_LINHA");

//Campo oculto banco
$tpl_filtro->CAMPOOCULTO_NOME = "db";
$tpl_filtro->CAMPOOCULTO_VALOR = "$db";
$tpl_filtro->block("BLOCK_CAMPOOCULTO");
//Campo oculto ponto de venda
$tpl_filtro->CAMPOOCULTO_NOME = "pv";
$tpl_filtro->CAMPOOCULTO_VALOR = "$pontodevenda";
$tpl_filtro->block("BLOCK_CAMPOOCULTO");


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
$tpl4->COLUNA_LINK_ARQUIVO = "resultado.php?db=$db&pv=$pontodevenda";
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
$tpl2 = new Template("templates/lista2.html");
$tpl2->block("BLOCK_TABELA_CHEIA");

$tpl2->CABECALHO_COLUNA_COLSPAN = "2";
$tpl2->CABECALHO_COLUNA_TAMANHO = "";
$tpl2->CABECALHO_COLUNA_NOME = "PRODUTO";
$tpl2->block("BLOCK_CABECALHO_COLUNA");
$tpl2->CABECALHO_COLUNA_COLSPAN = "2";
$tpl2->CABECALHO_COLUNA_TAMANHO = "";
$tpl2->CABECALHO_COLUNA_NOME = "QUANTIDADE";
$tpl2->block("BLOCK_CABECALHO_COLUNA");
$tpl2->CABECALHO_COLUNA_COLSPAN = "";
$tpl2->CABECALHO_COLUNA_TAMANHO = "";
$tpl2->CABECALHO_COLUNA_NOME = "VALOR UNITÁRIO MÉDIO";
$tpl2->block("BLOCK_CABECALHO_COLUNA");
$tpl2->CABECALHO_COLUNA_COLSPAN = "";
$tpl2->CABECALHO_COLUNA_TAMANHO = "";
$tpl2->CABECALHO_COLUNA_NOME = "CATEGORIA";
$tpl2->block("BLOCK_CABECALHO_COLUNA");

$tpl2->block("BLOCK_CABECALHO_LINHA");
$tpl2->block("BLOCK_CABECALHO");


$sql_filtro = "";
if (!empty($filtro_produto))
    $sql_filtro = $sql_filtro . " and pro_nome like '%$filtro_produto%' ";
if (!empty($filtro_categoria))
    $sql_filtro = $sql_filtro . " and cat_codigo = $filtro_categoria";

$sql = "
    SELECT pro_nome, SUM(etq_quantidade) as qtd , protip_sigla, AVG( etq_valorunitario ) valuni, cat_nome, pro_codigo, cat_codigo,pro_tipocontagem
    FROM produtos 
    left join estoque on ( etq_produto = pro_codigo ) 
    JOIN produtos_categorias ON ( pro_categoria = cat_codigo ) 
    JOIN produtos_tipo ON ( pro_tipocontagem = protip_codigo ) 
    WHERE pro_cooperativa =$cooperativa $sql_filtro
    GROUP BY pro_codigo
    ORDER BY pro_nome
";

//Paginação
$obj2 = new geral();
$por_pagina = 10;
//Pega o valor da pagina atual via get ou post
if (!$paginaatual = $_POST["paginaatual"])
    $paginaatual = $_GET["paginaatual"];
list ($paginas, $comeco) = $obj2->paginar($sql, $por_pagina, $paginaatual);
$retroceder=$_GET["retroceder"];
$avancar=$_GET["avancar"];

if ($paginaatual>$paginas)
    $paginaatual=$paginas;
if ($paginaatual<1)
    $paginaatual=1;
if ($retroceder == 1) {
    if (($paginaatual == "") || ($paginaatual <= 1))
        $paginaatual = 1;
    else
        $paginaatual = $paginaatual - 1;
}
if ($avancar == 1) {
    if ($paginaatual >= $paginas)
        $paginaatual = $paginas;
    else
        $paginaatual = $paginaatual + 1;
}
list ($paginas, $comeco) = $obj2->paginar($sql, $por_pagina, $paginaatual);
$tpl2->PAGINAS = "$paginas";
$tpl2->PAGINAATUAL = "$paginaatual";
$tpl2->PASTA_ICONES = "imagens/";
$tpl2->LINK_PASTA="";
$tpl2->LINK_ARQUIVO_RETROCEDER = "resultado.php?pv=$pontodevenda&db=$db&filtro_produto=$filtro_produto&filtro_categoria=$filtro_categoria&paginaatual=$paginaatual&retroceder=1";
$tpl2->LINK_ARQUIVO_AVANCAR = "resultado.php?pv=$pontodevenda&db=$db&filtro_produto=$filtro_produto&filtro_categoria=$filtro_categoria&paginaatual=$paginaatual&avancar=1";
$tpl2->block("BLOCK_PAGINACAO");
$sql = $sql . " LIMIT $comeco,$por_pagina ";

$query = $obj->query($sql);
while ($dados = mysql_fetch_assoc($query)) {
    $produto_nome = $dados["pro_nome"];
    $qtd = $dados["qtd"];
    $sigla = $dados["protip_sigla"];
    $valuni = $dados["valuni"];
    $categoria_nome = $dados["cat_nome"];
    $produto = $dados["pro_codigo"];
    $categoria = $dados["cat_codigo"];
    $tipo_contagem = $dados["pro_tipocontagem"];

    //Produto    
    $tpl2->COLUNA_TAMANHO = "";
    $tpl2->COLUNA_ALINHAMENTO = "right";
    $tpl2->TEXTO = "$produto";
    $tpl2->block("BLOCK_TEXTO");
    $tpl2->block("BLOCK_CONTEUDO");
    $tpl2->block("BLOCK_COLUNA");
    $tpl2->COLUNA_TAMANHO = "";
    $tpl2->COLUNA_ALINHAMENTO = "";
    $tpl2->TEXTO = "$produto_nome";
    $tpl2->block("BLOCK_TEXTO");
    $tpl2->block("BLOCK_CONTEUDO");
    $tpl2->block("BLOCK_COLUNA");

    //Quantidade
    $tpl2->COLUNA_TAMANHO = "";
    $tpl2->COLUNA_ALINHAMENTO = "right";
    if ($tipo_contagem == 1)
        $tpl2->TEXTO = number_format($qtd, 0);
    else
        $tpl2->TEXTO = number_format($qtd, 3, ',', '.');
    $tpl2->block("BLOCK_TEXTO");
    $tpl2->block("BLOCK_CONTEUDO");
    $tpl2->block("BLOCK_COLUNA");
    $tpl2->COLUNA_TAMANHO = "";
    $tpl2->COLUNA_ALINHAMENTO = "";
    $tpl2->TEXTO = "$sigla";
    $tpl2->block("BLOCK_TEXTO");
    $tpl2->block("BLOCK_CONTEUDO");
    $tpl2->block("BLOCK_COLUNA");

    //Valor Unitario Médio
    $tpl2->COLUNA_TAMANHO = "";
    $tpl2->COLUNA_ALINHAMENTO = "right";
    $tpl2->TEXTO = "R$ " . number_format($valuni, 2, ',', '.');
    $tpl2->block("BLOCK_TEXTO");
    $tpl2->block("BLOCK_CONTEUDO");
    $tpl2->block("BLOCK_COLUNA");

    //Categoria
    $tpl2->COLUNA_TAMANHO = "";
    $tpl2->COLUNA_ALINHAMENTO = "";
    $tpl2->TEXTO = "$categoria_nome";
    $tpl2->block("BLOCK_TEXTO");
    $tpl2->block("BLOCK_CONTEUDO");
    $tpl2->block("BLOCK_COLUNA");

    $tpl2->block("BLOCK_LINHA_PADRAO");
    $tpl2->block("BLOCK_LINHA");
}

$tpl2->block("BLOCK_CORPO");
$tpl2->block("BLOCK_LISTAGEM");
$tpl2->show();



//BOTOES DE FILTRO
$tpl4 = new Template("templates/botoes1.html");
//Botão Voltar
$tpl4->COLUNA_LINK_ARQUIVO = "index.php";
$tpl4->COLUNA_LINK_TARGET = "";
$tpl4->COLUNA_TAMANHO = "";
$tpl4->COLUNA_ALINHAMENTO = "left";
$tpl4->block("BLOCK_COLUNA_LINK");
$tpl4->block("BLOCK_BOTAOPADRAO_SIMPLES");
$tpl4->block("BLOCK_BOTAOPADRAO_VOLTAR");
$tpl4->block("BLOCK_BOTAOPADRAO");
$tpl4->block("BLOCK_COLUNA");
$tpl4->block("BLOCK_LINHA");
$tpl4->block("BLOCK_BOTOES");


$tpl4->show();


include "baixo.php";
?>
