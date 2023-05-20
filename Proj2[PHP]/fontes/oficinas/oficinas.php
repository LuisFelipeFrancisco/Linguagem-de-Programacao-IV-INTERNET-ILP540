<?php

require_once("../../funcoes/catalogo.php");
require_once("./oficinasfuncoes.php");

$sair=( ISSET($_REQUEST['sair']) ) ? $_REQUEST['sair'] : 1;
$menu=$sair-1;

iniciapagina(TRUE,"Oficinas","oficinas","Abertura");
montamenu("Abertura",$sair);

printf("Este sistema faz o Gerenciamento de dados da Tabela Exemplo para Referência.<br>\n");
printf("O menu apresentado acima apresenta as funcionalidades do sistema.<br><br>\n");
printf("São apresentadas as funcionalidades:<br>\n");
printf("<table>\n");
printf("<tr><td><u>Incluir</u></td><td>-</td><td>PA que coleta dados (em campos de um formulário) e grava em uma tabela.</td></tr>\n"); # <icog>&#x1f7a5;</icog>
printf("<tr><td><u>Alterar</u></td><td>-</td><td>PA que permite escolher um registro de uma tabela e executar a alteração de valores do mesmo registro.</td></tr>\n"); # <icog>&#x1f589;</icog>
printf("<tr><td><u>Excluir</u></td><td>-</td><td>PA que permite escolher um registro de uma tabela e excluir a linha escolhida da tabela.</td></tr>\n"); # <icog>&#x1f7ac;</icog>
printf("<tr><td><u>Consultar</u></td><td>-</td><td>PA que permite escolher um registro de uma tabela e mostra os dados dos registro escolhido.</td></tr>\n"); # <icog>&#x1f50d;&#xfe0e;</icog>
printf("<tr><td><u>Listar</u> </td><td>-</td><td>PA que permite escolher dados e ordenação para emitir uma listagem de dados da tabela.</td></tr>\n"); # <icog>&#x1f5a8;</icog>
printf("</table>\n");

printf("Este sistema foi desenvolvido por: LFFFF (Luis Felipe Francisco Fermino Ferreira - 0210482123037)\n");

terminapagina("Oficinas","Abertura","oficinas.php");

?>
