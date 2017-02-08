<?php

class Client extends Model{
	public function __construct($pNom = null, $pPrenom = null, $pRue = null, $pVille = null, $pCp = null, $pMail = null, $pTel = null, $pDateInsertion = null, $pId=null){
		/* constructeur vide utilisé par les sockets */
        $this->id = $pId;
        $this->nom = $pNom;
        $this->prenom = $pPrenom;
        $this->rue = $pRue;
        $this->ville = $pVille;
        $this->cp = $pCp;
        $this->mail = $pMail;
        $this->tel = $pTel;
        if($pDateInsertion == null)
            $this->dateInsertion = date('d/m/Y h:i:s a', time());
        else
            $this->dateInsertion = $pDateInsertion;
    }

    static public $tableName = "client";
    protected $id;
    protected $nom;
    protected $prenom;
    protected $rue;
    protected $ville;
    protected $cp;
    protected $mail;
    protected $tel;
    protected $dateInsertion;

    static public function FindByID($pId) {
        $query = db()->prepare("SELECT * FROM ".self::$tableName." WHERE id = ?");
        $query->bindParam(1, $pId, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $id = $row['id'];
            $nom = $row['nom'];
            $prenom = $row['prenom'];
            $rue = $row['rue'];
            $ville = $row['ville'];
            $cp = $row['cp'];
            $mail = $row['mail'];
            $tel = $row['tel'];
            $dateInsertion = $row['date_insertion'];  
            return new Client($nom, $prenom, $rue, $ville, $cp, $mail, $tel, $dateInsertion, $id);
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

	static public function FindByString($st){
		$query = db()->prepare("SELECT id FROM ".self::$tableName." WHERE UCASE(nom) LIKE UCASE('%".$st."%') OR UCASE(prenom) LIKE UCASE('%".$st."%') OR UCASE(rue) LIKE UCASE('%".$st."%') OR UCASE(ville) LIKE UCASE('%".$st."%') OR UCASE(mail) LIKE UCASE('%".$st."%') OR UCASE(tel) LIKE UCASE('%".$st."%')  OR cp='".$st."'");
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

	static public function insert($client){
		$requete = "INSERT INTO ".self::$tableName." VALUES (DEFAULT,'".$client->nom."','".$client->prenom."','".$client->rue."','".$client->ville."','".$client->cp."','".$client->mail."','".$client->tel."',CURRENT_TIMESTAMP)";		
		$query = db()->prepare($requete);
		$query->execute();
		$client->id = db()->lastInsertId();
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
	}
}

?>
