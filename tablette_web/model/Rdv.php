<?php
class Rdv extends Model{
    public function __construct($pId=null){
        $query = db()->prepare("SELECT * FROM rdv WHERE photo_id = ?");
        $query->bindParam(1, $pId, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $this->rdv_id = $row['rdv_id'];
            $this->rdv_libelle = $row['rdv_libelle'];
            $this->client = new Client($row['client']);
            $this->utilisateur = new Utilisateur($row['utilisateur']);
            $this->rdv_date = $row['rdv_date'];
            $this->rdv_duree = $row['rdv_duree'];
        }
    }

    protected rdv_id;
    protected rdv_libelle;
    protected utilisateur;
    protected client;
    protected rdv_date;
    protected rdv_duree;

    public function GetAll() {
        $query = db()->prepare("SELECT rdv_id FROM rdv");
        $query->execute();
        $returnList = array();
        if ($query->rowCount() > 0){
            $results = $query->fetchAll();
            foreach ($results as $row) {
                array_push($returnList, new Rdv($row["rdv_id"]));
            }
        }
        return $returnList;
    }
}
?>