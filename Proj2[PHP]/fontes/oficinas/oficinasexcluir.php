<?php

require_once("../../funcoes/toolskit.php");
require_once("./oficinasfuncoes.php");

$bloco=( ISSET($_REQUEST['bloco']) ) ? $_REQUEST['bloco'] : 1 ;

iniciapagina("Excluir","oficinas");

switch(true)
{
    case ($bloco==1):
    {
        picklist("Excluir");
        break;
    }
    case ($bloco==2):
    {
        mostraregistro($_REQUEST['pkoficina']);
        printf("<form action='./oficinasexcluir.php' method='post'>\n");
        printf("<input type='hidden' name='bloco' value='3'>\n");
        printf("<input type='hidden' name='pkoficina' value='$_REQUEST[pkoficina]'>\n");
        botoes("Excluir",FALSE,TRUE,2);
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
        botoes("",FALSE,FALSE,3);
        break;
    }
}

terminapagina();

?>