<?php

include "includes.php";

$tpl = new Template("templates/quebra.html");
$tpl->block("BLOCK_QUEBRA");
$tpl->show();

$tpl = new Template("templates/imagem.html");
$tpl->block("BLOCK_CENTRALIZAR");
$tpl->block("BLOCK_IMG");
$tpl->IMG_PASTA = "imagens/";
$tpl->IMG_ARQUIVO = "logo_buscaecosoli.png";
$tpl->IMG_TAMANHO = "250px";
$tpl->IMG_DICA = "Busca Ecosoli";
$tpl->show();

$tpl = new Template("templates/tituloemlinha_2.html");
$tpl->block("BLOCK_QUEBRA1");
$tpl->block("BLOCK_CENTRALIZAR");
$tpl->LISTA_TITULO = "PORTAL DE BUSCA DE PRODUTOS DA ECONOMIA SOLIDARIA";
$tpl->block("BLOCK_TITULO");
$tpl->block("BLOCK_QUEBRA2");
$tpl->show();


//Campo para pesquisa de produto
$tpl = new Template("templates/cadastro1.html");
$tpl->FORM_NOME = "";
$tpl->FORM_TARGET = "";
$tpl->FORM_LINK = "resultado.php";
$tpl->block("BLOCK_FORM");
$tpl->COLUNA_ALINHAMENTO = "center";
$tpl->COLUNA_TAMANHO = "";
$tpl->CAMPO_TIPO = "text";
$tpl->CAMPO_NOME = "filtro_produto";
$tpl->CAMPO_VALOR = "";
$tpl->CAMPO_TAMANHO = "50";
$tpl->CAMPO_DICA = "";
$tpl->block("BLOCK_CAMPO_OBRIGATORIO");
$tpl->block("BLOCK_CAMPO_PADRAO");
$tpl->block("BLOCK_CAMPO_AUTOFOCO");
$tpl->block("BLOCK_CAMPO");
$tpl->block("BLOCK_CONTEUDO");
$tpl->block("BLOCK_COLUNA");
$tpl->block("BLOCK_LINHA");
//$tpl->block("BLOCK_FECHARFORM");
$tpl->show();


$tpl2 = new Template("templates/botoes1.html");
//$tpl2->COLUNA_TAMANHO = "";
$tpl2->COLUNA_ALINHAMENTO = "center";
//$tpl2->BOTAO_TECLA = "";
$tpl2->BOTAO_TIPO = "submit";
$tpl2->BOTAO_VALOR = "PROCURAR";
$tpl2->BOTAO_NOME = "";
//$tpl2->BOTAO_ID = "";
//$tpl2->BOTAO_DICA = "";
//$tpl2->BOTAO_ONCLICK = "";
//$tpl2->BOTAOPADRAO_CLASSE = "";
$tpl2->block("BLOCK_BOTAO_PADRAO");
//$tpl2->BOTAO_CLASSE = "";
//$tpl2->block("BLOCK_BOTAO_DINAMICO");
//$tpl2->block("BLOCK_BOTAO_DESABILITADO");
//$tpl2->block("BLOCK_BOTAO_AUTOFOCO");
$tpl2->block("BLOCK_BOTAO");
$tpl2->block("BLOCK_COLUNA");
$tpl2->block("BLOCK_LINHA");
$tpl2->block("BLOCK_BOTOES");
$tpl2->block("BLOCK_FECHARFORM");
$tpl2->show();

$tpl = new Template("templates/linha_horizontal.html");
$tpl->block("BLOCK_HR");
$tpl->show();
 
include "rodape_ecosolitec.php";
include "baixo.php";
?>
