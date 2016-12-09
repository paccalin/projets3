<?php

class Client extends Model{
	public function __construct($pNom, $pPrenom, $pRue, $pVille, $pCp, $pMail, $pTel, $pDateInsertion = null, $pId=null){
        $this->id = $p;
        $this->nom = $p;
        $this->prenom = $p;
        $this->rue = $p;
        $this->ville = $p;
        $this->cp = $p;
        $this->mail = $p;
        $this->tel = $p;
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
        $query = db()->prepare("SELECT * FROM ".self::$tableName." WHERE client_id = ?");
        $query->bindParam(1, $pId, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $id = $row['client_id'];
            $nom = $row['client_nom'];
            $prenom = $row['client_prenom'];
            $rue = $row['client_rue'];
            $ville = $row['client_ville'];
            $cp = $row['client_cp'];
            $mail = $row['client_mail'];
            $tel = $row['client_tel'];
            $dateInsertion = $row['modele_date_insertion'];  
            return new Modele($nom, $prenom, $rue, $ville, $cp, $mail, $tel, $dateInsertion, $id);
        }
        else 
            return null;
    }

    static public function FindAll() {
        $query = db()->prepare("SELECT client_id FROM ". self::$tableName);
        $query->execute();
        $returnList = array();
        if ($query->rowCount() > 0){
            $results = $query->fetchAll();
            foreach ($results as $row) {
                array_push($returnList, new Client($row["client_id"]));
            }
        }
        return $returnList;
    }
}

?>