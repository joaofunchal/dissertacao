<?php
require_once "class.RegrasBase.php";
class Regras_TreeMadrugada extends RegrasBase{
	
	public function obtemClassificacao($r){
		if($r['vl_temp_axila'] > 37.9)
			return 'amarelo';
		else {
			if($r['spo2'] > 95){
				if($r['pas'] > 160)
					return 'amarelo';
				else{
					if($r['fr'] > 21){
						if($r['vl_temp_axila'] > 35.4)
							return 'verde';
						else{
							if($r['pas'] > 105)
								return 'amarelo';
							else 
								return 'verde';
						}
					}else{
						if($r['fr'] > 2)
							return 'verde';
						else{
							if($r['pad'] > 16)
								return 'amarelo';
							else
								return 'verde';
						}
					}
				}
			}else{
				if($r['spo2'] > 89)
					return 'amarelo';
				else{
					if($r['idade'] > 44)
						return 'vermelho';
					else{
						if($r['fr'] > 2){
							if($r['fr'] > 43)
								return 'amarelo';
							else
								return 'verde';
						}else 
							return 'amarelo';
							
							
					}
				}
				
			}			
			
			
		}
			
		return 'preto';
	}
	
}




?>