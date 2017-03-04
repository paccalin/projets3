<?php

class Tablette extends Model{
	public function __construct($pNom = null, $pIp= null, $pLastConnect = null, $pDateInsertion = null, $pId = null){
		/* constructeur vide utilisé par les sockets */
        if($pId==null){
			$this->id = Model::randomId();
        }else{
			$this->id = $pId;
		}
		$this->nom = $pNom;
        $this->ip = $pIp;
		if($pLastConnect == null){
			$this->lastConnect = '0000-00-00 00:00:00';
		}else{
			$this->lastConnect = $pDateInsertion;
		}
        $this->lastConnect = $pLastConnect;
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
    protected $tel;
    protected $dateInsertion;

    static public function FindByID($pId) {
        $query = db()->prepare("SELECT * FROM ".self::$tableName." WHERE id = '".$pId."'");
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $id = $row['id'];
			$nom = $row['nom'];
            $ip = $row['ip'];
            $lastConnect = $row['last_connect'];
            $dateInsertion = $row['date_insertion'];  
            return new Tablette($nom, $ip, $lastConnect, $dateInsertion, $id);
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
	/*
	static public function insert($client){
		$requete = "INSERT INTO ".self::$tableName." VALUES ('".$client->id."','".$client->nom."','".$client->prenom."','".$client->rue."','".$client->ville."','".$client->cp."','".$client->mail."','".$client->tel."',CURRENT_TIMESTAMP)";		
		//echo $requete;
		$query = db()->prepare($requete);
		$query->execute();
	}

	static public function update($client){
		$requete="UPDATE ".self::$tableName." SET nom='".$client->nom."', prenom='".$client->prenom."', rue='".$client->rue."', ville='".$client->ville."', cp='".$client->cp."', mail='".$client->mail."', tel='".$client->tel."' WHERE id='".$client->id."'";
		//echo $requete;
		$query = db()->prepare($requete);
		$query->execute();
	}

	static public function delete($client){
		$query = db()->prepare("DELETE FROM ".self::$tableName." WHERE id='".$client->id."'");
		$query->execute();
	}*/
}

?>
