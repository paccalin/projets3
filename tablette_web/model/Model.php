<?php

class Model {
	public function __construct($id=null){
        
    }

	public function __get($fieldName) {
		$varName = $fieldName;
		if (property_exists(get_class($this), $varName))
			return $this->$varName;
		else
			throw new Exception("Unknown variable: ".$fieldName);
	}
	public function __set($fieldname,$value) {
	        $this->$fieldname = $value;
	        global $db;
	        $class = strtolower(get_class($this));
	        $index = strrpos($class,"_");
	        $abr = substr($class,$index+1);
	        $colName =  $abr."_id";
	        $st = $db->prepare("update $class set $fieldname=:value where $colName=:id");
	        $st->bindValue(":id",$this->$colName);
	        $st->bindValue(":value",$value);
	        /*$st->bindValue(":value",$db->quote($value));*/ ///AJOUTER POUR EVITER FAILLE XLS
	        $st->execute();
	    }





/*
	public function __toString() {
		return "";//get_class($this).": ".$this->name;
	}
*/


}