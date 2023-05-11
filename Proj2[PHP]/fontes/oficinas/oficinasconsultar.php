<?php

require_once("../../funcoes/toolskit.php");
require_once("./oficinasfuncoes.php");

$bloco=( ISSET($_REQUEST['bloco']) ) ? $_REQUEST['bloco'] : 1 ;

iniciapagina("Consultar","oficinas");

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
    botoes("",FALSE,TRUE,2);
    break;
  }
}

terminapagina();

?>