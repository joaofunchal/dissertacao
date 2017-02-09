<?php
require_once 'classes/class.DB.php';
require_once('smarty-3.1.30/libs/Smarty.class.php');
require_once 'classes/class.Regras_TreeGeral.php';
require_once 'classes/class.Regras_TreeBalanceado.php';
require_once 'classes/class.Regras_TreeEnf129505.php';
require_once 'classes/class.Regras_TreeMadrugada.php';

$smarty = new Smarty();
$db = new DB();
$con = $db->query("
SELECT 
	concat(nr_ficha,'/',aa_ficha) as ficha,	
	case when extract(year from age(dt_nascimento)) is null	then 0
	     when  extract(year from age(dt_nascimento)) < 0	then 0
	     else extract(year from age(dt_nascimento))
	end as idade,

	case when cd_sexo is null then '?'
	     else cd_sexo
	end as cd_sexo,	
	
	case when pas is null then 0
	     else pas 
	end as pas,

	case when pad is null then 0
	     else pad 
	end as pad,

	case when fc is null then 0
	     else fc 
	end as fc,

	case when fr is null then 0
	     else fr 
	end as fr,
	
	case when spo2 is null then 0
	     else spo2 
	end as spo2,

	case when glasgow_ocular is null then 0
	     else glasgow_ocular 
	end as glasgow_ocular,

	case when glasgow_verbal is null then 0
	     else glasgow_verbal 
	end as glasgow_verbal,
	
	case when glasgow_motora is null then 0
	     else glasgow_motora 
	end as glasgow_motora,

	case when vl_temp_axila is null then 0
	     else vl_temp_axila 
	end as vl_temp_axila,
	lower(c.ds_classificador) as classificacaoEnfermeiro,
	lower(cs.ds_classificador) as classificacaoSistema
	       
FROM cr.fichas
INNER JOIN cr.classificadores c ON 
	c.id_classificador = id_classificador_registrado
INNER JOIN cr.classificadores cs ON 
	cs.id_classificador = id_classificador_calculado
WHERE aa_ficha IN (2015) and fl_gestante = 'N'
ORDER BY concat(aa_ficha,nr_ficha)");
$totalSistema = 0;
$totalRegras = 0;
if(!isset($_GET['view']))
	$_GET['view'] = 'treeGeral';
$conteudo = "
	<table id='tabela' class='table table-hover'>
		<tr><th>Ficha</th><th>Class enfermeiro</th><th>Class sistema</th><th>Class Regras</th></tr>";
$linhas = 0;
while($record = $con->fetch(PDO::FETCH_ASSOC)){
	$linhas++;
	switch ($_GET['view']){
		case 'treeGeral' :
			$objGeral = new Regras_TreeGeral();
			$classificacao = $objGeral->obtemClassificacao($record);
			if($classificacao == $record['classificacaoenfermeiro'])
				$totalRegras += 1;
			if($classificacao == $record['classificacaosistema'])
				$totalSistema += 1;
			$smarty->assign("checked_treeGeral", "active",true);
			$conteudo .= "<tr><td class='{$record['ficha']}'>{$record['ficha']}</td><td class='{$record['classificacaoenfermeiro']}'>{$record['classificacaoenfermeiro']}</td>
							 <td class='{$record['classificacaosistema']}'>{$record['classificacaosistema']}</td><td class='{$classificacao}'>{$classificacao}</td></tr>";
			break;
		case 'treeBalanceado' :
			$objBalanceado = new Regras_TreeBalanceado();
			$classificacao = $objBalanceado->obtemClassificacao($record);
			if($classificacao == $record['classificacaoenfermeiro'])
				$totalRegras += 1;
			if($classificacao == $record['classificacaosistema'])
				$totalSistema += 1;
			$smarty->assign("checked_treeBalanceado", "active",true);
			$conteudo .= "<tr><td class='{$record['ficha']}'>{$record['ficha']}</td><td class='{$record['classificacaoenfermeiro']}'>{$record['classificacaoenfermeiro']}</td>
							 <td class='{$record['classificacaosistema']}'>{$record['classificacaosistema']}</td><td class='{$classificacao}'>{$classificacao}</td></tr>";
			break;
		case 'treeEnfermeiro' :
			$objEnf = new Regras_TreeEnf129505();
			$classificacao = $objEnf->obtemClassificacao($record);
			if($classificacao == $record['classificacaoenfermeiro'])
				$totalRegras += 1;
			if($classificacao == $record['classificacaosistema'])
				$totalSistema += 1;
			$smarty->assign("checked_treeEnfermeiro", "active",true);
			$conteudo .= "<tr><td class='{$record['ficha']}'>{$record['ficha']}</td><td class='{$record['classificacaoenfermeiro']}'>{$record['classificacaoenfermeiro']}</td>
							 <td class='{$record['classificacaosistema']}'>{$record['classificacaosistema']}</td><td class='{$classificacao}'>{$classificacao}</td></tr>";
			break;
		case 'treeMadrugada' :
			$objMadrugada = new Regras_TreeMadrugada();
			$classificacao = $objMadrugada->obtemClassificacao($record);
			if($classificacao == $record['classificacaoenfermeiro'])
				$totalRegras += 1;
			if($classificacao == $record['classificacaosistema'])
				$totalSistema += 1;
			$smarty->assign("checked_treeMadrugada", "active",true);
			$conteudo .= "<tr><td class='{$record['ficha']}'>{$record['ficha']}</td><td class='{$record['classificacaoenfermeiro']}'>{$record['classificacaoenfermeiro']}</td>
							 <td class='{$record['classificacaosistema']}'>{$record['classificacaosistema']}</td><td class='{$classificacao}'>{$classificacao}</td></tr>";
			break;
		default:
			$smarty->assign("_conteudo_", 'valor default',true);
	}
}
$conteudo.="</table>";
$smarty->assign("_conteudo_", $conteudo,true);
$smarty->assign("_total_", $linhas,true);
$smarty->assign("nroAcertosSistema", $totalSistema,true);
$smarty->assign("nroAcertosRegras", $totalRegras,true);
$smarty->assign("local", 'index.php',true);


$smarty->display('index.tpl');
?>