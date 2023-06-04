<?php

require_once("../../funcoes/catalogo.php");
require_once("./oficinasfuncoes.php");

$sair=( ISSET($_REQUEST['sair']) ) ? $_REQUEST['sair'] : 1;
$menu=$sair-1;

iniciapagina(TRUE,"Oficinas","oficinas","Abertura");
montamenu("Abertura",$sair);

printf("<p>Este sistema foi desenvolvido por: LFFFF (Luis Felipe Francisco Fermino Ferreira - 0210482123037)</p>\n");
printf("<p>Este sistema faz o Gerenciamento de dados da Tabela Oficinas.</p>\n");
printf("<p>O menu apresentado acima apresenta as funcionalidades do sistema.</p>\n");
printf("São apresentadas as funcionalidades:\n");
printf("<table>\n");
printf("<tr><td><u>Incluir</u></td><td>-</td><td>PA que coleta dados (em campos de um formulário) e grava em uma tabela.</td></tr>\n");
printf("<tr><td><u>Alterar</u></td><td>-</td><td>PA que permite escolher um registro de uma tabela e executar a alteração de valores do mesmo registro.</td></tr>\n");
printf("<tr><td><u>Excluir</u></td><td>-</td><td>PA que permite escolher um registro de uma tabela e excluir a linha escolhida da tabela.</td></tr>\n");
printf("<tr><td><u>Consultar</u></td><td>-</td><td>PA que permite escolher um registro de uma tabela e mostra os dados dos registro escolhido.</td></tr>\n");
printf("<tr><td><u>Listar</u> </td><td>-</td><td>PA que permite escolher dados e ordenação para emitir uma listagem de dados da tabela.</td></tr>\n");
printf("<tr><td><u>Botão Abertura</u></td><td>-</td><td>Que retorna a esta página.</td></tr>\n");
printf("<tr><td><u>Botão Sair</u></td><td>-</td><td>Que encerra a execução do sistema.</td></tr>\n");
printf("</table>\n");

terminapagina("Oficinas","Abertura","oficinas.php");

?>
