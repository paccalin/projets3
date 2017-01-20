<?php
class Utilisateur extends Model{
	
    public function __construct($pPseudo = null, $pMotDePasse = null, $pDroits = null, $pDateInsertion = null, $pId=null){
		/* constructeur vide utilisé par les sockets */
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
        $query = db()->prepare("SELECT * FROM ".self::$tableName." WHERE id = ?");
        $query->bindParam(1, $pId, PDO::PARAM_INT);
        $query->execute();
		if ($query->rowCount() > 0){
			$results = $query->fetchAll();
			foreach ($results as $row) {
				$id = $row['id'];
				$pseudo = $row['pseudo'];
				$motDePasse = $row['motDePasse'];
				$droits = $row['droits'];   
				$dateInsertion = $row['date_insertion'];
			}
            		return new Utilisateur($pseudo, $motDePasse, $droits, $dateInsertion, $id);
		}
        return null;
    }

    static public function FindByPseudo($pUserName) {
        $query = db()->prepare("SELECT id FROM ".self::$tableName." WHERE pseudo = ?");
        /*$query->bindParam(1, self::$pUserName, PDO::PARAM_STR);*/
	$query->bindParam(1, $pUserName, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() > 0){
            $results = $query->fetchAll();
            foreach ($results as $row) {
                return self::FindById($row["id"]);
            }
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

	static public function insert($user){
		$query = db()->prepare("INSERT INTO ".self::$tableName." VALUES (DEFAULT,'".$user->pseudo."','".$user->motDePasse."',".$user->droits.",CURRENT_TIMESTAMP)");
		/* pour une certaine raison l'insertion ne fonctionne plus si je met un returning utilisateur_id */
		$query->execute();
		$user->id = db()->lastInsertId();
	}

	static public function update($user){
		$query = db()->prepare("UPDATE ".self::$tableName." SET pseudo='".$user->pseudo."', motDePasse='".$user->motDePasse."', droits=".$user->droits." WHERE id=".$user->id);
		$query->execute();
	}

	static public function delete($user){
		$query = db()->prepare("DELETE FROM ".self::$tableName." WHERE id=".$user->id);
		$query->execute();
	}
}
?>
