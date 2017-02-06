<?php
require_once "class.RegrasBase.php";
class Regras_TreeGeral extends RegrasBase{
	
	public function obtemClassificacao($r){
		
		if($r['vl_temp_axila'] > 37.9){
			if($r['pas'] <= 85)
				return 'amarelo';
			if($r['vl_temp_axila'] <= 38.4)  
				return 'verde';
			else 
				return 'amarelo';
		}else{
			if($r['pas'] > 169){
				if($r['pas'] > 190)
					return 'amarelo';
				if($r['pad'] > 106)
					return 'amarelo';
				else 
					return 'verde';					
			}else{
				if($r['spo2'] > 94){
					if($r['fr'] > 25){
						if($r['fr'] > 49)
							return 'amarelo';
						else 
							return 'verde';
					}else
						return 'verde';
				}else{
					if($r['vl_temp_axila'] > 35.2){
						if($r['spo2'] > 30){
							if($r['spo2'] > 91){
								if($r['fc'] > 114)
									return 'amarelo';
								else 
									return 'verde';
							}else
								return 'amarelo';
						}else 
							return 'verde';
					}else 
						return 'amarelo';
				}
			}
		}
		
		return 'preto';
	}
	
}




?>