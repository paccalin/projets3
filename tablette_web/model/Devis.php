<?php
class Devis extends Model{
    public function __construct($pClient, $pUtilisateur, $pPath, $pActif, $pModele,$pDateInsertion,$pId=null){
        $this->id = $pId;
        $this->client = $pClient;
        $this->utilisateur = $pUtilisateur;
        $this->path = $pPath;
        $this->actif = $pActif;
		$this->modele = $pModele;
        if($pDateInsertion == null)
            $this->dateInsertion = date('d/m/Y h:i:s a', time());
        else
            $this->dateInsertion = $pDateInsertion;
    }

    static public $tableName = "devis";
    protected $id;
    protected $client;
    protected $utilisateur;
    protected $path;
    protected $actif;
	protected $modele;
    protected $dateInsertion;

    static public function FindByID($pId){
        $query = db()->prepare("SELECT * FROM ".self::$tableName." WHERE id = ?");
        $query->bindParam(1, $pId, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $id = $row['id'];
            $client = Client::FindById($row['client_id']);
            $utilisateur = Utilisateur::FindById($row['utilisateur_id']);
            $path = $row['path'];
            $actif = $row['actif'];
			$modele = Modele::FindByID($row['modele_id']);
            $dateInsertion = $row['date_insertion'];       
            return new Devis($client, $utilisateur, $path, $actif, $modele, $dateInsertion, $id);
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

	static public function FindJoinOptionsByDevisID($devisID) {
		$query = db()->prepare("SELECT * FROM join_modele_option WHERE option_id IN ( SELECT option_id FROM join_devis_option WHERE devis_id=".$devisID.") AND modele_id=".Devis::FindByID($devisID)->modele->id);
		$query->execute();
		$returnList = array();
        if ($query->rowCount() > 0){
            $results = $query->fetchAll();
            foreach ($results as $row) {
                array_push($returnList,['option'=>Option::FindByID($row['option_id']),'prix'=>$row['prix']]);
            }
        }
        return $returnList;
	}

	static public function getNewID(){
		$query = db()->prepare("SELECT max(id)+1 as newId FROM ".self::$tableName);
		$query->execute();
        if($query->rowCount()>0){
		 	$row = $query->fetch(PDO::FETCH_ASSOC);
			return $row['newId'];
        }
	}
	
	static public function insert($devis){
		$query = db()->prepare("INSERT INTO ".self::$tableName." VALUES (DEFAULT,".$devis->client->id.",".$devis->utilisateur->id.",'".$devis->path."',".$devis->actif.",".$devis->modele->id.",CURRENT_TIMESTAMP)");
		$query->execute();
	}

	static public function delete($devis){
		$query = db()->prepare("DELETE FROM ".self::$tableName." WHERE id=".$devis->id);
		$query->execute();
	}
}

?>
