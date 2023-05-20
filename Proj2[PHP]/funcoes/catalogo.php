<?php

function iniciapagina($fundo,$tittab,$tabela,$acao)
{ 
  printf("<html>\n");
  printf("<head>\n");
  printf("<title>$tabela-$acao</title>\n");
  printf("<link rel='stylesheet' href='./$tabela.css'>\n");
  printf("</head>\n");
  printf($fundo ? " <body class='$acao'>\n" : " <body>\n");
}

function terminapagina($tabela,$acao,$prg)
{
  printf("<hr>$tabela %s | &copy; ".date('Y')." - LFFFF - FATEC - 4ºADS | $prg",$acao? " - ".$acao : "");
  printf("</body>\n");
  printf("</html>");
}

function conectamariadb($server,$username,$senha,$dbname)
{ 
  global $link;
  $link=mysqli_connect($server,$username,$senha,$dbname);
}

conectamariadb("localhost","root","","ilp540");

?>