<?php
class Photo extends Model{
    public function __construct($pId=null){
        $query = db()->prepare("SELECT * FROM photo WHERE photo_id = ?");
        $query->bindParam(1, $pId, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $this->photo_id = $row['photo_id'];
            $this->photo_path = $row['photo_path'];
            $this->vehicule = new Vehicle($row['vehicule_id']);
            $this->photo_date_insertion = $row['photo_date_insertion'];       
        }
    }

    protected photo_id;
    protected photo_path;
    protected vehicule;
    protected photo_date_insertion;

    public function GetAll() {
        $query = db()->prepare("SELECT photo_id FROM photo");
        $query->execute();
        $returnList = array();
        if ($query->rowCount() > 0){
            $results = $query->fetchAll();
            foreach ($results as $row) {
                array_push($returnList, new Photo($row["photo_id"]));
            }
        }
        return $returnList;
    }
}
?>