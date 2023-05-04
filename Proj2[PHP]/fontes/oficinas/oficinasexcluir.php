<?php
require_once("../../funcoes/toolskit.php");
$conex=mysqli_connect("localhost","root","","ilp540");
$bloco=( ISSET($_REQUEST['bloco']) ) ? $_REQUEST['bloco'] : 1 ;
iniciapagina("Excluir","oficinas");
switch(true)
{
    case ($bloco==1):
    {
        $cmdsql="SELECT pkoficina, txnomeoficina FROM oficinas ORDER BY txnomeoficina";
        $execcmd=mysqli_query($conex,$cmdsql);
        printf("<form action='oficinasexcluir.php' method='post'>\n");
        printf("<input type='hidden' name='bloco' value=2>\n");
        printf("Escolha uma oficina: ");
        printf("<select name='pkoficina'>\n");
        while ( $reg=mysqli_fetch_array($execcmd) )
        {
            printf("<option value='$reg[pkoficina]'>$reg[txnomeoficina]-($reg[pkoficina])</option>\n");
        }
        printf("</select>\n");
        printf("<button type='submit'>Excluir</button>\n");
        printf("<button onclick='history.go(-$bloco)'>Sair</button>\n");
        printf("</form>\n");
        break;
    }
    case ($bloco==2):
    {
        $cmdsql="SELECT o.*,
		                l.txnomelogrcompleto AS txtlogradouro
                FROM oficinas AS o
                INNER JOIN logradouroscompletos AS l ON o.fklogradouro = l.pklogradouro
                WHERE pkoficina='$_REQUEST[pkoficina]'";
        $execcmd=mysqli_query($conex,$cmdsql);
        $reg=mysqli_fetch_array($execcmd);
        printf("<table>\n");
        printf("<tr><td>Código:</td>                <td>$reg[pkoficina]</td></tr>\n");
        printf("<tr><td>Nome:</td>                  <td>$reg[txnomeoficina]</td></tr>\n");
        printf("<tr><td>Apelido:</td>               <td>$reg[txapelido]</td></tr>\n");
        printf("<tr><td colspan=2><hr>Endereço</td></tr>\n");
        printf("<tr><td>Logradouro:</td>            <td>$reg[txtlogradouro]-($reg[fklogradouro])</td></tr>\n");
        printf("<tr><td>Complemento:</td>           <td>$reg[txcomplemento]</td></tr>\n");
        printf("<tr><td>CEP:</td>                   <td>$reg[nucep]</td></tr>\n");
        printf("<tr><td colspan=2><hr></td></tr>\n");
        printf("<tr><td>Cadastrado em:</td>          <td>$reg[dtcadoficina]</td></tr>\n");
        printf("<tr><td></td><td></td></tr>\n");
        printf("</table>\n");
        printf("<form action='oficinasexcluir.php' method='post'>\n");
        printf("<input type='hidden' name='bloco' value=3>\n");
        printf("<input type='hidden' name='pkoficina' value='$reg[pkoficina]'>\n");
        printf("<button type='submit'>Excluir</button>\n");
        printf("<button onclick='history.go(-1)'>< 1 pag.</button>\n");
        printf("<button onclick='history.go(-$bloco)'>Sair</button>\n");
        printf("</form>\n");
        break;
    }
    case ( $bloco==3 ):
    {
        $cmdsql="DELETE FROM oficinas WHERE pkoficina='$_REQUEST[pkoficina]'";
        /* printf("$cmdsql<br>\n"); */
        $tenta=TRUE;
        while ( $tenta )
        {
            mysqli_query($conex,"START TRANSACTION");
            mysqli_query($conex,$cmdsql);
            if ( mysqli_errno($conex)==0 )
            {
                mysqli_query($conex,"COMMIT");
                $tenta=FALSE;
                $mens="Registro com código $_REQUEST[pkoficina] excluído!";
            }
            else
            {
                if ( mysqli_errno($conex)==1213 )
                {
                    $tenta=TRUE;
                }
                else
                {
                    $tenta=FALSE;
                    $mens=mysqli_errno($conex)."-".mysqli_error($conex);
                }
                mysqli_query($link,"ROLLBACK");
                $mostrar=FALSE;
            }
        }
        printf("$mens<br>\n");
        break;
    }
}   
terminapagina();
?>