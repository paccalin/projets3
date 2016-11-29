<?php
class Modele extends Model{
    public function __construct($pId=null){
        $query = db()->prepare("SELECT * FROM modele WHERE modele_id = ?");
        $query->bindParam(1, $pId, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $this->modele_id = $row['modele_id'];
            $this->modele_libelle = $row['modele_libelle'];
            $this->constructeur = new Constructeur($row['constructeur_id']);
            $this->modele_date_insertion = $row['modele_date_insertion'];       
        }
    }
    
    protected modele_id;
    protected modele_libelle;
    protected constructeur;
    protected modele_date_insertion;

    public function GetAll() {
        $query = db()->prepare("SELECT modele_id FROM modele");
        $query->execute();
        $returnList = array();
        if ($query->rowCount() > 0){
            $results = $query->fetchAll();
            foreach ($results as $row) {
                array_push($returnList, new Modele($row["modele_id"]));
            }
        }
        return $returnList;
    }
}
?>