<?php
require_once("./toolskit.php");

inicio ("PHP Recursivo");

$bloco= ( ISSET($_REQUEST["bloco"]) ) ? $_REQUEST["bloco"] : 1 ;

switch (TRUE)
{
  case ( $bloco==1 ):
  { 
    printf("<form action='recursivo.php' method='POST'>");
    printf("<input type='hidden' name='bloco' value='2'>");
    printf("Nome:<input type='text' name='nome' size='40' maxlength='120'><br>");
    printf("<input type='submit' value='Enviar'>");
    printf("</form>");
    break;
  }
  case ( $bloco==2 ):
  { 
    printf("<pre>");
    print_r($_REQUEST);
    printf("</pre>");
    break;
  }

}

fim ();

?>