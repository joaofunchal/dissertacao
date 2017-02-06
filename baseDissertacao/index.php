<?php
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
		"vl_temp_axila" => 36.7
		
); 

$objGeral = new Regras_TreeGeral();
$objBalanceado = new Regras_TreeBalanceado();
$objEnf = new Regras_TreeEnf129505();
$objMadrugada = new Regras_TreeMadrugada();
echo "Geral: ".$objGeral->obtemClassificacao($record);
echo '<br />';
echo "Balaceado: ".$objBalanceado->obtemClassificacao($record);
echo '<br />';
echo "Enfermeiro 129505: ".$objEnf->obtemClassificacao($record);
echo '<br />';
echo "Madrugada ".$objMadrugada->obtemClassificacao($record);
echo '<br />';
?>