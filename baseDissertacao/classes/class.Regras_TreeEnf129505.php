<?php
require_once "class.RegrasBase.php";
class Regras_TreeEnf129505 extends RegrasBase{
	
	public function obtemClassificacao($r){
		if($r['spo2'] > 94){
			if($r['vl_temp_axila'] > 37.8){
				if($r['idade'] > 13){
					if($r['fr'] > 21){
						if($r['vl_temp_axila'] > 38.9)
							return 'amarelo';
						else{
							if($r['idade'] > 35)
								return 'amarelo';
							else
								return 'verde';
						}
					}else
						return 'verde';
				}else
					return 'amarelo';
					
			}else{
				if($r['pad'] > 110){
					if($r['idade'] > 14)
						return 'amarelo';
					else
						return 'verde';
				}else{
					if($r['fr'] > 21){
						if($r['idade'] > 16){
							if($r['idade'] > 77)
								return 'amarelo';
							else{
								if($r['fr'] > 24){
									if($r['spo2'] > 99)
										return 'amarelo';
									else{
										if($r['vl_temp_axila'] > 36.4)
											return 'verde';
										else
											return 'amarelo';
									}
								}else{
									if($r['vl_temp_axila'] > 35.6)
										return 'verde';
									else{
										if($r['pad'] > 85)
											return 'amarelo';
										else
											return 'verde';
									}
								}
							}
						}else
							return 'verde';						
					}else
						return 'verde';
				}
			}
			
		}else
			return 'amarelo';
		
		return 'preto';
	}
	
}




?>