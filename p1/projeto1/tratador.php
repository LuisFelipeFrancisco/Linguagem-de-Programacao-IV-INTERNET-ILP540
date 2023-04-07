<?php

echo("
<html>
    <head>
        <meta charset='UTF-8'>
        <link rel='stylesheet' type='text/css' href='./projeto1.css'>
    </head>
    <body>
    <h1 id='titulo' class='centertexto'>Oficina Cadastrada com Sucesso</h1>
        <table class='tableRelatorio'>
            <tr id='lightgreen'>
                <td class='celulavazia'></td>
                <th class='preto'>Código</th>
                <th class='preto'>Razão Social</th>
                <th class='preto'>Apelido</th>
                <th class='preto'>Logradouro</th>
                <th class='preto'>Complemento</th>
                <th class='preto'>CEP</th>
                <th class='preto'>Data de Cadastro</th>
                <td class='celulavazia'></td>
            </tr>
            <tr id='white'>
                <td class='celulavazia'></td>
                <td>".$_POST['pkoficina']."</td>
                <td>".$_POST['txnomeoficina']."</td>
                <td>".$_POST['txapelido']."</td>
                <td>".$_POST['fklogradouro']."</td>
                <td>".$_POST['txcomplemento']."</td>
                <td>".$_POST['nucep']."</td>
                <td>".$_POST['dtcadoficina']."</td>
                <td class='celulavazia'></td>
            </tr>
            <tr id='lightblue'>
                <td class='celulavazia'></td>
                <td>".$_POST['pkoficina']."</td>
                <td>".$_POST['txnomeoficina']."</td>
                <td>".$_POST['txapelido']."</td>
                <td>".$_POST['fklogradouro']."</td>
                <td>".$_POST['txcomplemento']."</td>
                <td>".$_POST['nucep']."</td>
                <td>".$_POST['dtcadoficina']."</td>
                <td class='celulavazia'></td>
            </tr>
        </table>
    </body>
</html>");

?>
