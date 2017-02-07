<?php
require_once('smarty-3.1.30/libs/Smarty.class.php');
$smarty = new Smarty();

require_once 'classes/class.Regras_TreeGeral.php';
require_once 'classes/class.Regras_TreeBalanceado.php';
require_once 'classes/class.Regras_TreeEnf129505.php';
require_once 'classes/class.Regras_TreeMadrugada.php';

$record = array(
		"idade" => 12,
		"cd_sexo" => 'M',
		"pas" => 250,
		"pad" => 150,
		"fc" => 180,
		"fr" => 50,
		"spo2" => 84,
		"glasgow_ocular"=> 4,
		"glasgow_verbal"=> 4,
		"glasgow_motora"=> 4,
		"vl_temp_axila" => 36.7,
		"classificacaoEnfermeiro" => "amarelo",
		"classificacaoSistema" => "vermelho"
); 

$objGeral = new Regras_TreeGeral();
$objBalanceado = new Regras_TreeBalanceado();
$objEnf = new Regras_TreeEnf129505();
$objMadrugada = new Regras_TreeMadrugada();

if($objGeral->obtemClassificacao($record) == $record['classificacaoEnfermeiro'])
	$objGeral->nrRegClassIguaisRegras += 1;
if($objGeral->obtemClassificacao($record) == $record['classificacaoSistema'])
	$objGeral->nrRegClassIguaisSistema += 1;

$smarty->assign("_conteudo_", 'asdadadasdsaa',true);
$smarty->display('index.tpl');
?>