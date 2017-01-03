<?php
class Option extends Model{
    public function __construct($pLibelle, $pDesc, $pPrixDeBase, $pDateInsertion = null, $pId=null){
        $this->id = $pId;
        $this->libelle = $pLibelle;
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
    protected $desc;
	protected $prixDeBase;
    protected $dateInsertion;

    static public function FindByID($pId) {
        $query = db()->prepare("SELECT * FROM ".self::$tableName." WHERE id = ?");
        $query->bindParam(1, $pId, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $id = $row['id'];
            $libelle = $row['libelle'];
            $desc = $row['description'];
			$prixDeBase = $row['prixDeBase'];
            $dateInsertion = $row['date_insertion'];  
            return new Option($libelle, $desc, $prixDeBase, $dateInsertion, $id);
        }
        return null;
    }

    static function FindByVehicule($pVehicleId){
        $query = db()->prepare("SELECT id FROM join_vehicule_option WHERE vehicule_id = ?");
        $query->bindParam(1, $pVehicleId, PDO::PARAM_INT);
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

	static function FindByLibelle($pLibelle){
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

	static public function findJoinModeleOptionByOptionID($optionId){
        $query = db()->prepare("SELECT * FROM join_modele_option WHERE option_id=".$optionId);
        $query->execute();
        $returnList = array();
        if ($query->rowCount() > 0){
            $results = $query->fetchAll();
            foreach ($results as $row) {
                array_push($returnList,['modele'=>$row['modele_id'],'prix'=>$row['prix']]);
            }
        }
        return $returnList;
    }

	static public function moyenneTarifByID($optionId) {
        $query = db()->prepare("SELECT AVG(prix) as moyenne FROM join_modele_option WHERE option_id=".$optionId);
        $query->bindParam(1, $pId, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row['moyenne'];
        }
        return "ERREUR";
    }

	static public function insert($option){
		$query = db()->prepare("INSERT INTO ".self::$tableName." VALUES (DEFAULT,'".$option->libelle."','".$option->desc."',".$option->prixDeBase.",CURRENT_TIMESTAMP)");
		/* pour une certaine raison l'insertion ne fonctionne plus si je met un returning utilisateur_id */
		/*
			INSERER TOUS LES JOIN_MODELE_OPTION ICI
		*/
		$query->execute();
	}

	static public function delete($option){
		$query = db()->prepare("DELETE FROM ".self::$tableName." WHERE id=".$option->id);
		$query->execute();
	}
}
?>
