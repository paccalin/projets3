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
	
	static public function FindById($pId) {
        $query = db()->prepare("SELECT * FROM ".self::$tableName." WHERE id = '".$pId."'");
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
				$classes=['Client','Constructeur','Devis','Model','Modele','Option','Photo','Rendezvous','Socket','Utilisateur','Vehicule'];
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

	static public function FindAllOnTabFor($pDest = null) {
		if($pDest=='centrale' or $pDest=='tablette'){
       		$query = CentraleMajController::dbTablette()->prepare("SELECT id FROM ".self::$tableName." WHERE destinataire='".$pDest."'");
		}else{
			$query = CentraleMajController::dbTablette()->prepare("SELECT id FROM ".self::$tableName);
		}
        $query->execute();
        $returnList = array();
        if ($query->rowCount() > 0){
            $results = $query->fetchAll();
            foreach ($results as $row) {
                array_push($returnList, self::FindByIdOnTab($row["id"]));
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

	static public function TransfertT2C(){
		$requete = "select * from tablette where ip='".parameters()['ip']."'";
		//echo $requete.'<br/>';
		$query = db()->prepare($requete);
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
			$lastConnect=$row['last_connect'];
		}else{
			$requete = "insert into tablette values('".Model::randomId()."',DEFAULT,'".parameters()['ip']."',DEFAULT)";
			echo $requete.'<br/>';
			$query = db()->prepare($requete);
		    $query->execute();
			$lastConnect = '0000-00-00 00:00:00';
		}
		$requete = "select * from socket where destinataire='centrale' and date_insertion > '".$lastConnect."' ORDER BY date_insertion";
		echo $requete;
		$query = CentraleMajController::dbTablette()->prepare($requete);
		$query->execute();
		if ($query->rowCount() > 0){
            $results = $query->fetchAll();
            foreach ($results as $row) {
				$requete = "INSERT INTO ".self::$tableName." VALUES ('".$row['id']."','tablette','".$row['action']."','".$row['tableDb']."','".$row['json']."', CURRENT_TIMESTAMP)";
				//echo $requete;
				$query = db()->prepare($requete);
				$query->execute();
				$socket = Socket::findById($row['id']);
				Socket::read($socket);
            }
        }
		// Les sockets restent sur la tablette		
		/*
		$requete = "delete from socket where destinataire='centrale'";
		//echo $requete;
		$query = CentraleMajController::dbTablette()->prepare($requete);
		$query->execute();
		*/
	}

	static public function TransfertC2T(){
		$requete = "select * from tablette where ip='".parameters()['ip']."'";
		//echo $requete.'<br/>';
		$query = db()->prepare($requete);
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
			$lastConnect=$row['last_connect'];
		}else{
			$requete = "insert into tablette values('".Model::randomId()."',DEFAULT,'".parameters()['ip']."',DEFAULT)";
			echo $requete.'<br/>';
			$query = db()->prepare($requete);
		    $query->execute();
			$lastConnect = '0000-00-00 00:00:00';
		}
		$requete = "select * from socket where destinataire='tablette' and date_insertion > '".$lastConnect."'";
		echo $requete.'<br/>';
		$query = db()->prepare($requete);
		$query->execute();
		if ($query->rowCount() > 0){
            $results = $query->fetchAll();
            foreach ($results as $row) {
				$requete = "INSERT INTO ".self::$tableName." VALUES ('".$row['id']."','tablette','".$row['action']."','".$row['tableDb']."','".$row['json']."', CURRENT_TIMESTAMP)";
				echo $requete.'<br/>';
				$query = CentraleMajController::dbTablette()->prepare($requete);
				$query->execute();
			}
		}
		$requete = "update tablette set last_connect = CURRENT_TIMESTAMP where ip='".parameters()['ip']."'";
		echo $requete.'<br/>';
		$query = db()->prepare($requete);
        $query->execute();
	}
	
	static public function insert($socket){
		$requete = "INSERT INTO ".self::$tableName." VALUES ('".$socket->id."','".$socket->destinataire."','".$socket->action."','".$socket->table."','".$socket->objet->toJson()."',CURRENT_TIMESTAMP)";
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
