<?php
class Modele extends Model{
	
    public function __construct($pLibelle = null, $pConstructeur = null, $pTypeModele = null, $pDateInsertion = null, $pId = null){ //constructeur vide utilisé par les sockets
        if($pId==null){
			$this->id = Model::randomId();
        }else{
			$this->id = $pId;
		}
        $this->libelle = $pLibelle;
        $this->constructeur = $pConstructeur;
		$this->typeModele = $pTypeModele;
        if($pDateInsertion == null)
            $this->dateInsertion = date('d/m/Y h:i:s a', time());
        else
            $this->dateInsertion = $pDateInsertion;
    }
    
    static public $tableName = "modele";
    protected $id;
    protected $libelle;
    protected $constructeur;
	protected $typeModele;
    protected $dateInsertion;

    static public function FindByID($pId) {
        $query = db()->prepare("SELECT * FROM ".self::$tableName." WHERE id = '".$pId."'");
        $query->bindParam(1, $pId, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $id = $row['id'];
            $libelle = $row['libelle'];
            $constructeur = Constructeur::FindById($row['constructeur_id']);
			$typeModele = TypeModele::FindById($row['typemodele_id']);
            $dateInsertion = $row['date_insertion'];
            return new Modele($libelle, $constructeur, $typeModele, $dateInsertion, $id);
        }
        return null;
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

	static public function FindByConstructeurId($constructeur_id) {
        $query = db()->prepare("SELECT id FROM ".self::$tableName." WHERE constructeur_id='".$constructeur_id."' ORDER BY libelle");
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
	
	static public function FindByTypeModeleId($typeModele_id){
		$query = db()->prepare("SELECT id FROM ".self::$tableName." WHERE typemodele_id='".$typeModele_id."' ORDER BY libelle");
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

	static public function FindByLibelle($libelle) {
        $query = db()->prepare("SELECT id FROM ".self::$tableName." WHERE UCASE(libelle)=UCASE('".$libelle."')");
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
	
	static public function insert($modele){
		$requete="INSERT INTO ".self::$tableName." VALUES ('".$modele->id."','".$modele->libelle."','".$modele->constructeur->id."','".$modele->typeModele->id."',CURRENT_TIMESTAMP)";
		//echo $requete;
		$query = db()->prepare($requete);
		$query->execute();
	}

	static public function update($modele){
		$requete="UPDATE ".self::$tableName." SET libelle='".$modele->libelle."', constructeur_id='".$modele->constructeur->id."', typemodele_id='".$modele->typeModele->id."', date_insertion='".$modele->dateInsertion."' WHERE id='".$modele->id."'";
		$query = db()->prepare($requete);
		$query->execute();
	}
	
	static public function delete($modele){
		$query = db()->prepare("DELETE FROM ".self::$tableName." WHERE id='".$modele->id."'");
		$query->execute();
	}
}
?>
