<?php

class banco {

    //private $host = "localhost";
    //private $user = "root";
    //private $pass = "";

    function conectar() {
        $con = mysql_connect($host, $user, $pass) or die($this->erro(mysql_error()));
        return $con;
    }

    function desconecta() {
        mysql_close();
    }

    function selecionar($banco) {
        $sel = mysql_select_db($banco) or die($this->erro(mysql_error()));
        if ($sel) {
            return true;
        } else {
            return false;
        }
    }

    function query($sql) {
        $this->acentos();
        $qry = mysql_query($sql) or die($this->erro(mysql_error()));
        return $qry;
    }

    function dados($sql) {
        $this->acentos();
        $dados = mysql_fetch_array($this->query($sql));
        return $dados;
    }

    function set($prop, $value) {
        $this->$prop = $value;
    }

    function erro($erro) {
        echo $erro;
    }

    function acentos() {
        mysql_query("SET NAMES 'utf8'");
        mysql_query('SET character_set_connection=utf8');
        mysql_query('SET character_set_client=utf8');
        mysql_query('SET character_set_results=utf8');
    }

}

?>
