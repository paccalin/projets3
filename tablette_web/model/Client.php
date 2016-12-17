<?php

class Client extends Model{
	public function __construct($pNom, $pPrenom, $pRue, $pVille, $pCp, $pMail, $pTel, $pDateInsertion = null, $pId=null){
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
                array_push($returnList, new self::FindById($row["id"]));
            }
        }
        return $returnList;
    }
}

?>
