<?php

abstract class Model {	
	public function __construct(){
    }

	public function __get($fieldName) {
		$varName = $fieldName;
		if (property_exists(get_class($this), $varName))
			return $this->$varName;
		else
			throw new Exception("Unknown attribute: ".$fieldName);
	}

	public function __set($fieldname,$value) {
	        $this->$fieldname = $value;
	}
	
	public function getAttributs(){
		return get_object_vars($this);
	}
	
	public function toJson(){
		$attributs=[];
		foreach ($this->getAttributs() as $nomAttribut=>$valeurAttribut){
			if(is_object($valeurAttribut)){
				$attributs[$nomAttribut]=$valeurAttribut->id;
			}else{
				$attributs[$nomAttribut]=$valeurAttribut;
			}
		}		
		return json_encode($attributs);
	}
	
	static public function randomId(){
		$st='';
		$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$max = strlen($characters) - 1;
		for ($i = 0; $i < 20; $i++) {
			$st .= $characters[mt_rand(0, $max)];
		}
		return $st;
	}
}
?>
