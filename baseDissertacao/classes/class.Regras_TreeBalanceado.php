<?php
require_once "class.RegrasBase.php";
class Regras_TreeBalanceado extends RegrasBase{
	
	public function obtemClassificacao($r){
		
		if($r['spo2'] > 93){
			if($r['vl_temp_axila'] > 37.9)
				return 'amarelo';
			else{
				if($r['pas'] > 175)
					return 'amarelo';
				else{
					if($r['vl_temp_axila'] > 34.3){
						if($r['fr'] > 24){
							if($r['pas'] > 125)
								return 'amarelo';
							else{
								if($r['idade'] > 1){
									if($r['idade'] > 19)
										return 'amarelo';
									else 
										return 'verde';
								}else
									return 'amarelo';
							}
						}else{
							if($r['fr'] > 0){
								if($r['spo2'] > 98)
									return 'azul';
								else{
									if($r['fr'] > 18){
										if($r['idade'] > 24){
											if($r['cd_sexo'] == 'F'){
												if($r['fr'] > 21)
													return 'verde';
												else
													return 'azul';
											}else
												return 'azul'; 
										}else 
											return 'azul';
									}else 
										return 'verde';
								}
							}else
								return 'amarelo';
						}
					}else 
						return 'vermelho';
				}
			}
		}else 
			return 'vermelho';
		
		return 'preto';
	}
	
}




?>