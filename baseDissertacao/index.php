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
	
WHERE aa_ficha IN (2012,2013) 
order by random()");
$totalSistema = 0;
$totalRegras = 0;

while($record = $con->fetch(PDO::FETCH_ASSOC)){
	switch ($_GET['view']){
		case 'treeGeral' :
			$objGeral = new Regras_TreeGeral();
			$classificacao = $objGeral->obtemClassificacao($record);
			if($classificacao == $record['classificacaoenfermeiro'])
				$totalRegras += 1;
			if($classificacao == $record['classificacaosistema'])
				$totalSistema += 1;
			$smarty->assign("checked_treeGeral", "checked",true);
			$conteudo = $classificacao;
			break;
		case 'treeBalanceado' :
			$objBalanceado = new Regras_TreeBalanceado();
			$classificacao = $objBalanceado->obtemClassificacao($record);
			if($classificacao == $record['classificacaoenfermeiro'])
				$totalRegras += 1;
			if($classificacao == $record['classificacaosistema'])
				$totalSistema += 1;
			$smarty->assign("checked_treeBalanceado", "checked",true);
			$conteudo = $classificacao;
			break;
		case 'treeEnfermeiro' :
			$objEnf = new Regras_TreeEnf129505();
			$classificacao = $objEnf->obtemClassificacao($record);
			if($classificacao == $record['classificacaoenfermeiro'])
				$totalRegras += 1;
			if($classificacao == $record['classificacaosistema'])
				$totalSistema += 1;
			$smarty->assign("checked_treeEnfermeiro", "checked",true);
			$conteudo = $classificacao;
			break;
		case 'treeMadrugada' :
			$objMadrugada = new Regras_TreeMadrugada();
			$classificacao = $objMadrugada->obtemClassificacao($record);
			if($classificacao == $record['classificacaoenfermeiro'])
				$totalRegras += 1;
			if($classificacao == $record['classificacaosistema'])
				$totalSistema += 1;
			$smarty->assign("checked_treeMadrugada", "checked",true);
			$conteudo = $classificacao;
			break;
		default:
			$smarty->assign("_conteudo_", 'valor default',true);
	}

}

$smarty->assign("_conteudo_", $conteudo,true);
$smarty->assign("nroAcertosSistema", $totalSistema,true);
$smarty->assign("nroAcertosRegras", $totalRegras,true);
$smarty->assign("local", 'index.php',true);


$smarty->display('index.tpl');
?>