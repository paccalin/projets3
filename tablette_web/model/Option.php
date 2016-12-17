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

    static public $tableName = "options";
    protected $id;
    protected $libelle;
    protected $desc;
    protected $dateInsertion;

    static public function FindByID($pId) {
        $query = db()->prepare("SELECT * FROM ".self::$tableName." WHERE id = ?");
        $query->bindParam(1, $pId, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $id = $row['id'];
            $libelle = $row['libelle'];
            $desc = $row['desc'];
            $dateInsertion = $row['date_insertion'];  
            return new Option($libelle, $desc, $dateInsertion, $id);
        }
        return null;
    }

    static function FindByVehicule($pVehicleId){
        $query = db()->prepare("SELECT option_id FROM join_vehicule_option WHERE vehicule_id = ?");
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

    static public function FindAll() {
        $query = db()->prepare("SELECT id FROM ".self::$tableName);
        $query->execute();
        $returnList = array();
        if ($query->rowCount() > 0){
            $results = $query->fetchAll();
            foreach ($results as $row) {
                array_push($returnList, self::FindById($row["id"]));
            }
        }
        return $returnList;
    }

	static public function delete($option){
		$query = db()->prepare("DELETE FROM ".self::$tableName." WHERE id=".$option->id);
		$query->execute();
	}
}
?>
