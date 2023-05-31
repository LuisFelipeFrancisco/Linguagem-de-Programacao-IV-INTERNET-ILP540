<?php

require_once("../../funcoes/catalogo.php");
require_once("./oficinasfuncoes.php");

$bloco=( ISSET($_REQUEST['bloco']) ) ? $_REQUEST['bloco'] : 1;
$sair=$_REQUEST['sair']+1;
$menu=$_REQUEST['sair'];

iniciapagina(TRUE,"Oficinas","oficinas","Alterar");
montamenu("Alterar",$sair);

switch (TRUE)
{
  case ( $bloco==1 ):
  { 
    picklist('Alterar');
    break;
  }
  case ( $bloco==2 ):
  { 
    $cmdsql="SELECT * FROM oficinas WHERE pkoficina = '$_REQUEST[pkoficina]'";
    $reg=mysqli_fetch_array(mysqli_query($link,$cmdsql));
    
    printf("<form action='oficinasalterar.php' method='POST'>\n");
    printf("<input type='hidden' name='bloco' value='3'>\n");
    printf("<input type='hidden' name='sair' value='$sair'>\n");
    printf("<input type='hidden' name='pkoficina' value='$_REQUEST[pkoficina]'>");
    printf("<table>\n");
    printf("<tr><td>Código</td><td>$reg[pkoficina] - Não é alterado pelo Programa.</td></tr>\n");
    
        printf("<tr><td>Nome:</td>           <td><input type='text' name='txnomeoficina' value='$reg[txnomeoficina]' size=50 maxlength=200></td></tr>\n");
        printf("<tr><td>Apelido:</td>        <td><input type='text' name='txapelido' value='$reg[txapelido]' size=50 maxlength=200></td></tr>\n");
        printf("<tr><td colspan=2><hr>Endereço</td></tr>\n");
        printf("<tr><td>Logradouro:</td>       <td>");
        
        $cmdsql="SELECT pklogradouro,txnomelogrcompleto from logradouroscompletos order by txnomelogrcompleto";
        $execcmd=mysqli_query($link,$cmdsql);
        
        printf("<select name='fklogradouro'>\n");
        
        while ( $le=mysqli_fetch_array($execcmd) )
        {
            $selected=($reg['fklogradouro']==$le['pklogradouro']) ? " selected" : "";
            printf("<option value='$le[pklogradouro]'$selected>$le[txnomelogrcompleto]-($le[pklogradouro])</option>\n");
        }
        
        printf("</select>\n");
        printf("</td></tr>\n");
        printf("<tr><td>Complemento:</td>    <td><input type='text' name='txcomplemento' value='$reg[txcomplemento]' size='10' maxlength='10'></td></tr>\n");
        printf("<tr><td>CEP:</td>            <td><input type='text' name='nucep' value='$reg[nucep]' size='10' maxlength='8'></td></tr>\n");
        printf("<tr><td colspan=2><hr></td></tr>\n");
        printf("<tr><td>Cadastrado em:</td>  <td><input type='date' name='dtcadoficina' value='$reg[dtcadoficina]'></td></tr>\n");
        printf("<tr><td></td>                <td>");
        printf("</td></tr>\n");
        printf("<tr><td></td><td>");
	      botoes("Alterar",TRUE,TRUE);
        printf("</table>\n");
        printf("</form>\n");
    break;
  }
  case ($bloco==3):
  { 
    $cmdsql="UPDATE oficinas SET pkoficina =     '$_REQUEST[pkoficina]',
                                 txnomeoficina = '$_REQUEST[txnomeoficina]',
                                 txapelido =     '$_REQUEST[txapelido]',
                                 fklogradouro =  '$_REQUEST[fklogradouro]',
                                 txcomplemento = '$_REQUEST[txcomplemento]',
                                 nucep =         '$_REQUEST[nucep]',
                                 dtcadoficina =  '$_REQUEST[dtcadoficina]'
                    WHERE pkoficina='$_REQUEST[pkoficina]'";
    
    $tentativa=TRUE;
    while ( $tentativa )
    {
      mysqli_query($link,"START TRANSACTION");
      mysqli_query($link,$cmdsql);
      
      if ( mysqli_errno($link)==0 )
      { 
        mysqli_query($link,"COMMIT");
        
        $mostra=TRUE;
        $tentativa=FALSE;
      }
      else
      {
        $mostra=FALSE;
        if ( mysqli_errno($link)==1213 )
        { 
          mysqli_query($link,"ROLLBACK");
          
          $tentativa=TRUE;
        }
        else
        { 
          $mens=mysqli_errno($link)." - ".mysqli_error($link);
          mysqli_query($link,"ROLLBACK");
          
          $tentativa=FALSE;
        }
      }
    }
    if ( $mostra )
    { 
      printf("Alteração feita com sucesso!<br>\n");
      mostraregistro("$_REQUEST[pkoficina]");
    }
    else
    {
      printf("Erro! $mens<br>\n");
    }
    break;
  }
}

terminapagina("Oficinas","Alterar","oficinasalterar.php");

?>