<?php

require_once("../../funcoes/catalogo.php");
require_once("./oficinasfuncoes.php");

$bloco=( ISSET($_REQUEST['bloco']) ) ? $_REQUEST['bloco'] : 1;
$sair=$_REQUEST['sair']+1;
$menu=$_REQUEST['sair'];

$cordefundo=($bloco<3) ? TRUE : FALSE;

iniciapagina($cordefundo,"Oficinas","oficinas","Listar");

switch(true)
{
    case ($bloco==1):
    {
        montamenu("Listar","$sair");
        printf("<form action='./oficinaslistar.php' method='post'>\n");
        printf("<input type='hidden' name='bloco' value=2>\n");
        printf("<input type='hidden' name='sair' value='$sair'>\n");
        printf("<table>\n");
        printf("<tr><td colspan=2>Escolha a <negrito>ordem</negrito> como os dados serão exibidos no relatório:</td></tr>\n");
        printf("<tr><td>Código da Oficina.:</td><td>(<input type='radio' name='ordem' value='O.pkoficina'>)</td></tr>\n");
        printf("<tr><td>Nome da Oficina...:</td><td>(<input type='radio' name='ordem' value='O.txnomeoficina' checked>)</td></tr>\n");
        printf("</td></tr>\n");
        $dtini="1901-01-01";
        $dtfim=date("Y-m-d");
        printf("<tr><td>Intervalo de datas de cadastro:</td><td><input type='date' name='dtcadini' value='$dtini'> até <input type='date' name='dtcadfim' value='$dtfim'></td></tr>");
        printf("<tr><td></td><td>");
        botoes("Listar",FALSE,TRUE);
        printf("</td></tr>\n");
        printf("</table>\n");
        printf("</form>\n");
        break;
    }
    case ( $bloco==2 || $bloco==3 ):
    {
        $selecao=" WHERE (O.dtcadoficina between '$_REQUEST[dtcadini]' and '$_REQUEST[dtcadfim]')";
        $cmdsql="SELECT o.*,l.txnomelogrcompleto AS txtlogradouro FROM oficinas AS o INNER JOIN logradouroscompletos AS l ON o.fklogradouro = l.pklogradouro WHERE (o.dtcadoficina between '$_REQUEST[dtcadini]' and '$_REQUEST[dtcadfim]') ORDER BY $_REQUEST[ordem]";
        $execsql=mysqli_query($link,$cmdsql);
        ($bloco==2) ? montamenu("Listar","$sair") : "";
        printf("<table bgcolor='lightblue' border=1 style=' border-collapse: collapse;'>\n");
        printf("<tr class='lighblue'><td class='borda' valign=top rowspan=2>Codigo</td>\n");
        printf("<td class='borda' valign=top rowspan=2>Nome da Oficina</td>\n");
        printf("<td class='borda' valign=top rowspan=2>Apelido</td>\n");
        printf("<td class='borda' valign=top rowspan=2>Logradouro</td>\n");
        printf("<td class='borda' valign=top rowspan=2>Complemento</td>\n");
        printf("<td class='borda' valign=top rowspan=2>CEP</td>\n");
        printf("<td class='borda' valign=top rowspan=2>Data de Cadastro</td></tr>\n");
        printf("<tr></tr>\n");
        
        $corlinha="white";
        while ( $reg=mysqli_fetch_array($execsql) )
        {
            printf("<tr bgcolor=$corlinha>\n");
            printf("<td class='borda'valign=top>$reg[pkoficina]</td>\n");
            printf("<td class='borda'valign=top>$reg[txnomeoficina]</td>\n");
            printf("<td class='borda'valign=top>$reg[txapelido]</td>\n");
            printf("<td class='borda'valign=top>$reg[txtlogradouro]</td>\n");
            printf("<td class='borda'valign=top>$reg[txcomplemento]</td>\n");
            printf("<td class='borda'valign=top>$reg[nucep]</td>\n");
            printf("<td class='borda'valign=top>$reg[dtcadoficina]</td>\n");
            printf("</tr>\n");
            $corlinha=($corlinha=="white") ? "lightgreen" : "white";
        }
        printf("</table>\n");
        if ( $bloco==2 )
        {
            printf("<form action='./oficinaslistar.php' method='POST' target='_NEW'>\n");
            printf("<input type='hidden' name='bloco' value=3>\n");
            printf("<input type='hidden' name='sair' value='$sair'>\n");
            printf("<input type='hidden' name='dtcadini' value=$_REQUEST[dtcadini]>\n");
            printf("<input type='hidden' name='dtcadfim' value=$_REQUEST[dtcadfim]>\n");
            printf("<input type='hidden' name='ordem' value=$_REQUEST[ordem]>\n");
            botoes("Imprimir",FALSE,TRUE);
            printf("</form>\n");
        }
        else
        {
            printf("<hr>\n<button type='submit' onclick='window.print();'>Imprimir</button> - Corte a folha na linha acima.\n");
        }
        break;
    }
}

terminapagina("Oficinas","Listar","oficinaslistar.php");

?>