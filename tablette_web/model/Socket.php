<?php
class Socket extends Model{
    public function __construct($pDestinataire, $pAction, $pTable, $pJson, $pDateInsertion = null, $pId=null){
        if($pId==null){
			$this->id = Model::randomId();
        }else{
			$this->id = $pId;
		}
		$this->destinataire = $pDestinataire;
		$this->action = $pAction;
		$this->table = $pTable;
        $this->json = $pJson;
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
    protected $json;
    protected $dateInsertion;
	
	static public function FindById($pId) {
        $query = db()->prepare("SELECT * FROM ".self::$tableName." WHERE id = '".$pId."'");
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
			//print_r($objetJson);
            $id = $row['id'];
			$destinataire = $row['destinataire'];
            $action = $row['action'];
			$table = $row['tableDb'];
			$json = $row['json'];
            $dateInsertion = $row['date_insertion'];
            return new Socket($destinataire, $action, $table, $json, $dateInsertion, $id);
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
	
	static public function store($dest,$action,$table,$json){
		$socket = new Socket($dest,$action,$table,$json);
		Socket::insert($socket);
	}
	
	static public function readMultiple($sockets,$passage,$trace=null){
		/*
			Ajouter:
				-passage d'insertion (4x)
				-passage de modification  (4x)
				-passage de suppresion (4x)
		*/
		/* Plusieurs passages:
			- utilisateur, typeOption, client, constructeur, typeModele
			- (rdv), option, panier, modele
			- vehicule, joinPanierOption, joinTypeModeleOption
			- (joinVehiculeOption)
		*/
		if($trace==null){
			$trace=[];
		}
		if($passage<4){
			$tables = [
				0 => ["utilisateur","typeOption","client","constructeur","typeModele"],
				1 => ["rendezvous","option","panier","modele"],
				2 => ["vehicule","joinPanierOption","joinTypeModeleOption"],
				3 => ["joinVehiculeOption"]
			];
			//echo "<br/>--- passage ".$passage."<br/>";
			foreach($sockets as $socket){
				if(in_array($socket->table, $tables[$passage])){
					//print_r($socket);
					//echo "<br/>";
					//$socket->read();
					//echo "réussite<br/>";
					try{
						$socket->read();
						array_push($trace,["statut"=>"OK","action"=>$socket->action,"table"=>$socket->table]);
					}catch(Exception $e){
						array_push($trace,["statut"=>"ECHEC","action"=>$socket->action,"table"=>$socket->table]);
					}
				}
			}
			Socket::readMultiple($sockets,$passage+1,$trace);
		}else{
			return $trace;
		}
	}
	
	private function read(){
		//print_r($socket->objet); 	/* DEBUG */
		//echo '<br/>';				/* DEBUG */
		$table=$this->table;
		$table=ucfirst($table);
		$action=$this->action;
		$obj = Model::toObject($table,$this->json);
		var_dump($obj);
		$table::$action($obj);

		//Socket::delete($this);
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
		$requete = "INSERT INTO ".self::$tableName." VALUES ('".$socket->id."','".$socket->destinataire."','".$socket->action."','".$socket->table."','".$socket->json."',CURRENT_TIMESTAMP)";
		//echo $requete;
		$query = db()->prepare($requete);
		$query->execute();
	}
	
	static public function delete($socket){
		$query = db()->prepare("DELETE FROM ".self::$tableName." WHERE id='".$socket->id."'");
		$query->execute();
	}
}
?>
