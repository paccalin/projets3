<?php
class Socket extends Model{
    public function __construct($pDestinataire, $pAction, $pTable, $pObjet, $pDateInsertion = null, $pId=null){
        $this->id = $pId;
		$this->destinataire = $pDestinataire;
		$this->action = $pAction;
		$this->table = $pTable;
        $this->objet = $pObjet;
        if($pDateInsertion == null)
            $this->dateInsertion = date('d/m/Y h:i:s a', time());
        else
            $this->dateInsertion = $pDateInsertion;
    }

    static public $tableName = "socket";
    protected $id;
	protected $destinataire;
	protected $action;
	protected $table;
    protected $objet;
    protected $dateInsertion;
	
	static public function FindById($pId) {
        $query = db()->prepare("SELECT * FROM ".self::$tableName." WHERE id = ?");
        $query->bindParam(1, $pId, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
			$objetJson = json_decode($row['json']);
            $id = $row['id'];
			$destinataire = $row['destinataire'];
            $action = $row['action'];
            $table = ucfirst($row['tableDb']);
            $objet = new $table();
			foreach (get_object_vars($objetJson) as $nomAttr=>$valeurAttr){
				$nomAttrMaj=ucfirst($nomAttr);
				$classes=['Client','Constructeur','Devis','Model','Modele','Option','Photo','Rendezvous','Socket','Utilisateur','Vehicule'];
				//echo $nomAttr." ".$valeurAttr."<br/>";	/* DEBUG */
				if(in_array($nomAttrMaj,$classes)){
					$objet->$nomAttr=$nomAttrMaj::FindById($valeurAttr);
				}else{
					$objet->$nomAttr=$valeurAttr;
				}
			}
            $dateInsertion = $row['date_insertion'];
            return new Socket($destinataire, $action, $table, $objet, $dateInsertion, $id);
        }
        return null;
    }


    static public function FindAllFor($pDest = null) {
		if($pDest=='centrale' or $pDest=='tablette'){
       		$query = db()->prepare("SELECT id FROM ".self::$tableName." WHERE destinataire='".$pDest."'");
		}else{
			$query = db()->prepare("SELECT id FROM ".self::$tableName);
		}
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
	
	static public function store($dest,$action,$table,$objet){
		$socket = new Socket($dest,$action,$table,$objet);
		Socket::insert($socket);
	}
	
	static public function read($socket){
		//print_r($socket->objet); 	/* DEBUG */
		//echo '<br/>';				/* DEBUG */
		$table=$socket->table;
		$action=$socket->action;
		$table::$action($socket->objet);

		Socket::delete($socket);
	}

	static public function compteMajEnAttente($pDest = null){
		if($pDest=='centrale' or $pDest=='tablette'){
       		$query = db()->prepare("SELECT count(id) as nb FROM ".self::$tableName." WHERE destinataire='".$pDest."'");
		}else{
			$query = db()->prepare("SELECT count(id) as nb FROM ".self::$tableName);
		}
        $query->execute();
        $returnList = array();
        if ($query->rowCount() > 0){
			$row = $query->fetch(PDO::FETCH_ASSOC);
			return $row['nb'];
		}else{
			return 'ERREUR';
		}
	}
	
	static public function insert($socket){
		$requete = "INSERT INTO ".self::$tableName." VALUES (DEFAULT,'".$socket->destinataire."','".$socket->action."','".$socket->table."','".$socket->objet->toJson()."',CURRENT_TIMESTAMP)";
		//echo $requete;
		$query = db()->prepare($requete);
		$query->execute();
	}
	
	static public function delete($socket){
		$query = db()->prepare("DELETE FROM ".self::$tableName." WHERE id=".$socket->id);
		$query->execute();
	}
}
?>
