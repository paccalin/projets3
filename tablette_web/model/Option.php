<?php
class Options extends Model{
    public function __construct($pId=null){
        $query = db()->prepare("SELECT * FROM options WHERE option_id = ?");
        $query->bindParam(1, $pId, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $this->option_id = $row['option_id'];
            $this->option_libelle = $row['option_libelle'];
            $this->option_desc = $row['option_desc'];
            $this->option_date_insertion = $row['option_date_insertion'];       
        }
    }

    protected option_id;
    protected option_libelle;
    protected option_desc;
    protected option_date_insertion;

    public function GetAll() {
        $query = db()->prepare("SELECT option_id FROM option");
        $query->execute();
        $returnList = array();
        if ($query->rowCount() > 0){
            $results = $query->fetchAll();
            foreach ($results as $row) {
                array_push($returnList, new Option($row["option_id"]));
            }
        }
        return $returnList;
    }
}
?>