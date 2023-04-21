<?php
#######################################################################################################################
# Objetivo...: Apresentar a estruturação de um PA que faz a consulta de dados de uma tabela.
# Descrição..: Faz a conexão com uma base de dados. Determina a execução do bloco 1 do PA recursivo.
#              No bloco 1 faz a leitura dos dados de uma tabela (projeção) e monta uma
#              Caixa de Seleção (PickList). Na picklist mostra um campo descritivo da tabela e
#              associa cada linha exibida ao valor da PK da tabela.
#              No bloco 2 lê o valor da PK escolhida, acessa e lê a linha da tabela e mostra os
#              dados em formato de tabela.
# Criação....: 2023-04-20
# Atualização: 2023-04-20 
#######################################################################################################################
# Requerendo a execução do ToolsKit.php
require_once("./toolskit.php"); 

$conex=mysqli_connect("localhost","root","","ilp540");

$bloco=( ISSET($_REQUEST['bloco']) ) ? $_REQUEST['bloco'] : 1 ;

iniciapagina("Consultar","oficinas");

switch(true)
{
  case ($bloco==1):
  {
    $cmdsql="SELECT pkoficina, txnomeoficina FROM oficinas";
    $execcmd=mysqli_query($conex,$cmdsql);
    
    printf("  <form action='oficinas.php' method='post'>\n");
    printf("   <input type='hidden' name='bloco' value=2>\n");
    printf("   Escolha uma oficina: ");
    printf("   <select name='pkoficina'>\n");
    
    while ( $reg=mysqli_fetch_array($execcmd) )
    { 
      printf("<option value='$reg[pkoficina]'>$reg[txnomeoficina]-($reg[pkoficina])</option>\n");
    }
    printf("   </select>\n");
    printf("   <button type='submit'>Consultar</button>\n");
    printf("   <button onclick='history.go(-$bloco)'>Sair</button>\n");
    printf("  </form>\n");
    break;
  }
  case ($bloco==2):
  { 
    $cmdsql="SELECT o.*,
                        lt.txnometipologradouro AS txttipologradouro,
                        l.txnomelogradouro AS txtnomelogradouro, 
                        c.txnomecidade AS txtcidade
            FROM oficinas AS o
            INNER JOIN logradouros as l ON o.fklogradouro = l.pklogradouro
            INNER JOIN cidades AS c ON l.fkcidade = c.pkcidade
            INNER JOIN logradourostipos AS lt ON l.fklogradourotipo = lt.pklogradourotipo
            where pkoficina='$_REQUEST[pkoficina]'";
	
	$execcmd=mysqli_query($conex,$cmdsql);
	
	$reg=mysqli_fetch_array($execcmd);
	
	printf("   <table>\n");
    printf("    <tr><td>Código:</td>                <td>$reg[pkoficina]</td></tr>\n");
    printf("    <tr><td>Nome:</td>                  <td>$reg[txnomeoficina]</td></tr>\n");
    printf("    <tr><td>Apelido:</td>               <td>$reg[txapelido]</td></tr>\n");
    printf("    <tr><td colspan=2><hr>Endereço</td></tr>\n");
    printf("    <tr><td>Logradouro:</td>            <td>$reg[txttipologradouro] $reg[txtnomelogradouro]-($reg[fklogradouro])</td></tr>\n");
    printf("    <tr><td>Complemento:</td>           <td>$reg[txcomplemento]</td></tr>\n");
    printf("    <tr><td>Cidade:</td>                <td>$reg[txtcidade]</td></tr>\n");
    printf("    <tr><td>CEP:</td>                   <td>$reg[nucep]</td></tr>\n");
    printf("    <tr><td colspan=2><hr></td></tr>\n");
    printf("    <tr><td>Cadastrado em</td>          <td>$reg[dtcadoficina]</td></tr>\n");
    printf("    <tr><td></td><td></td></tr>\n");
	printf("   </table>\n");
	
	printf("   <button onclick='history.go(-1)'>< 1 pag.</button>\n");
    printf("   <button onclick='history.go(-$bloco)'>Sair</button>\n");
    break;
  }
}
terminapagina();
?>