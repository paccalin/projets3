<?php
class Constructeur extends Model{
    public function __construct($pId=null){
        $query = db()->prepare("SELECT * FROM constructeur WHERE contructeur_id = ?");
        $query->bindParam(1, $pId, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $this->contructeur_id = $row['contructeur_id'];
            $this->contructeur_libelle = $row['contructeur_libelle'];
            $this->constructeur_date_insertion = $row['constructeur_date_insertion'];
        }
    }
    
    protected contructeur_id;
    protected contructeur_libelle;
    protected constructeur_date_insertion;

    public function GetAll() {
        $query = db()->prepare("SELECT contructeur_id FROM constructeur");
        $query->execute();
        $returnList = array();
        if ($query->rowCount() > 0){
            $results = $query->fetchAll();
            foreach ($results as $row) {
                array_push($returnList, new Constructeur($row["contructeur_id"]));
            }
        }
        return $returnList;
    }
}
?>