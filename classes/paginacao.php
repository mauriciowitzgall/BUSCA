<?php

class geral {
    function paginar($sql,$por_pagina,$paginaatual) {
        $qry = mysql_query($sql) or die($this->erro(mysql_error()));
        $linhas = mysql_num_rows($qry);
        $paginas = ceil($linhas / $por_pagina);
        //Se é a primeira vez que acessa a pagina então começar na pagina 1
        if (($paginaatual == "") || ($paginas < $paginaatual) || ($paginaatual <= 0)) {
            $paginaatual = 1;
        }
        $comeco = ($paginaatual - 1) * $por_pagina;
        return array($paginas, $comeco);
    }

}

?>
