<?php
class Vehicule  extends Model{
    public function __construct($pModele, $pDateInsertion = null, $pId=null){
        $this->id = $pId;
        $this->modele = $pModele;
        $this->optionList = Option::FindByVehicule($this->id);
        if($pDateInsertion == null)
            $this->dateInsertion = date('d/m/Y h:i:s a', time());
        else
            $this->dateInsertion = $pDateInsertion;
    }

    static public $tableName = "vehicule";
    protected $vehicule_id;
    protected $modele;
    protected $optionList;
    protected $dateInsertion;

    static public function FindByID($pId) {
        $query = db()->prepare("SELECT * FROM ".self::$tableName." WHERE id = ?");
        $query->bindParam(1, $pId, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $id = $row['vehicule_id'];
            $modele = Modele::FindById($row['modele_id']);
            $dateIsertion = $row['date_insertion'];
            return new Vehicule($modele, $dateIsertion, $id);
        }
        return null;
    }

    static public function FindAll() {
        $query = db()->prepare("SELECT id FROM ".self::$tableName);
        $query->bindParam(1, self::$tableName, PDO::PARAM_STR);
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

	static public function delete($vehicule){
		$query = db()->prepare("DELETE FROM ".self::$tableName." WHERE id=".$vehicule->id);
		$query->execute();
	}
}
?>
