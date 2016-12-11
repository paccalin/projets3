<?php
class Photo extends Model{
    public function __construct($pPath, $pVehicule, $pDateInsertion = null, $pId=null){
        $this->id = $pId;
        $this->path = $pPath;
        $this->vehicule = $pVehicule;
        if($pDateInsertion == null)
            $this->dateInsertion = date('d/m/Y h:i:s a', time());
        else
            $this->dateInsertion = $pDateInsertion;
    }

    static public $tableName = "photo";
    protected $id;
    protected $path;
    protected $vehicule;
    protected $dateInsertion;

    static public function FindByID($pId) {
        $query = db()->prepare("SELECT * FROM ".self::$tableName." WHERE photo_id = ?");
        $query->bindParam(1, $pId, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $id = $row['photo_id'];
            $path = $row['photo_path'];
            $vehicule = Vehicule::FindById($row['vehicule_id']);
            $dateInsertion = $row['photo_date_insertion'];
            return new Photo($path, $vehicule, $dateInsertion, $id);
        }
        return null;
    }
        

    static public function FindAll() {
        $query = db()->prepare("SELECT photo_id FROM ".self::$tableName);
        $query->execute();
        $returnList = array();
        if ($query->rowCount() > 0){
            $results = $query->fetchAll();
            foreach ($results as $row) {
                array_push($returnList, self::FindById($row["photo_id"]));
            }
        }
        return $returnList;
    }
}
?>