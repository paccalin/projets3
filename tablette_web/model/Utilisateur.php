<?php
class Utilisateur extends Model{
    public function __construct($pPseudo, $pMotDePasse, $pDroits, $pDateInsertion = null, $pId=null){
        $this->id = $pId;
        $this->pseudo = $pPseudo;
        $this->motDePasse = $pMotDePasse;
        $this->droits = $pDroits;
        if($pDateInsertion == null)
            $this->dateInsertion = date('d/m/Y h:i:s a', time());
        else
            $this->dateInsertion = $pDateInsertion;
    }

    static public $tableName = "utilisateur";
    protected $id;
    protected $pseudo;
    protected $motDePasse;
    protected $droits;
    protected $dateInsertion;

    static public function FindByID($pId) {
        $query = db()->prepare("SELECT * FROM ".self::$tableName." WHERE utilisateur_id = ?");
        $query->bindParam(1, $pId, PDO::PARAM_INT);
        $query->execute();
		if ($query->rowCount() > 0){
			$results = $query->fetchAll();
			foreach ($results as $row) {
				$id = $row['utilisateur_id'];
				$pseudo = $row['utilisateur_pseudo'];
				$motDePasse = $row['utilisateur_motDePasse'];
				$droits = $row['utilisateur_droits'];   
				$dateInsertion = $row['utilisateur_date_insertion'];
			}
            		return new Utilisateur($pseudo, $motDePasse, $droits, $dateInsertion, $id);
		}
        return null;
    }

    static public function FindByPseudo($pUserName) {
        $query = db()->prepare("SELECT utilisateur_id FROM ".self::$tableName." WHERE utilisateur_pseudo = ?");
        /*$query->bindParam(1, self::$pUserName, PDO::PARAM_STR);*/
	$query->bindParam(1, $pUserName, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() > 0){
            $results = $query->fetchAll();
            foreach ($results as $row) {
                return self::FindById($row["utilisateur_id"]);
            }
        }
        return null;
    }

    static public function FindAll() {
        $query = db()->prepare("SELECT utilisateur_id FROM ".self::$tableName);
        $query->execute();
        $returnList = array();
        if ($query->rowCount() > 0){
            $results = $query->fetchAll();
            foreach ($results as $row) {
                array_push($returnList, self::FindById($row["utilisateur_id"]));
            }
        }
        return $returnList;
    }

	static public function insert($user){
		$query = db()->prepare("INSERT INTO ".self::$tableName." VALUES (DEFAULT,'".$user->pseudo."','".$user->motDePasse."',".$user->droits.",DEFAULT)");
		/* pour une certaine raison l'insertion ne fonctionne plus si je met un returning utilisateur_id */
        	$query->execute();
	}
}
?>
