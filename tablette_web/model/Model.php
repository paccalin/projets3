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
	
	static public function toObject($class,$json){		
		$table = ucfirst($class);
		$objet = new $table();
		$jsonArr = json_decode($json);
		foreach ($jsonArr as $nomAttr => $valeurAttr){
			$nomAttrMaj=ucfirst($nomAttr);
			$nomAttr=lcfirst($nomAttr);
			$classes=['Client','Constructeur','Devis','Model','Modele','Option','Photo','Rendezvous','Socket','Utilisateur','Vehicule','TypeOption','TypeModele'];
			//echo $nomAttr." => ".$valeurAttr."<br/>";	/* DEBUG */
			if(in_array($nomAttrMaj,$classes)){
				$objet->$nomAttr=$nomAttrMaj::FindById($valeurAttr);
			}else{
				$objet->$nomAttr=$valeurAttr;
			}
		}
		return $objet;
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
