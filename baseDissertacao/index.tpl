<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<style>

.amarelo{
  background-color: #FFD700;
}
.azul{
  background-color: #6495ED;
}
.verde{
  background-color: #2E8B57;
}
.vermelho{
  background-color: #B22222;
}
.pg-ctrl
{
	font:bold 16px verdana;
	color: #0063e3;
	text-decoration: none; 
	cursor: pointer;    
	padding:4px;
	margin:0px;
	border: 0px;
}
.pg-normal 
{
	font:10px verdana;
	color: #333;
	text-decoration: none; 
	cursor: pointer;    
	background-color:#f9f9f9;
	padding:3px 6px;
	margin:1px;
	border: 1px solid #0063e3;
}

.pg-selected 
{
	font:10px verdana;
	color: #fff;
	text-decoration: none;    
	cursor: pointer;
	background-color:#0063e3;
	padding:3px 6px;
	margin:1px;
	border: 1px solid #dde;
}
.conteudo{
    width: 100%;
    height: 600px;
    overflow: scroll;
}
.loading{
 width: 100%;
 height: 100%;
 background-color:blue;
}

</style>

</head>
<body>
	<script src="js/jquery-2.1.3.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/paging.js"></script>
	 <script>
		 var pager = new Pager('tabela', 200); 
        $(window).load(function() {
	        pager.init(); 
	        pager.showPageNav('pager', 'pageNav'); 
	        pager.showPage(1);
	        $('.loading').hide();
		});
       
    </script>
	<ul class="nav nav-pills">
	  <li role="presentation" class="{$checked_treeGeral}"><a href="{$local}?view=treeGeral">Tree Geral</a></li>
	  <li role="presentation" class="{$checked_treeBalanceado}"><a href="{$local}?view=treeBalanceado">Tree Balanceado</a></li>
	  <li role="presentation" class="{$checked_treeEnfermeiro}"><a href="{$local}?view=treeEnfermeiro">Tree Enfermeiro 129505</a></li>
	  <li role="presentation" class="{$checked_treeMadrugada}"><a href="{$local}?view=treeMadrugada">Tree Madrugada</a></li>
	</ul>
	<br />
	Total de registros: <b>{$_total_}</b>
	<br />
	<br />
	O sistema classificou: <b>{$nroAcertosSistema}</b> com a mesma prioridade do enfermeiro<br />
	As regras classificaram : <b>{$nroAcertosRegras}</b> com a mesma prioridade do enfermeiro<br />
	<br />
	<br /><br />
	<br />
	<div class="container-fluid conteudo">
	  <div class="row">
	   {$_conteudo_}
	  </div>
	</div>
	<div id="pageNav"></div>
	<div class='loading'></div>	

</body>
</html>
