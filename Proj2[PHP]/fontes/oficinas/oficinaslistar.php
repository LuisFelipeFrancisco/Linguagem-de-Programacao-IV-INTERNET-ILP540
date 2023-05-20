<?php

require_once("../../funcoes/catalogo.php");
require_once("./oficinasfuncoes.php");

$bloco=( ISSET($_REQUEST['bloco']) ) ? $_REQUEST['bloco'] : 1;
$sair= ( ISSET($_REQUEST['sair']) ) ? $_REQUEST['sair']+1 : 0;
$menu= ( ISSET($_REQUEST['sair']) ) ? $_REQUEST['sair'] : 1;

iniciapagina(TRUE,"Oficinas","oficinas","Listar");
montamenu("Listar",$sair);

terminapagina("Oficinas","Listar","oficinasconsultar.php");

?>