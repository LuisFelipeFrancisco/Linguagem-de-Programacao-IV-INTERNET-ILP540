<?php
function iniciapagina($titulo, $tab)
{
  printf("<html>\n");
  printf(" <head>\n");
  printf("  <link rel='stylesheet' type='text/css' href='./$tab.css'>\n");
  printf(" </head>\n");
  $cor=($titulo=='Consultar') ? 'linen' : 'lightblue' ;
  printf(" <body class='$cor'>\n");
  printf(" $titulo<br>");
}
function terminapagina()
{
  printf("</body>\n");
  printf("</html>\n");
}

?>