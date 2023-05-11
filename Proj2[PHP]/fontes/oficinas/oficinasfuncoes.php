<?php

function picklist($acao)
{
    global $conex;
    $prg=($acao=="Consultar")?"oficinasconsultar.php":(($acao=="Excluir")?"oficinasexcluir.php":"oficinasalterar.php");
    $cmdsql="SELECT pkoficina, txnomeoficina FROM oficinas ORDER BY txnomeoficina";
    $execcmd=mysqli_query($conex,$cmdsql);

    printf("<form action='./$prg' method='post'>\n");
    printf("<input type='hidden' name='bloco' value=2>\n");
    printf("Escolha uma oficina: ");
    printf("<select name='pkoficina'>\n");

    while ( $reg=mysqli_fetch_array($execcmd) )
    { 
        printf("<option value='$reg[pkoficina]'>$reg[txnomeoficina]-($reg[pkoficina])</option>\n");
    }

    printf("</select>\n");

    botoes($acao,TRUE,TRUE,TRUE);

    printf("</form>\n");
}

function mostraregistro($PK)
{
    global $conex;
    $cmdsql="SELECT o.*, 
                    l.txnomelogrcompleto AS txtlogradouro
                    FROM oficinas AS o
                    INNER JOIN logradouroscompletos AS l ON o.fklogradouro = l.pklogradouro
                    WHERE pkoficina='$PK'";

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
    printf("<tr><td>Cadastrado em:</td>         <td>$reg[dtcadoficina]</td></tr>\n");
    printf("<tr><td></td><td></td></tr>\n");
    printf("</table>\n");
}

function botoes($acao,$limpar,$voltar,$sair)
{
    $barra="";
    $barra=( $acao!="" ) ? $barra."<button type='submit'>$acao</button>" : "";
    $barra=(  $limpar  ) ? $barra."<button type='reset'>Limpar</button>" : $barra ;
    $barra=(  $voltar  ) ? $barra."<button onclick='history.go(-1)'>< 1 pag.</button>" : $barra ;
    $barra=(  $sair    ) ? $barra."<button onclick='history.go(-$sair)'>Sair</button>" : $barra ;;
    printf("$barra\n");
}

?>