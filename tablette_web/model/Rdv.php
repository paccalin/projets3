<?php
class Rdv extends Model{
    public function __construct($pLibelle, $pClient, $pUtilisateur, $pDate, $pDuree, $pDateInstertion = null, $pId=null){
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

    static public $tableName = "rdv";
    protected $id;
    protected $libelle;
    protected $utilisateur;
    protected $client;
    protected $date;
    protected $duree;
    protected $dateInsertion;

    static public function FindByID($pId) {
        $query = db()->prepare("SELECT * FROM ".self::$tableName." WHERE rdv_id = ?");
        $query->bindParam(1, $pId, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $id = $row['rdv_id'];
            $libelle = $row['rdv_libelle'];
            $client = Client::FindById($row['client']);
            $utilisateur = Utilisateur::FindById($row['utilisateur']);
            $date = $row['rdv_date'];
            $duree = $row['rdv_duree'];
            $dateInsertion = $row['rdv_date_insertion']; 
            return new Rdv($libelle, $client, $utilisateur, $date, $duree, $dateInsertion, $id);
        }
        return null;
    }

    static public function FindAll() {
        $query = db()->prepare("SELECT rdv_id FROM ".self::$tableName);
        $query->execute();
        $returnList = array();
        if ($query->rowCount() > 0){
            $results = $query->fetchAll();
            foreach ($results as $row) {
                array_push($returnList, self::FindById($row["rdv_id"]));
            }
        }
        return $returnList;
    }
}
?>