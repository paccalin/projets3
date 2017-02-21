<?php
class Devis extends Model{
	
    public function __construct($pClient = null, $pUtilisateur = null, $pPath = null, $pActif = null, $pModele = null,$pDateInsertion = null,$pId = null){
		/* constructeur vide utilisé par les sockets */
        if($pId == null){
				$this->id = uniqid();
		}
		else{
				$this->id = $pId;
		}
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
        $returnList = [];
        if ($query->rowCount() > 0){
            $results = $query->fetchAll();
            foreach ($results as $row) {
                array_push($returnList, self::FindById($row["id"]));
            }
        }
        return $returnList;
    }

	//bientot obsolete : 
	
	static public function FindJoinOptionsByDevisID($devisID) {
		$query = db()->prepare("SELECT * FROM join_modele_option WHERE option_id IN ( SELECT option_id FROM join_devis_option WHERE devis_id=".$devisID.") AND modele_id=".Devis::FindByID($devisID)->modele->id);
		$query->execute();
		$returnList = [];
        if ($query->rowCount() > 0){
            $results = $query->fetchAll();
            foreach ($results as $row) {
                array_push($returnList,['option'=>Option::FindByID($row['option_id']),'prix'=>$row['prix']]);
            }
        }
        return $returnList;
	}
	
	static public function FindByString($string){
		$returnList=[];
		$req = "SELECT * FROM ".self::$tableName." WHERE client_id IN (SELECT id FROM client WHERE UPPER(nom) LIKE UPPER('%".$string."%') OR UPPER(prenom) LIKE UPPER('%".$string."%')) OR modele_id IN (SELECT id FROM modele WHERE UPPER(libelle) LIKE UPPER('%".$string."%')) OR id='".$string."'";
		//echo $req;
		$query = db()->prepare($req);
		$query->execute();
		$returnList = [];
        if ($query->rowCount() > 0){
            $results = $query->fetchAll();
            foreach ($results as $row) {
                array_push($returnList,Devis::FindByID($row['id']));
            }
        }
		return $returnList;
	}

	static public function createJoinOptions($devis,$options){
		foreach($options as $option){
			$query = db()->prepare("INSERT INTO join_devis_option VALUES(DEFAULT,".$option->id.",".$devis->id.",CURRENT_TIMESTAMP)");
			$query->execute();
		}
	}
	
	static public function getNextID(){
		$requete = "SELECT Max(id)+1 as id FROM ".self::$tableName;
		$query = db()->prepare($requete);
		if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
			return $row['id'];
		}
	}
	
	static public function insert($devis){
		$query = db()->prepare("INSERT INTO ".self::$tableName." VALUES (DEFAULT,".$devis->client->id.",".$devis->utilisateur->id.",'".$devis->path."',".$devis->actif.",".$devis->modele->id.",CURRENT_TIMESTAMP)");
		$query->execute();
		$devis->id = db()->lastInsertId();
	}
	
	static public function delete($devis){
		$query = db()->prepare("DELETE FROM ".self::$tableName." WHERE id=".$devis->id);
		$query->execute();
	}
}

?>
