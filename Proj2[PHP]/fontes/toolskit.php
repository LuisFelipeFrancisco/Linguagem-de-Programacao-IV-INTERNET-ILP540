<?php
function inicio($titulo)
{
printf("<html>");
  printf("<head>");
    printf("<meta charset='utf-8'>");
    printf("<title>$titulo</title>");
    printf(" $titulo");
  printf("</head>");
  printf("<body>");
}

function fim()
{
  printf("</body>");
printf("</html>");
}
?>