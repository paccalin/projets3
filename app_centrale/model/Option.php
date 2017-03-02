<?php
class Option extends Model{
	
    public function __construct($pLibelle = null, $pTypeOption = null, $pDesc = null, $pPrixDeBase = null, $pDateInsertion = null, $pId=null){
		/* constructeur vide utilisé par les sockets */
        if($pId==null){
			$this->id = Model::RandomId();
        }else{
			$this->id = $pId;
		}
        $this->libelle = $pLibelle;
		$this->typeOption = $pTypeOption;
        $this->desc = $pDesc;
		$this->prixDeBase = $pPrixDeBase;
        if($pDateInsertion == null)
            $this->dateInsertion = date('d/m/Y h:i:s a', time());
        else
            $this->dateInsertion = $pDateInsertion;
    }

    static public $tableName = "options";
    protected $id;
    protected $libelle;
	protected $typeOption;
    protected $desc;
	protected $prixDeBase;
    protected $dateInsertion;

    static public function FindByID($pId) {
        $query = db()->prepare("SELECT * FROM ".self::$tableName." WHERE id = '".$pId."'");
        $query->execute();		
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $id = $row['id'];
            $libelle = $row['libelle'];
			$typeOption = TypeOption::FindById($row['typeoption_id']);
            $desc = $row['description'];
			$prixDeBase = $row['prixDeBase'];
            $dateInsertion = $row['date_insertion'];  
            return new Option($libelle, $typeOption,$desc, $prixDeBase, $dateInsertion, $id);
        }
        return null;
    }

    static public function FindByVehicule($pVehiculeId){
        $query = db()->prepare("SELECT option_id FROM join_vehicule_option WHERE vehicule_id = '".$pVehiculeId."'");
        $query->execute();
        $returnList = array();		
        if ($query->rowCount() > 0){
            $results = $query->fetchAll();
            foreach ($results as $row) {
                array_push($returnList, self::FindById($row["option_id"]));
            }
        }
        return $returnList;
    }

	static public function FindByLibelle($pLibelle){
        $query = db()->prepare("SELECT id FROM ".self::$tableName." WHERE libelle='".$pLibelle."'");
        $query->bindParam(1, $pLibelle, PDO::PARAM_INT);
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

	static public function FindByTypeOptionId($pId){
		$query = db()->prepare("SELECT id FROM ".self::$tableName." WHERE typeoption_id='".$pId."'");
        $query->bindParam(1, $pLibelle, PDO::PARAM_INT);
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

    static public function FindAll() {
        $query = db()->prepare("SELECT id FROM ".self::$tableName);
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


	static public function findJoinTypeModeleOptionByOptionId($optionId){
        $query = db()->prepare("SELECT * FROM join_typemodele_option WHERE option_id='".$optionId."'");
        $query->execute();
        $returnList = array();
        if ($query->rowCount() > 0){
            $results = $query->fetchAll();
            foreach ($results as $row) {
                array_push($returnList,['id'=>$row['id'],'option'=>Option::FindByID($optionId),'typeModele'=>TypeModele::FindByID($row['typemodele_id']),'prix'=>$row['prix']]);
            }
        }
        return $returnList;
    }
	
	static public function findJoinTypeModeleOptionByType($typeId){
        $query = db()->prepare("SELECT * FROM join_typemodele_option WHERE typeModele_id='".$typeId."'");
        $query->execute();
        $returnList = array();
        if ($query->rowCount() > 0){
            $results = $query->fetchAll();
            foreach ($results as $row) {
                array_push($returnList,['id'=>$row['id'],'option'=>Option::FindByID($row['option_id']),'typeModele'=>TypeModele::FindByID($typeId),'prix'=>$row['prix']]);
            }
        }
        return $returnList;
    }

	static public function moyenneTarifByID($optionId) {
        $query = db()->prepare("SELECT AVG(prix) as moyenne FROM join_typemodele_option WHERE option_id='".$optionId."'");
        $query->bindParam(1, $pId, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row['moyenne'];
        }
        return -1;
    }

	static public function insert($option){
		$query = db()->prepare("INSERT INTO ".self::$tableName." VALUES ('".$option->id."','".$option->libelle."','".$option->typeOption->id."','".$option->desc."',".$option->prixDeBase.",CURRENT_TIMESTAMP)");
		$query->execute();
		foreach(TypeModele::FindAll() as $typeModele){
			$requete="INSERT INTO join_typemodele_option VALUES('".Model::randomId()."','".$option->id."','".$typeModele->id."',".$option->prixDeBase.",CURRENT_TIMESTAMP)";
			//echo $requete;
			$query=db()->prepare($requete);
			$query->execute();
		}
	}

	static public function update($option){
		$requete = "UPDATE ".self::$tableName." SET libelle='".$option->libelle."',typeoption_id='".$option->typeOption->id."',description='".$option->desc."',prixDeBase=".$option->prixDeBase.",date_insertion='".$option->dateInsertion."' where id='".$option->id."'";
		//echo $requete;
		$query = db()->prepare($requete);
		$query->execute();
	}
	
	static public function updateJoinTypeModeleOption($option,$joins){
		$requete="";
		foreach($joins as $updateJoinTypeModeleOption){
			$requete.="UPDATE join_typemodele_option SET prix=".$updateJoinTypeModeleOption['tarif']." WHERE id='".$updateJoinTypeModeleOption['id']."';";	
		}
		if($joins!=[]){
			$query=db()->prepare($requete);
			$query->execute();
		}
	}
	
	static public function delete($option){
		$requete = 'DELETE FOM join_panier_option WHERE option_id='.$option->id."'";
		//echo $requete;
		$query = db()->prepare($requete);
		$query->execute();
		$requete = "DELETE FROM ".self::$tableName." WHERE id='".$option->id."'";
		//echo $requete;
		$query = db()->prepare($requete);
		$query->execute();
	}
	
	static public function FindByPanierID($panier){
		$query = db()->prepare("SELECT * FROM options WHERE id IN ( SELECT option_id FROM join_panier_option WHERE panier_id='".$panier->id."')");
		$query->execute();
		$returnList = [];
        if ($query->rowCount() > 0){
            $results = $query->fetchAll();
            foreach ($results as $row) {
                array_push($returnList,Option::FindByID($row['id']));
            }
        }		
        return $returnList;
	}
}
?>
