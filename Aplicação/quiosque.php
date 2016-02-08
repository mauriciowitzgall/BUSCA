
<?php

include "includes.php";

include "cabecalho.html";
include "controle/conexao.php";

$quiosque=$_GET["quiosque"];
$i=$_GET["i"];


$sql="
SELECT * 
FROM $banco_nome[$i].quiosques 
JOIN $banco_nome[$i].cidades on (qui_cidade=cid_codigo)
JOIN  $banco_nome[$i].estados on (cid_estado=est_codigo)
WHERE qui_codigo=$quiosque

";
if (!$query=mysql_query($sql)) die("Erro SQL 1:".mysql_error());
while ($dados=mysql_fetch_assoc($query)) {
    $nome=$dados["qui_nome"];
    $cidade=$dados["cid_nome"];
    $estado=$dados["est_nome"];
    $fone1=$dados["qui_fone1"];
    $fone2=$dados["qui_fone2"];
    $endereco=$dados["qui_endereco"];
    $endereco_numero=$dados["qui_numero"];
    $endereco_complemento=$dados["qui_complemento"];
    $bairro=$dados["qui_vila"];
    $email=$dados["qui_email"];
    
}

$tpl= new Template("templates/cadastro1.html");

$tpl->block("BLOCK_QUEBRA");

//Nome
$tpl->COLUNA_TAMANHO="100px";
$tpl->COLUNA_ALINHAMENTO="right";
$tpl->TEXTO_CLASSE="negrito";
$tpl->TEXTO_VALOR="Quiosque: ";
$tpl->block("BLOCK_TEXTO");
$tpl->block("BLOCK_CONTEUDO");
$tpl->block("BLOCK_COLUNA");
$tpl->COLUNA_ALINHAMENTO="left";
$tpl->CAMPO_ESTILO="width:250px";
$tpl->block("BLOCK_CAMPO_ESTILO");
$tpl->CAMPO_TIPO="text";
$tpl->CAMPO_NOME="nome";
$tpl->CAMPO_TAMANHO="";
$tpl->CAMPO_VALOR="$nome";
$tpl->block("BLOCK_CAMPO_DESABILITADO");
$tpl->block("BLOCK_CAMPO_PADRAO");
$tpl->block("BLOCK_CAMPO");
$tpl->block("BLOCK_CONTEUDO");
$tpl->block("BLOCK_COLUNA");
$tpl->block("BLOCK_LINHA");

//Cidade
$tpl->COLUNA_TAMANHO="100px";
$tpl->COLUNA_ALINHAMENTO="right";
$tpl->TEXTO_VALOR="Cidade: ";
$tpl->block("BLOCK_TEXTO");
$tpl->block("BLOCK_CONTEUDO");
$tpl->block("BLOCK_COLUNA");
$tpl->COLUNA_ALINHAMENTO="left";
$tpl->CAMPO_ESTILO="width:200px";
$tpl->block("BLOCK_CAMPO_ESTILO");
$tpl->CAMPO_TIPO="text";
$tpl->CAMPO_NOME="cidade";
$tpl->CAMPO_TAMANHO="";
$tpl->CAMPO_VALOR="$cidade";
$tpl->block("BLOCK_CAMPO_DESABILITADO");
$tpl->block("BLOCK_CAMPO_PADRAO");
$tpl->block("BLOCK_CAMPO");
$tpl->block("BLOCK_CONTEUDO");
$tpl->block("BLOCK_COLUNA");
$tpl->block("BLOCK_LINHA");


//Bairro
$tpl->COLUNA_TAMANHO="100px";
$tpl->COLUNA_ALINHAMENTO="right";
$tpl->TEXTO_VALOR="Bairro: ";
$tpl->block("BLOCK_TEXTO");
$tpl->block("BLOCK_CONTEUDO");
$tpl->block("BLOCK_COLUNA");
$tpl->COLUNA_ALINHAMENTO="left";
$tpl->CAMPO_ESTILO="width:200px";
$tpl->block("BLOCK_CAMPO_ESTILO");
$tpl->CAMPO_TIPO="text";
$tpl->CAMPO_NOME="bairro";
$tpl->CAMPO_TAMANHO="";
$tpl->CAMPO_VALOR="$bairro";
$tpl->block("BLOCK_CAMPO_DESABILITADO");
$tpl->block("BLOCK_CAMPO_PADRAO");
$tpl->block("BLOCK_CAMPO");
$tpl->block("BLOCK_CONTEUDO");
$tpl->block("BLOCK_COLUNA");
$tpl->block("BLOCK_LINHA");

//Rua
$tpl->COLUNA_TAMANHO="100px";
$tpl->COLUNA_ALINHAMENTO="right";
$tpl->TEXTO_VALOR="Rua: ";
$tpl->block("BLOCK_TEXTO");
$tpl->block("BLOCK_CONTEUDO");
$tpl->block("BLOCK_COLUNA");
$tpl->COLUNA_ALINHAMENTO="left";
$tpl->CAMPO_ESTILO="width:255px";
$tpl->block("BLOCK_CAMPO_ESTILO");
$tpl->CAMPO_TIPO="text";
$tpl->CAMPO_NOME="rua";
$tpl->CAMPO_TAMANHO="";
$tpl->CAMPO_VALOR="$endereco ";
$tpl->block("BLOCK_CAMPO_DESABILITADO");
$tpl->block("BLOCK_CAMPO_PADRAO");
$tpl->block("BLOCK_CAMPO");
$tpl->block("BLOCK_CONTEUDO");
//Numero
$tpl->COLUNA_ALINHAMENTO="left";
$tpl->CAMPO_ESTILO="width:100px";
$tpl->block("BLOCK_CAMPO_ESTILO");
$tpl->CAMPO_TIPO="text";
$tpl->CAMPO_NOME="numero";
$tpl->CAMPO_TAMANHO="";
$tpl->CAMPO_VALOR="$endereco_numero ";
$tpl->block("BLOCK_CAMPO_DESABILITADO");
$tpl->block("BLOCK_CAMPO_PADRAO");
$tpl->block("BLOCK_CAMPO");
$tpl->block("BLOCK_CONTEUDO");
//Complemento
$tpl->COLUNA_ALINHAMENTO="left";
$tpl->CAMPO_ESTILO="width:175px";
$tpl->block("BLOCK_CAMPO_ESTILO");
$tpl->CAMPO_TIPO="text";
$tpl->CAMPO_NOME="complemento";
$tpl->CAMPO_TAMANHO="";
$tpl->CAMPO_VALOR="$endereco_complemento ";
$tpl->block("BLOCK_CAMPO_DESABILITADO");
$tpl->block("BLOCK_CAMPO_PADRAO");
$tpl->block("BLOCK_CAMPO");
$tpl->block("BLOCK_CONTEUDO");
$tpl->block("BLOCK_COLUNA");
$tpl->block("BLOCK_LINHA");

//Telefone 01
$tpl->COLUNA_TAMANHO="100px";
$tpl->COLUNA_ALINHAMENTO="right";
$tpl->TEXTO_VALOR="Telefone 01: ";
$tpl->block("BLOCK_TEXTO");
$tpl->block("BLOCK_CONTEUDO");
$tpl->block("BLOCK_COLUNA");
$tpl->COLUNA_ALINHAMENTO="left";
$tpl->CAMPO_ESTILO="width:130px";
$tpl->block("BLOCK_CAMPO_ESTILO");
$tpl->CAMPO_TIPO="text";
$tpl->CAMPO_NOME="fone1";
$tpl->CAMPO_TAMANHO="";
$tpl->CAMPO_VALOR="$fone1";
$tpl->block("BLOCK_CAMPO_DESABILITADO");
$tpl->block("BLOCK_CAMPO_PADRAO");
$tpl->block("BLOCK_CAMPO");
$tpl->block("BLOCK_CONTEUDO");
$tpl->block("BLOCK_COLUNA");
$tpl->block("BLOCK_LINHA");

//Telefone 02
$tpl->COLUNA_TAMANHO="100px";
$tpl->COLUNA_ALINHAMENTO="right";
$tpl->TEXTO_VALOR="Telefone 02: ";
$tpl->block("BLOCK_TEXTO");
$tpl->block("BLOCK_CONTEUDO");
$tpl->block("BLOCK_COLUNA");
$tpl->COLUNA_ALINHAMENTO="left";
$tpl->CAMPO_ESTILO="width:130px";
$tpl->block("BLOCK_CAMPO_ESTILO");
$tpl->CAMPO_TIPO="text";
$tpl->CAMPO_NOME="fone2";
$tpl->CAMPO_TAMANHO="";
$tpl->CAMPO_VALOR="$fone2";
$tpl->block("BLOCK_CAMPO_DESABILITADO");
$tpl->block("BLOCK_CAMPO_PADRAO");
$tpl->block("BLOCK_CAMPO");
$tpl->block("BLOCK_CONTEUDO");
$tpl->block("BLOCK_COLUNA");
$tpl->block("BLOCK_LINHA");

//E-mail
$tpl->COLUNA_TAMANHO="100px";
$tpl->COLUNA_ALINHAMENTO="right";
$tpl->TEXTO_VALOR="Email: ";
$tpl->block("BLOCK_TEXTO");
$tpl->block("BLOCK_CONTEUDO");
$tpl->block("BLOCK_COLUNA");
$tpl->COLUNA_ALINHAMENTO="left";
$tpl->CAMPO_ESTILO="width:300px";
$tpl->block("BLOCK_CAMPO_ESTILO");
$tpl->CAMPO_TIPO="text";
$tpl->CAMPO_NOME="email";
$tpl->CAMPO_TAMANHO="";
$tpl->CAMPO_VALOR="$email";
$tpl->block("BLOCK_CAMPO_DESABILITADO");
$tpl->block("BLOCK_CAMPO_PADRAO");
$tpl->block("BLOCK_CAMPO");
$tpl->block("BLOCK_CONTEUDO");
$tpl->block("BLOCK_COLUNA");
$tpl->block("BLOCK_LINHA");

$tpl->show();

//Botão voltar
$tpl= new Template("templates/botoes1.html");
$tpl->block("BLOCK_COLUNA_LINK_VOLTAR");
$tpl->block("BLOCK_COLUNA_LINK");
$tpl->block("BLOCK_BOTAOPADRAO_SIMPLES");
$tpl->block("BLOCK_BOTAOPADRAO_VOLTAR");
$tpl->block("BLOCK_BOTAOPADRAO");
$tpl->block("BLOCK_COLUNA");
$tpl->block("BLOCK_LINHA");
$tpl->block("BLOCK_BOTOES");
$tpl->show();



include "baixo.php";
?>
