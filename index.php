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

/*
  //Campo para pesquisa de produto
  $tpl = new Template("templates/cadastro1.html");
  $tpl->FORM_NOME = "";
  $tpl->FORM_TARGET = "";
  $tpl->FORM_LINK = "resultado.php";
  $tpl->block("BLOCK_FORM");
  $tpl->COLUNA_ALINHAMENTO = "center";
  $tpl->COLUNA_TAMANHO = "";
  $tpl->CAMPO_TIPO = "text";
  $tpl->CAMPO_NOME = "produto";
  $tpl->CAMPO_VALOR = "";
  $tpl->CAMPO_TAMANHO = "60";
  $tpl->CAMPO_DICA = "Digite aqui o nome do produto";
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
 */

$tpl = new Template("templates/titulosimples.html");
//$tpl->block("BLOCK_CENTRALIZAR");
$tpl->LISTA_TITULO = "PONTOS DE VENDA:";
$tpl->block("BLOCK_TITULO");
$tpl->show();


$tpl = new Template("templates/lista_inicio.html");
$obj = new banco; // Instanciando a classe
$obj->conectar();
//Seleciona os pontos de vendas
$sql = "
    SELECT qui_codigo, qui_nome, cid_nome, est_sigla 
    FROM quiosques
    join cidades on (cid_codigo=qui_cidade)
    join estados on (est_codigo=cid_estado)
    WHERE qui_disponivelnobusca = 1
";
//Define quais bancos serão consultador

$obj->selecionarDB($db[0]);
$rs[0] = $obj->query($sql);
$obj->selecionarDB($db[1]);
$rs[1] = $obj->query($sql);

$obj->desconecta();
//Faz a mesma consulta em todos os bancos definidos acima
$itens_por_linha = 6;
for ($i = 0; $i <= 1; $i++) {
    $coluna = 1;
    while ($dados = mysql_fetch_assoc($rs[$i])) {
        $quiosque_codigo = $dados["qui_codigo"];
        $quiosque_nome = $dados["qui_nome"];
        $cidade_nome = $dados["cid_nome"];
        $estado_sigla = $dados["est_sigla"];

        $tpl->LINHA_CLASSE = "";
        $tpl->block("BLOCK_LINHA_DINAMICA");
        //$tpl->COLUNA_ROWSPAN = "";
        //$tpl->COLUNA_COLSPAN = "";
        $tpl->COLUNA_TAMANHO = "150px";
        $tpl->COLUNA_ALINHAMENTO = "center";
        $tpl->block("BLOCK_COLUNA_ICONES");
        //$tpl->block("BLOCK_CONTEUDO_LINK_NOVAJANELA");
        //$tpl->CONTEUDO_LINK_ARQUIVO = "#";
        //$tpl->ICONE_NOMEARQUIVO = "pontovenda_desabilitado.png";
        //$tpl->ICONE_DICA = "Em manutenção";

        $tpl->CONTEUDO_LINK_ARQUIVO = "resultado.php?pv=$quiosque_codigo&db=$db[$i]";
        $tpl->ICONE_NOMEARQUIVO = "pontovenda.png";
        $tpl->ICONE_DICA = "Ponto de Venda";
        $tpl->block("BLOCK_CONTEUDO_LINK");
        $tpl->ICONE_TAMANHO = "50px";
        $tpl->ICONE_CAMINHO = "imagens/";


        $tpl->ICONE_NOMEALTERNATIVO = "$nome";
        $tpl->block("BLOCK_ICONE");
        $tpl->block("BLOCK_QUEBRA");
        $tpl->block("BLOCK_CONTEUDO");
        $tpl->TEXTO_CLASSE = "";
        $tpl->TEXTO = "$quiosque_nome";
        $tpl->block("BLOCK_TEXTO");
        $tpl->block("BLOCK_QUEBRA");
        $tpl->block("BLOCK_CONTEUDO");
        $tpl->TEXTO_CLASSE = "texto2";
        $tpl->TEXTO = "$cidade_nome / $estado_sigla";
        $tpl->block("BLOCK_TEXTO");
        $tpl->block("BLOCK_CONTEUDO");
        $tpl->block("BLOCK_CONTEUDO");
        $tpl->block("BLOCK_COLUNA");

        //Se o item a ser mostrado chegou no limite definido chama a próxima linha
        if ($coluna % $itens_por_linha == 0) {
            $tpl->block("BLOCK_LINHA");
        }
        $coluna++;
    }
}
$tpl->block("BLOCK_LINHA");
$tpl->block("BLOCK_CORPO");
$tpl->block("BLOCK_LISTAGEM");
$tpl->show();

include "rodape_ecosolitec.php";
include "baixo.php";
?>
