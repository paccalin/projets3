<?php
class Devis extends Model{
    public function __construct($pClient, $pUtilisateur, $pPath, $pActif, $pDateInsertion,$pId=null){
        $this->id = $pId;
        $this->client = $pClient;
        $this->utilisateur = $pUtilisateur;
        $this->path = $pPath;
        $this->actif = $pActif;
        if($pDateInsertion == null)
            $this->dateInsertion = date('d/m/Y h:i:s a', time());
        else
            $this->dateInsertion = $pDateInsertion;
    }

    static public $tableName = "devis";
    protected $id;
    protected $client;
    protected $utilisateur;
    protected $path;
    protected $actif;
    protected $dateInsertion;

    static public function FindByID($pId){
        $query = db()->prepare("SELECT * FROM ? WHERE devis_id = ?");
        $query->bindParam(1, self::$tableName, PDO::PARAM_STR);
        $query->bindParam(2, $pId, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $id = $row['devis_id'];
            $client = Client::FindById($row['client_id']);
            $utilisateur = Utilisateur::FindById($row['utilisateur_id']);
            $path = $row['devis_path'];
            $actif = $row['devis_actif'];
            $dateInsertion = $row['devis_date_insertion'];       
            return new Devis($client, $utilisateur, $path, $actif, $dateInsertion, $id);
        }
        return null;
    }


    public function FindAll() {
        $query = db()->prepare("SELECT devis_id FROM ?");
        $query->bindParam(1, self::$tableName, PDO::PARAM_STR);
        $query->execute();
        $returnList = array();
        if ($query->rowCount() > 0){
            $results = $query->fetchAll();
            foreach ($results as $row) {
                array_push($returnList, self::FindById($row["devis_id"]));
            }
        }
        return $returnList;
    }
}

?>