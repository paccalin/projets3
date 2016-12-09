<?php
class Vehicule  extends Model{
    public function __construct($pId=null){
        $query = db()->prepare("SELECT * FROM vehicule WHERE vehicule_id = ?");
        $query->bindParam(1, $pId, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $this->vehicule_id = $row['vehicule_id'];
            $this->modele = new Modele($row['modele_id']);
            $this->vehicule_date_insertion = $row['vehicule_date_insertion'];
        }
    }

    protected vehicule_id;
    protected modele;
    protected vehicule_date_insertion;

    public function GetAll() {
        $query = db()->prepare("SELECT vehicule_id FROM vehicule");
        $query->execute();
        $returnList = array();
        if ($query->rowCount() > 0){
            $results = $query->fetchAll();
            foreach ($results as $row) {
                array_push($returnList, new Vehicule($row["vehicule_id"]));
            }
        }
        return $returnList;
    }
}
?>