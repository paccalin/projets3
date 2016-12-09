<?php
class Utilisateur extends Model{
    public function __construct($pId=null){
        $query = db()->prepare("SELECT * FROM utilisateur WHERE utilisateur_id = ?");
        $query->bindParam(1, $pId, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $this->utilisateur_id = $row['utilisateur_id'];
            $this->utilisateur_pseudo = $row['utilisateur_pseudo'];
            $this->utilisateur_motDePasse = $row['utilisateur_motDePasse'];
            $this->utilisateur_droits = $row['utilisateur_droits'];
        }
    }

    protected utilisateur_id;
    protected utilisateur_pseudo;
    protected utilisateur_motDePasse;
    protected utilisateur_droits;

    public function GetAll() {
        $query = db()->prepare("SELECT utilisateur_id FROM utilisateur");
        $query->execute();
        $returnList = array();
        if ($query->rowCount() > 0){
            $results = $query->fetchAll();
            foreach ($results as $row) {
                array_push($returnList, new Utilisateur($row["utilisateur_id"]));
            }
        }
        return $returnList;
    }
}
?>