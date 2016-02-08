
<?php
//Biblioteca necessário para funcionar os templates
require "templates/Template.class.php";

//Classes

include "classes/banco.php";
include "classes/paginacao.php";


include "controle/bancos.php";
include "controle/conexao.php";

//Cabeçalho e estrutura html inicial da estrutura da pagina
include "templates/topo.html";
?>
<link rel="stylesheet" type="text/css" href="templates/templates.css" />
<script type="text/javascript" src="js/paginacao.js"></script>
<script type="text/javascript" src="js/jquery-1.3.2.js"></script>
