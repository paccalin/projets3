<?php
class Client extends Model{
	public function __construct($pId=null){
        $query = db()->prepare("SELECT * FROM client WHERE client_id = ?");
        $query->bindParam(1, $pId, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $this->client_id = $row['client_id'];
            $this->client_nom = $row['client_nom'];
            $this->client_prenom = $row['client_prenom'];
            $this->client_rue = $row['client_rue'];
            $this->client_ville = $row['client_ville'];
            $this->client_cp = $row['client_cp'];
            $this->client_mail = $row['client_mail'];
            $this->client_tel = $row['client_tel'];
        }
    }

    protected client_id;
    protected client_nom;
    protected client_prenom;
    protected client_rue;
    protected client_ville;
    protected client_cp;
    protected client_mail;
    protected client_tel;

    public function GetAll() {
        $query = db()->prepare("SELECT client_id FROM client");
        $query->execute();
        $returnList = array();
        if ($query->rowCount() > 0){
            $results = $query->fetchAll();
            foreach ($results as $row) {
                array_push($returnList, new Client($row["client_id"]));
            }
        }
        return $returnList;
    }
}

?>