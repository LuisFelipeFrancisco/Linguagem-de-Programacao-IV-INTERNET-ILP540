<?php

function picklist($acao)
{
    global $link;
    $prg=($acao=="Consultar")?"oficinasconsultar.php":(($acao=="Excluir")?"oficinasexcluir.php":"oficinasalterar.php");
    $cmdsql="SELECT pkoficina, txnomeoficina FROM oficinas ORDER BY txnomeoficina";
    $execcmd=mysqli_query($link,$cmdsql);

    $sair=$_REQUEST['sair']+1;
    $menu=$_REQUEST['sair'];

    printf("<form action='./$prg' method='post'>\n");
    printf("<input type='hidden' name='bloco' value=2>\n");
    printf("<input type='hidden' name='sair' value='$sair'>\n");
    printf("Escolha uma oficina: ");
    printf("<select name='pkoficina'>\n");

    while ( $reg=mysqli_fetch_array($execcmd) )
    { 
        printf("<option value='$reg[pkoficina]'>$reg[txnomeoficina]-($reg[pkoficina])</option>\n");
    }

    printf("</select>\n");

    botoes($acao,TRUE,FALSE);

    printf("</form>\n");
}

function mostraregistro($PK)
{
    global $link;
    $cmdsql="SELECT o.*, 
                    l.txnomelogrcompleto AS txtlogradouro
                    FROM oficinas AS o
                    INNER JOIN logradouroscompletos AS l ON o.fklogradouro = l.pklogradouro
                    WHERE pkoficina='$PK'";

    $execcmd=mysqli_query($link,$cmdsql);
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
    printf("<tr><td>Cadastrado em:</td>         <td>$reg[dtcadoficina]</td></tr>\n");
    printf("<tr><td></td><td></td></tr>\n");
    printf("</table>\n");
}

function montamenu($acao,$sair)
{ 
    printf("<div class='$acao'>\n");
    printf("<div class='menu'>\n");
    printf("<form class='menubtn' action='' method='POST'>\n");
    printf("<input type='hidden' name='sair' value='$sair'>\n");
    printf("Oficinas:\n");
    printf("<button class='ins' type='submit' formaction='./oficinasincluir.php'  >Incluir</button>\n");
    printf("<button class='alt' type='submit' formaction='./oficinasalterar.php'  >Alterar</button>\n");
    printf("<button class='del' type='submit' formaction='./oficinasexcluir.php'  >Excluir</button>\n");
    printf("<button class='con' type='submit' formaction='./oficinasconsultar.php'>Consultar</button>\n");
    printf("<button class='lst' type='submit' formaction='./oficinaslistar.php'   >Listar</button>\n");
    $menu=$sair-1;
    printf(($menu>0) ? "<input class='imp' type='button' value='Abertura' onclick='history.go(-$menu)'>" : "");
    printf("<input class='imp' type='button' value='Sair' onclick='history.go(-$sair)'>\n");
    printf("</form>\n");
    printf("<p class='titulo'>$acao</p><hr>\n");
    printf("</div>\n");
    printf("</div>\n");
}

function botoes($acao,$limpar,$voltar)
{ 
    $barra="";
    $barra=( $acao!="" ) ? $barra."<input class='imp' type='submit' value='$acao'>" : "";
    $barra=(  $limpar  ) ? $barra."<input class='imp' type='reset'  value='Limpar'>" : $barra ;
    $barra=(  $voltar  ) ? $barra."<input class='imp' type='button' value='Voltar' onclick='history.go(-1)'>" : $barra ;
    printf("$barra\n");
}

?>