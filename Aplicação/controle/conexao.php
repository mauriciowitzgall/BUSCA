<?php 
$hostname = "localhost";
$db = "sgaf";
$user = "root";
$pass = "";

$link = mysql_connect($hostname, $user, $pass);
if (!$link) {
    echo "Não foi possivel conectar ao Banco de Dados! Descrição do erro:".mysql_error();
    exit;
}
mysql_select_db($db, $link);
mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');

$usuario_paginacao="15";
$icones="imagens/";

 ?>