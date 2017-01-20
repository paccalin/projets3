<?php
class Modele extends Model{
	
    public function __construct($pLibelle = null, $pConstructeur = null, $pDateInsertion = null, $pId = null){ //constructeur vide utilisé par les sockets
        $this->id = $pId;
        $this->libelle = $pLibelle;
        $this->constructeur = $pConstructeur;
        if($pDateInsertion == null)
            $this->dateInsertion = date('d/m/Y h:i:s a', time());
        else
            $this->dateInsertion = $pDateInsertion;
    }
    
    static public $tableName = "modele";
    protected $id;
    protected $libelle;
    protected $constructeur;
    protected $dateInsertion;

    static public function FindByID($pId) {
        $query = db()->prepare("SELECT * FROM ".self::$tableName." WHERE id = ?");
        $query->bindParam(1, $pId, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $id = $row['id'];
            $libelle = $row['libelle'];
            $constructeur = Constructeur::FindById($row['constructeur_id']);
            $dateInsertion = $row['date_insertion'];     
            return new Modele($libelle, $constructeur, $dateInsertion, $id);
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

	static public function FindByConstructeurID($constructeur_id) {
        $query = db()->prepare("SELECT id FROM ".self::$tableName." WHERE constructeur_id=".$constructeur_id);
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
		$requete="INSERT INTO ".self::$tableName." VALUES (DEFAULT,'".$modele->libelle."',".$modele->constructeur->id.",CURRENT_TIMESTAMP)";
		$query = db()->prepare($requete);
		/* pour une certaine raison l'insertion ne fonctionne plus si je met un returning utilisateur_id */
		$query->execute();
		$modele->id = db()->lastInsertId();
	}

	static public function delete($modele){
		$query = db()->prepare("DELETE FROM ".self::$tableName." WHERE id=".$modele->id);
		$query->execute();
	}
}
?>
