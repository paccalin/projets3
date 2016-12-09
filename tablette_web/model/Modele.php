<?php
class Modele extends Model{
    public function __construct($pLibelle, $pConstructeur, $pDateInsertion = null, $pModeleId = null){
        $this->id = $row['modele_id'];
        $this->libelle = $row['modele_libelle'];
        $this->constructeur = new Constructeur($row['constructeur_id']);
        if($pDateInsertion == null)
            $this->dateInsertion = date('d/m/Y h:i:s a', time());
        else
            $this->dateInsertion = $row['modele_date_insertion'];
    }
    
    static public $tableName = "modele";
    protected $id;
    protected $libelle;
    protected $constructeur;
    protected $dateInsertion;

    static public function FindByID($pId) {
        $query = db()->prepare("SELECT * FROM ".self::$tableName." WHERE modele_id = ?");
        $query->bindParam(1, $pId, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $id = $row['modele_id'];
            $libelle = $row['modele_libelle'];
            $constructeur = new Constructeur($row['constructeur_id']);
            $dateInsertion = $row['modele_date_insertion'];     
            return new Modele($libelle, $constructeur, $dateInsertion, $id)  
        }
        else 
            return null;
    }

    static public function FindAll() {
        $query = db()->prepare("SELECT modele_id ". self::$tableName);
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