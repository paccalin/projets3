<?php
class Constructeur extends Model{
	
    public function __construct($pLibelle = null, $pDateInsertion = null, $pId=null){
		/* constructeur vide utilisé par les sockets */
        $this->id = $pId;
        $this->libelle = $pLibelle;
        if($pDateInsertion == null)
            $this->dateInsertion = date('d/m/Y h:i:s a', time());
        else
            $this->dateInsertion = $pDateInsertion;
    }
    
    static public $tableName = "constructeur";
    protected $id;
    protected $libelle;
    protected $dateInsertion;

    static public function FindByID($pId) {
        $query = db()->prepare("SELECT * FROM ".self::$tableName." WHERE id = ?");
        $query->bindParam(1, $pId, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $id = $row['id'];
            $libelle = $row['libelle'];
            $dateInsertion = $row['date_insertion'];
            return new Constructeur($libelle, $dateInsertion, $id);
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

	static public function FindByLibelle($libelle) {
        $query = db()->prepare("SELECT id FROM ".self::$tableName." WHERE UCASE(libelle) = UCASE('".$libelle."')");
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

	static public function insert($constructeur){
		$query = db()->prepare("INSERT INTO ".self::$tableName." VALUES (DEFAULT,'".$constructeur->libelle."',CURRENT_TIMESTAMP)");
		/* pour une certaine raison l'insertion ne fonctionne plus si je met un returning utilisateur_id */
		$query->execute();
		$constructeur->id = db()->lastInsertId();
	}
	
	static public function update($constructeur){
		$query = db()->prepare("UPDATE ".self::$tableName." SET libelle='".$constructeur->libelle."' WHERE id=".$constructeur->id);
		echo "UPDATE ".self::$tableName." SET libelle='".$constructeur->libelle."' WHERE id=".$constructeur->id;
		$query->execute();
	}
}
?>
