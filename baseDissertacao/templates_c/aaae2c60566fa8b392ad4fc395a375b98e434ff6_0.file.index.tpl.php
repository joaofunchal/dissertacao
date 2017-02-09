<?php
/* Smarty version 3.1.30, created on 2017-02-09 01:54:30
  from "C:\xampp7\htdocs\baseDissertacao\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_589bbdc632daa6_27194770',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'aaae2c60566fa8b392ad4fc395a375b98e434ff6' => 
    array (
      0 => 'C:\\xampp7\\htdocs\\baseDissertacao\\index.tpl',
      1 => 1486601661,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_589bbdc632daa6_27194770 (Smarty_Internal_Template $_smarty_tpl) {
?>
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
	<?php echo '<script'; ?>
 src="js/jquery-2.1.3.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="js/bootstrap.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="js/paging.js"><?php echo '</script'; ?>
>
	 <?php echo '<script'; ?>
>
		 var pager = new Pager('tabela', 200); 
        $(window).load(function() {
	        pager.init(); 
	        pager.showPageNav('pager', 'pageNav'); 
	        pager.showPage(1);
	        $('.loading').hide();
		});
       
    <?php echo '</script'; ?>
>
	<ul class="nav nav-pills">
	  <li role="presentation" class="<?php echo $_smarty_tpl->tpl_vars['checked_treeGeral']->value;?>
"><a href="<?php echo $_smarty_tpl->tpl_vars['local']->value;?>
?view=treeGeral">Tree Geral</a></li>
	  <li role="presentation" class="<?php echo $_smarty_tpl->tpl_vars['checked_treeBalanceado']->value;?>
"><a href="<?php echo $_smarty_tpl->tpl_vars['local']->value;?>
?view=treeBalanceado">Tree Balanceado</a></li>
	  <li role="presentation" class="<?php echo $_smarty_tpl->tpl_vars['checked_treeEnfermeiro']->value;?>
"><a href="<?php echo $_smarty_tpl->tpl_vars['local']->value;?>
?view=treeEnfermeiro">Tree Enfermeiro 129505</a></li>
	  <li role="presentation" class="<?php echo $_smarty_tpl->tpl_vars['checked_treeMadrugada']->value;?>
"><a href="<?php echo $_smarty_tpl->tpl_vars['local']->value;?>
?view=treeMadrugada">Tree Madrugada</a></li>
	</ul>
	<br />
	Total de registros: <b><?php echo $_smarty_tpl->tpl_vars['_total_']->value;?>
</b>
	<br />
	<br />
	O sistema classificou: <b><?php echo $_smarty_tpl->tpl_vars['nroAcertosSistema']->value;?>
</b> com a mesma prioridade do enfermeiro<br />
	As regras classificaram : <b><?php echo $_smarty_tpl->tpl_vars['nroAcertosRegras']->value;?>
</b> com a mesma prioridade do enfermeiro<br />
	<br />
	<br /><br />
	<br />
	<div class="container-fluid conteudo">
	  <div class="row">
	   <?php echo $_smarty_tpl->tpl_vars['_conteudo_']->value;?>

	  </div>
	</div>
	<div id="pageNav"></div>
	<div class='loading'></div>	

</body>
</html>
<?php }
}
