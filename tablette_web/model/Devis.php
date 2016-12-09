<?php
class Devis extends Model{
    public function __construct($pId=null){
        $query = db()->prepare("SELECT * FROM devis WHERE devis_id = ?");
        $query->bindParam(1, $pId, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $this->devis_id = $row['devis_id'];
            $this->client = new Client($row['client_id']);
            $this->utilisateur = new Utilisateur($row['utilisateur_id']);
            $this->devis_path = $row['devis_path'];
            $this->devis_actif = $row['devis_actif'];            
        }
    }

    protected devis_id;
    protected client;
    protected utilisateur;
    protected devis_path;
    protected devis_actif;

    public function GetAll() {
        $query = db()->prepare("SELECT devis_id FROM devis");
        $query->execute();
        $returnList = array();
        if ($query->rowCount() > 0){
            $results = $query->fetchAll();
            foreach ($results as $row) {
                array_push($returnList, new Devis($row["devis_id"]));
            }
        }
        return $returnList;
    }
}

?>