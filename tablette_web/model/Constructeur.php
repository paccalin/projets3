<?php
class Constructeur extends Model{
    public function __construct($pLibelle, $pDateInsertion = null, $pId=null){
        $this->id = $pId;
        $this->libelle = $pLibelle;
        if($pDateInsertion == null)
            $this->dateInsertion = date('d/m/Y h:i:s a', time());
        else
            $this->dateInsertion = $pDateInsertion;
    }
    
    static public $tableName = "constructeur";
    protected $id;
    protected $libelle;
    protected $dateInsertion;

    static public function FindByID($pId) {
        $query = db()->prepare("SELECT * FROM ".self::$tableName." WHERE constructeur_id = ?");
        $query->bindParam(1, $pId, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $id = $row['constructeur_id'];
            $libelle = $row['constructeur_libelle'];
            $dateInsertion = $row['constructeur_date_insertion'];
            return new Constructeur($libelle, $dateInsertion, $id);
        }
        return null;
    }


    static public function FindAll() {
        $query = db()->prepare("SELECT constructeur_id FROM ".self::$tableName);
        $query->execute();
        $returnList = array();
        echo $query->rowCount();
        if ($query->rowCount() > 0){
            $results = $query->fetchAll();
            foreach ($results as $row) {
                array_push($returnList, self::FindById($row["constructeur_id"]));
            }
        }
        return $returnList;
    }
}
?>