<?php
class Modele extends Model{
    public function __construct($pLibelle, $pConstructeur, $pDateInsertion = null, $pId = null){
        $this->id = $pId;
        $this->libelle = $pLibelle;
        $this->constructeur = $pConstructeur;
        if($pDateInsertion == null)
            $this->dateInsertion = date('d/m/Y h:i:s a', time());
        else
            $this->dateInsertion = $pDateInsertion;
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
            $constructeur = Constructeur::FindById($row['constructeur_id']);
            $dateInsertion = $row['modele_date_insertion'];     
            return new Modele($libelle, $constructeur, $dateInsertion, $id);
        }
        return null;
    }

    static public function FindAll() {
        $query = db()->prepare("SELECT modele_id FROM ".self::$tableName);
        $query->execute();
        $returnList = array();
        if ($query->rowCount() > 0){
            $results = $query->fetchAll();
            foreach ($results as $row) {
                array_push($returnList, self::FindById($row["modele_id"]));
            }
        }
        return $returnList;
    }
}
?>