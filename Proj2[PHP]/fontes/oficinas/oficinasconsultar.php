<?php

require_once("../../funcoes/toolskit.php");
require_once("./oficinasfuncoes.php");

$bloco=( ISSET($_REQUEST['bloco']) ) ? $_REQUEST['bloco'] : 1 ;
$sair=( ISSET($_REQUEST['sair']) ) ? $_REQUEST['sair'] : 0 ;
$menu=( ISSET($_REQUEST['menu']) ) ? $_REQUEST['menu'] : 0 ;

iniciapagina("Consultar","oficinas");
montamenu("Consultar",$sair);

switch(true)
{
  case ($bloco==1):
  {
    picklist("Consultar");
    break;
  }
  case ($bloco==2):
  { 
    mostraregistro($_REQUEST['pkoficina']);
    botoes("",FALSE,TRUE);
    break;
  }
}

terminapagina();

?>