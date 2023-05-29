<?php

require_once("../../funcoes/catalogo.php");
require_once("./oficinasfuncoes.php");

$bloco=( ISSET($_REQUEST['bloco']) ) ? $_REQUEST['bloco'] : 1;
$sair=$_REQUEST['sair']+1;
$menu=$_REQUEST['sair'];

iniciapagina(TRUE,"Oficinas","oficinas","Consultar");
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

terminapagina("Oficinas","Consultar","oficinasconsultar.php");

?>