<?php

require_once("../../funcoes/catalogo.php");
require_once("./oficinasfuncoes.php");

$bloco=( ISSET($_REQUEST['bloco']) ) ? $_REQUEST['bloco'] : 1;
$sair=$_REQUEST['sair']+1;
$menu=$_REQUEST['sair'];

iniciapagina(TRUE,"Oficinas","oficinas","Incluir");
montamenu("Incluir",$sair);

switch(true)
{
    case ($bloco==1):
    {
        printf("<form action='oficinasincluir.php' method='POST'>\n");
        printf("<input type='hidden' name='bloco' value='2'>\n");
        printf("<input type='hidden' name='sair' value='$sair'>\n");
        printf("<table>\n");
        printf("<tr><td>Código:</td>         <td>O Código sera gerado pelo Sistema</td></tr>\n");
        printf("<tr><td>Nome:</td>           <td><input type='text' name='txnomeoficina' placeholder='' size=50 maxlength=200></td></tr>\n");
        printf("<tr><td>Apelido:</td>        <td><input type='text' name='txapelido' placeholder='' size=50 maxlength=200></td></tr>\n");
        printf("<tr><td colspan=2><hr>Endereço</td></tr>\n");
        printf("<tr><td>Logradouro:</td>       <td>");
        
        $cmdsql="SELECT pklogradouro,txnomelogrcompleto from logradouroscompletos order by txnomelogrcompleto";
        $execcmd=mysqli_query($link,$cmdsql);
        
        printf("<select name='fklogradouro'>\n");
        
        while ( $reg=mysqli_fetch_array($execcmd) )
        {
            printf("<option value='$reg[pklogradouro]'>$reg[txnomelogrcompleto]-($reg[pklogradouro])</option>");
        }
        
        printf("</select>\n");
        printf("</td></tr>\n");
        printf("<tr><td>Complemento:</td>    <td><input type='text' name='txcomplemento' size='10' maxlength='10'></td></tr>\n");
        printf("<tr><td>CEP:</td>            <td><input type='text' name='nucep' size='10' maxlength='8'></td></tr>\n");
        printf("<tr><td colspan=2><hr></td></tr>\n");
        printf("<tr><td>Cadastrado em:</td>  <td><input type='date' name='dtcadoficina'></td></tr>\n");
        printf("<tr><td></td>                <td>");
        botoes("Incluir",TRUE,TRUE);
        printf("</td></tr>\n");
        printf("</table>\n");
        printf("</form>\n");
        break;
    }
    case ($bloco==2):
    { 
        $mostrar=FALSE;
        $tenta=TRUE;
        while ( $tenta )
        {
            mysqli_query($link,"START TRANSACTION");
            $ultimacp=mysqli_fetch_array(mysqli_query($link,"SELECT MAX(pkoficina) AS CpMAX FROM oficinas"));
            $CP=$ultimacp['CpMAX']+1;
            $cmdsql="INSERT INTO oficinas (pkoficina,
                                            txnomeoficina, 
                                            txapelido, 
                                            fklogradouro, 
                                            txcomplemento, 
                                            nucep, 
                                            dtcadoficina) 
                                    VALUES ('$CP',
                                            '$_REQUEST[txnomeoficina]',
                                            '$_REQUEST[txapelido]',
                                            '$_REQUEST[fklogradouro]',
                                            '$_REQUEST[txcomplemento]',
                                            '$_REQUEST[nucep]',
                                            '$_REQUEST[dtcadoficina]')";
            mysqli_query($link,$cmdsql);
            if ( mysqli_errno($link)==0 )
            { 
                mysqli_query($link,"COMMIT");
                $tenta=FALSE;
                $mostrar=TRUE;
                $mens="Registro incluído com sucesso!";
            }
            else
            {
                if ( mysqli_errno($link)==1213 )
            { 
                $tenta=TRUE;
            }
            else
            { 
                $tenta=FALSE;
                $mens=mysqli_errno($link)."-".mysqli_error($link);
            }
                mysqli_query($link,"ROLLBACK");
                $mostrar=FALSE;
            }
        }
        printf("$mens<br>\n");
        if ( $mostrar )
        {
            mostraregistro("$CP",);
        }
        break;
    }
}

terminapagina("Oficinas","Incluir","oficinasincluir.php");

?>