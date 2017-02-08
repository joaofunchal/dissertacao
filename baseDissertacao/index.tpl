<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333333;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 16px;
    text-decoration: none;
}

li a:hover {
    background-color: #436EEE;
}
.checked{
   background-color: #436EEE;
}
</style>
</head>
<body>

<ul>
  <li class="{$checked_treeGeral}"><a href="{$local}?view=treeGeral">Tree Geral</a></li>
  <li class="{$checked_treeBalanceado}"><a href="{$local}?view=treeBalanceado">Tree Balanceado</a></li>
  <li class="{$checked_treeEnfermeiro}"><a href="{$local}?view=treeEnfermeiro">Tree Enfermeiro 129505</a></li>
  <li class="{$checked_treeMadrugada}"><a href="{$local}?view=treeMadrugada">Tree Madrugada</a></li>

</ul>
{$_conteudo_}
<br />
<br />
O sistema acertoou : {$nroAcertosSistema}<br />
As regras acertaram : {$nroAcertosRegras}
</body>
</html>
