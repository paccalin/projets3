<?php
class Constructeur extends Model{
	
    public function __construct($pLibelle = null, $pDateInsertion = null, $pId=null){
		/* constructeur vide utilisé par les sockets */
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
    
    static public $tableName = "constructeur";
    protected $id;
    protected $libelle;
    protected $dateInsertion;

    static public function FindByID($pId) {
        $query = db()->prepare("SELECT * FROM ".self::$tableName." WHERE id = '".$pId."'");
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
		$query = db()->prepare("INSERT INTO ".self::$tableName." VALUES ('".$constructeur->id."','".$constructeur->libelle."',CURRENT_TIMESTAMP)");
		$query->execute();
	}
	
	static public function update($constructeur){
		$requete="UPDATE ".self::$tableName." SET libelle='".$constructeur->libelle."' WHERE id='".$constructeur->id."'";
		//echo $requete;
		$query = db()->prepare($requete);
		$query->execute();
	}
}
?>
