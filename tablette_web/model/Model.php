<?php

class Model {

	public function __construct($id=null) {
		global $db;
		global $tables;
		
		/*if (is_array($id))[
			]*/

		$class = strtolower(get_class($this));
		$index = strrpos($class,"_");
		$abr = substr($class,$index+1);
		if ($id==null) {
			$st = $db->prepare("insert into $class default values returning $abr"."_id");
			$st->execute();
			$row = $st->fetch(PDO::FETCH_ASSOC);
			$id = $abr."_id";
			$this->$id = $row[$id];
		} 
		else {
			$st = $db->prepare("SELECT * from $class where $abr"."_id=:id");
			$st->bindValue(":id",$id);
			$st->execute();
			$row = $st->fetch(PDO::FETCH_ASSOC);
			$Test = true ;
			if($Test){

				foreach($row as $key=>$value) {
					if(preg_match('/_id$/',$key) && $key != ($abr."_id")){

						$liaison = preg_replace('/_id/', '', $key);
						$classname = $tables[$liaison];
						$etranger = new $classname($value);
						$this->$key = $etranger;
					}
					else{
						$this->$key = $value;
					}
				}
			}
			else{
				foreach($row as $attr=>$value){
					$this->$attr = $value;
				}
			}
		}
	}


	public static function findAllSelect($where=null, $option=null) {

		$class = get_called_class();
		$table = strtolower($class);
		if($where != null){
			$requete = "select * from $table where ".$where;
		}
		else{
			$requete = "select * from $table";
		}
		if($option != null){
			$requete = $requete." ".$option;
		}
		$st = db()->prepare($requete);
		$st->execute();
		$list = $st->fetchAll();
		return $list;
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