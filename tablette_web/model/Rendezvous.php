<?php
class Rendezvous extends Model{	
	
    public function __construct($pLibelle = null, $pClient = null, $pUtilisateur = null, $pDate = null, $pDuree = null, $pDateInsertion = null, $pId=null){
		/* constructeur vide utilisé par les sockets */
        $this->id = $pId;
        $this->libelle = $pLibelle;
        $this->client = $pClient;
        $this->utilisateur = $pUtilisateur;
        $this->date = $pDate;
        $this->duree = $pDuree;
        if($pDateInsertion == null)
            $this->dateInsertion = date('d/m/Y h:i:s a', time());
        else
            $this->dateInsertion = $pDateInsertion;
    }

    static public $tableName = "rendezvous";
    protected $id;
    protected $libelle;
    protected $utilisateur;
    protected $client;
    protected $date;
    protected $duree;
    protected $dateInsertion;

    static public function FindByID($pId) {
        $query = db()->prepare("SELECT * FROM ".self::$tableName." WHERE id = ?");
        $query->bindParam(1, $pId, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $id = $row['id'];
            $libelle = $row['libelle'];
            $client = Client::FindById($row['client_id']);
            $utilisateur = Utilisateur::FindById($row['utilisateur_id']);
            $date = $row['date'];
            $duree = $row['duree'];
            $dateInsertion = $row['date_insertion']; 
            return new Rendezvous($libelle, $client, $utilisateur, $date, $duree, $dateInsertion, $id);
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
	
	static public function FindByUtilisateurID($utilisateurID){
		$query = db()->prepare("SELECT id FROM ".self::$tableName." WHERE utilisateur_id=".$utilisateurID);
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
	
	static public function insert($rendezvous){
		$query = db()->prepare("INSERT INTO ".self::$tableName." VALUES (DEFAULT,'".$rendezvous->libelle."',".$rendezvous->utilisateur_id.",".$rendezvous->date.",CURRENT_TIMESTAMP)");
		$query->execute();
		$rendezvous->id = db()->lastInsertId();
		Socket::store('insert',self::$tableName,$rendezvous);
	}

	static public function delete($rendezvous){
		$query = db()->prepare("DELETE FROM ".self::$tableName." WHERE id=".$rendezvous->id);
		$query->execute();
		Socket::store('delete',self::$tableName,$rendezvous);
	}

	static public function DbDateToFrDate($date){
		$date=explode(' ',$date);
		$date=explode('-',$date[0]);
		$months=['January','February','March','April','May','June','July','August','September','October','November','December'];
		$mois=['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'];
		$jours=['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'];
		$linuxTime=strtotime($date[2]." ".$months[$date[1]-1]." ".$date[0]);
		$dateString = $jours[date('N',$linuxTime)-1]." ".$date[2]." ".$mois[$date[1]-1]." ".$date[0];
		return $dateString;
	}

	static public function DbDateToLinuxTime($date){
		$date=explode(' ',$date);
		$date=explode('-',$date[0]);
		$months=['January','February','March','April','May','June','July','August','September','October','November','December'];
		$linuxTime=strtotime($date[2]." ".$months[$date[1]-1]." ".$date[0]);
		return $linuxTime;
	}
}
?>
