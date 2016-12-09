<?php
class Option extends Model{
    public function __construct($pLibelle, $pDesc, $pDateInsertion = null, $pId=null){
        $this->id = $pId;
        $this->libelle = $pLibelle;
        $this->desc = $pDesc;
        if($pDateInsertion == null)
            $this->dateInsertion = date('d/m/Y h:i:s a', time());
        else
            $this->dateInsertion = $pDateInsertion;
    }

    static public $tableName = "option";
    protected $id;
    protected $libelle;
    protected $desc;
    protected $dateInsertion;

    static public function FindByID($pId) {
        $query = db()->prepare("SELECT * FROM ? WHERE option_id = ?");
        $query->bindParam(1, self::$tableName, PDO::PARAM_STR);
        $query->bindParam(2, $pId, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $id = $row['option_id'];
            $libelle = $row['option_libelle'];
            $desc = $row['option_desc'];
            $dateInsertion = $row['option_date_insertion'];  
            return new Option($libelle, $desc, $dateInsertion, $id);
        }
        return null;
    }

    static function FindByVehicle($pVehicleId){
        $query = db()->prepare("SELECT option_id FROM join_vehicule_option WHERE vehicle_id = ?");
        $query->bindParam(1, $pVehicleId, PDO::PARAM_INT);
        $query->execute();
        $returnList = array();
        if ($query->rowCount() > 0){
            $results = $query->fetchAll();
            foreach ($results as $row) {
                array_push($returnList, self::FindById($row["option_id"]));
            }
        }
        return $returnList;
    }

    public function FindAll() {
        $query = db()->prepare("SELECT option_id FROM ?");
        $query->bindParam(1, self::$tableName, PDO::PARAM_STR);
        $query->execute();
        $returnList = array();
        if ($query->rowCount() > 0){
            $results = $query->fetchAll();
            foreach ($results as $row) {
                array_push($returnList, self::FindById($row["option_id"]));
            }
        }
        return $returnList;
    }
}
?>