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
	
	static public function FindById($pId, $source = null) {
		$requete = "SELECT * FROM ".self::$tableName." WHERE id = '".$pId."'";
		if($source!=null and $source == 'tablette'){
        	$query = CentraleMajController::dbTablette()->prepare($requete);
		}else{
       		$query = db()->prepare($requete);
		}
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
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

    static public function FindAll($pSource = null, $pDest = null,$date = null) {
		if($pDest=='centrale' or $pDest=='tablette'){
       		$requete = "SELECT id FROM ".self::$tableName." WHERE destinataire='".$pDest."'";
		}else{
			$requete = "SELECT id FROM ".self::$tableName." WHERE 1=1";
		}
		if($date!=null){
			$requete .= " AND date_insertion > '".$date."'";
		}
		//echo '<br/>';
		//echo $requete;
		//echo '<br/> Depuis '.$pSource.' vers '.$pDest;
		if($pSource != null and $pSource == 'tablette'){
			$query = CentraleMajController::dbTablette()->prepare($requete);
		}else{
			$query = db()->prepare($requete);
		}
        $query->execute();
        $returnList = array();
        if ($query->rowCount() > 0){
            $results = $query->fetchAll();
            foreach ($results as $row) {
                array_push($returnList, self::FindById($row["id"],$pSource));
            }
        }
        return $returnList;
    }
	
	static public function store($dest,$action,$table,$objet){
		$socket = new Socket($dest,$action,$table,$objet);
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
		//var_dump($obj);
		$table::$action($obj);

		Socket::delete($this);
	}

	static public function compteMajEnAttente($pDest = null){
		if($pDest=='centrale' or $pDest=='tablette'){
       		$requete = "SELECT count(id) as nb FROM ".self::$tableName." WHERE destinataire='".$pDest."'";
		}else{
			$requete = "SELECT count(id) as nb FROM ".self::$tableName;
		}
		$query = db()->prepare($requete);
        $query->execute();
        $returnList = array();
        if ($query->rowCount() > 0){
			$row = $query->fetch(PDO::FETCH_ASSOC);
			return $row['nb'];
		}else{
			return 'ERREUR';
		}
	}

	static public function TransfertT2C(){
		$tab = Tablette::FindByIp(parameters()['ip']);
		if($tab==null){
			$tab = new Tablette(parameters()['ip']);
			Tablette::insert($tab);
		}
		//print_r($tab);
		$sockets = Socket::FindAll('tablette','centrale');
		print_r($sockets);
		foreach($sockets as $socket){
			Socket::insert($socket,'centrale','tablette');
			Socket::delete($socket,'tablette');
		}
		Socket::readMultiple($sockets);
	}

	static public function TransfertC2T(){
		$tab = Tablette::FindByIp(parameters()['ip']);
		if($tab==null){
			$tab = new Tablette(parameters()['ip']);
			Tablette::insert($tab,'tablette');
		}
		$sockets = Socket::FindAll('centrale','tablette',$tab->lastConnect);
		foreach($sockets as $socket){
			Socket::insert($socket,'tablette','tablette');
		}
		Tablette::updateLastConnect($tab);
		//print_r($tab);
	}
	
	static public function insert($socket,$db=null,$dest=null){
		if($dest!=null){
			$requete = "INSERT INTO ".self::$tableName." VALUES ('".$socket->id."','".$dest."','".$socket->action."','".$socket->table."','".$socket->objet->toJson()."',CURRENT_TIMESTAMP)";
		}else{
			$requete = "INSERT INTO ".self::$tableName." VALUES ('".$socket->id."','".$socket->destinataire."','".$socket->action."','".$socket->table."','".$socket->objet->toJson()."',CURRENT_TIMESTAMP)";
		}
		
		//echo $requete;
		if($db != null and $db == 'tablette'){
			$query = CentraleMajController::dbTablette()->prepare($requete);
		}else{
			$query = db()->prepare($requete);
		}
		$query->execute();
	}
	
	static public function delete($socket,$db=null){
		$requete = "DELETE FROM ".self::$tableName." WHERE id='".$socket->id."'";
		//echo $requete;
		if($db != null and $db == 'tablette'){
			$query = CentraleMajController::dbTablette()->prepare($requete);
		}else{
			$query = db()->prepare($requete);
		}
		$query->execute();
	}
}
?>
