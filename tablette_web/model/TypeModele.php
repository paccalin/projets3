<?php
class TypeModele extends Model{
	
    public function __construct($pLibelle = null, $pDateInsertion = null, $pId = null){ //constructeur vide utilisé par les sockets
        if($pId==null){
			$this->id = Model::randomId();
        }else{
			$this->id = $pId;
		}
        $this->libelle = $pLibelle;
        if($pDateInsertion == null)
            $this->dateInsertion = date('d/m/Y h:i:s a', time());
        else
            $this->dateInsertion = $pDateInsertion;
    }
    
    static public $tableName = "typemodele";
    protected $id;
    protected $libelle;
    protected $dateInsertion;
	
	static public function FindByID($pId) {
        $query = db()->prepare("SELECT * FROM ".self::$tableName." WHERE id = '".$pId."'");
        $query->bindParam(1, $pId, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $id = $row['id'];
            $libelle = $row['libelle'];
            $dateInsertion = $row['date_insertion'];
            return new TypeModele($libelle, $dateInsertion, $id);
        }
        return null;
    }
	
	static public function FindAll() {
        $query = db()->prepare("SELECT id FROM ".self::$tableName." ORDER BY libelle");
        $query->execute();
        $returnList = array();
        if ($query->rowCount() > 0){
            $results = $query->fetchAll();
            foreach ($results as $row) {
                array_push($returnList, self::FindById($row["id"]));
            }
        }
        return $returnList;
    }
	
	static public function FindByLibelle($pLibelle){
		$query = db()->prepare("SELECT id FROM ".self::$tableName." WHERE libelle='".$pLibelle."'");
        $query->execute();
        $returnList = array();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return self::FindById($row["id"]);
        }
        return null;
	}
	
	static public function FindByJoinOptionId($joinOptionId){
		$query = db()->prepare("SELECT typeModele_id FROM join_typemodele_option WHERE id='".$joinOptionId."'");
        $query->execute();
        $returnList = array();
        if ($query->rowCount() > 0){
        	$row = $query->fetch(PDO::FETCH_ASSOC);
            array_push($returnList, self::FindByID($row["typeModele_id"]));
        }
        return $returnList;
	}
	
	static public function insert($typeModele){
		$query = db()->prepare("INSERT INTO ".self::$tableName." VALUES('".$typeModele->id."','".$typeModele->libelle."',CURRENT_TIMESTAMP)");
        $query->execute();
		foreach(Option::FindAll() as $option){
			$requete="INSERT INTO join_typemodele_option VALUES('".Model::randomId()."','".$option->id."','".$typeModele->id."',".$option->prixDeBase.",CURRENT_TIMESTAMP)";
			//echo $requete;
			$query=db()->prepare($requete);
			$query->execute();
		}
	}
	
	static public function update($typeModele){
		$query = db()->prepare("UPDATE ".self::$tableName." SET libelle='".$typeModele->libelle."' WHERE id='".$typeModele->id."'");
		$query->execute();
	}
}
