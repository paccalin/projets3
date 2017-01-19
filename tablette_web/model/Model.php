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
	
}
?>
