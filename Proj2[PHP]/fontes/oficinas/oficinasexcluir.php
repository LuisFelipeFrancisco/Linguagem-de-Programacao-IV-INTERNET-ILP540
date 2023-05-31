<?php

require_once("../../funcoes/catalogo.php");
require_once("./oficinasfuncoes.php");

$bloco=( ISSET($_REQUEST['bloco']) ) ? $_REQUEST['bloco'] : 1;
$sair=$_REQUEST['sair']+1;
$menu=$_REQUEST['sair'];

iniciapagina(TRUE,"Oficinas","oficinas","Excluir");
montamenu("Excluir",$sair);

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
        printf("<input type='hidden' name='sair' value='$sair'>\n");
        printf("<input type='hidden' name='pkoficina' value='$_REQUEST[pkoficina]'>\n");
        botoes("Excluir",FALSE,TRUE);
        printf("</form>\n");
        break;
    }
    case ( $bloco==3 ):
    {
        $cmdsql="DELETE FROM oficinas WHERE pkoficina='$_REQUEST[pkoficina]'";
        $mostrar=FALSE;
        $tenta=TRUE;
        while ( $tenta )
        {
            mysqli_query($link,"START TRANSACTION");
            mysqli_query($link,$cmdsql);
            if ( mysqli_errno($link)==0 )
            {
                mysqli_query($link,"COMMIT");
                $tenta=FALSE;
                $mostrar=TRUE;
                $mens="Registro com código $_REQUEST[pkoficina] excluído!";
                botoes("",FALSE,TRUE);
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
        break;
    }
}

terminapagina("Oficinas","Excluir","oficinasexcluir.php");

?>