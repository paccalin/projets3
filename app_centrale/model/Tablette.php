<?php

class Tablette extends Model{
	public function __construct($pIp= null, $pNom = null, $pLastConnect = null, $pDateInsertion = null, $pId = null){
		/* constructeur vide utilisé par les sockets */
        if($pId==null){
			$this->id = Model::randomId();
        }else{
			$this->id = $pId;
		}
		if($pNom==null){
			$this->nom = 'tablette sans nom';
        }else{
			$this->nom = $pNom;
		}
        $this->ip = $pIp;
		if($pLastConnect == null){
			$this->lastConnect = '0000-00-00 00:00:00';
		}else{
			$this->lastConnect = $pLastConnect;
		}
        if($pDateInsertion == null)
            $this->dateInsertion = date('d/m/Y h:i:s a', time());
        else
            $this->dateInsertion = $pDateInsertion;
    }

    static public $tableName = "tablette";
    protected $id;
    protected $nom;
    protected $ip;
    protected $lastConnect;
    protected $dateInsertion;

    static public function FindById($pId) {
        $query = db()->prepare("SELECT * FROM ".self::$tableName." WHERE id = '".$pId."'");
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $id = $row['id'];
			$nom = $row['nom'];
            $ip = $row['ip'];
            $lastConnect = $row['last_connect'];
            $dateInsertion = $row['date_insertion'];  
            return new Tablette($ip, $nom, $lastConnect, $dateInsertion, $id);
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

	static public function FindByIp($pIp) {
		$requete = "SELECT id FROM ".self::$tableName." where ip='".$pIp."'";
		//echo $requete;
        $query = db()->prepare($requete);
        $query->execute();
        if ($query->rowCount() > 0){
			$row = $query->fetch(PDO::FETCH_ASSOC);
            return self::FindById($row['id']);
        }else{
			return null;
		}
    }

	static public function insert($tablette){
		$requete = "INSERT INTO ".self::$tableName." VALUES ('".$tablette->id."', '".$tablette->nom."', '".$tablette->ip."', '".$tablette->lastConnect."', CURRENT_TIMESTAMP)";		
		//echo $requete;
		$query = db()->prepare($requete);
		$query->execute();
	}

	static public function updateLastConnect($tablette){
		$tablette->lastConnect = 'CURRENT_TIMSTAMP';
		$requete="UPDATE ".self::$tableName." SET last_connect= CURRENT_TIMESTAMP WHERE id='".$tablette->id."'";
		//echo $requete;
		$query = db()->prepare($requete);
		$query->execute();
		//$tablette->lastConnect=date('Y-m-d H:i:s', time()-10*60*60);//correspond au temps actuel de la DB (on enlève 10h par rapport au PHP time)
	}

	static public function update($tablette){
		$requete="UPDATE ".self::$tableName." SET nom='".$tablette->nom."', ip='".$tablette->ip."', last_connect='".$tablette->lastConnect."' WHERE id='".$tablette->id."'";
		//echo $requete;
		$query = db()->prepare($requete);
		$query->execute();
	}
	/*
	static public function delete($client){
		$query = db()->prepare("DELETE FROM ".self::$tableName." WHERE id='".$client->id."'");
		$query->execute();
	}
	*/
}

?>
