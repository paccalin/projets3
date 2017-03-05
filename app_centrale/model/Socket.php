<?php
class Socket extends Model{
    public function __construct($pDestinataire, $pAction, $pTable, $pObjet, $pDateInsertion = null, $pId=null){
        if($pId==null){
			$this->id = Model::randomId();
        }else{
			$this->id = $pId;
		}
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
			$objetJson = json_decode($row['json']);
			//print_r($objetJson);
            $id = $row['id'];
			$destinataire = $row['destinataire'];
            $action = $row['action'];
            $table = ucfirst($row['tableDb']);
            $objet = new $table();
			foreach (get_object_vars($objetJson) as $nomAttr=>$valeurAttr){
				$nomAttrMaj=ucfirst($nomAttr);
				$classes=['Client','Constructeur','Devis','Model','Modele','Option','Photo','Rendezvous','Socket','Utilisateur','Vehicule','TypeOption'];
				//echo $nomAttr." => ".$valeurAttr."<br/>";	/* DEBUG */
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
	
	static public function read($socket){
		//print_r($socket->objet); 	/* DEBUG */
		//echo '<br/>';				/* DEBUG */
		$table=$socket->table;
		$action=$socket->action;
		$table::$action($socket->objet);
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
			//Socket::insert($socket,'centrale','tablette');
			//Socket::delete($socket,'tablette');
		}
		foreach($sockets as $socket){
			echo '<br/>';
			//print_r($socket);
/* ============================================================================= */
			/* Faire qu'ils soient lus par vagues avec un ordre précis */
/*
	1. Instancier les nouveaux objets Socket avec objet=null
	2. Boucle:
		-instancier les sockets avec objets sans dépendance (ou avec la dépendance déjà créée) -> voir schéma
		-read le cocket
*/
			//Socket::read($socket);
		}
		$s=['b','c'];
		unset($s[array_search('b',$s)]);
		print_r($s);
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
