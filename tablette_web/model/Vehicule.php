<?php
class Vehicule  extends Model{
	
    public function __construct($pModele = null, $pClient = null, $pImmatriculation = null, $pDateInsertion = null, $pId=null){
		/* constructeur vide utilisé par les sockets */
        if($pId == null){
				$this->id = uniqid();
		}
		else{
				$this->id = $pId;
		}
        $this->modele = $pModele;
		$this->client = $pClient;
		$this->immatriculation = $pImmatriculation;
        $this->optionList = Option::FindByVehicule($this->id);
        if($pDateInsertion == null)
            $this->dateInsertion = date('d/m/Y h:i:s a', time());
        else
            $this->dateInsertion = $pDateInsertion;
    }

    static public $tableName = "vehicule";
    protected $id;
    protected $modele;
	protected $client;
	protected $immatriculation;
    protected $optionList;
    protected $dateInsertion;

    static public function FindByID($pId) {
        $query = db()->prepare("SELECT * FROM ".self::$tableName." WHERE id = ?");
        $query->bindParam(1, $pId, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $id = $row['id'];
            $modele = Modele::FindById($row['modele_id']);
            $client = Client::FindById($row['client_id']);
			$immatriculation = $row['immatriculation'];
            $dateIsertion = $row['date_insertion'];
            return new Vehicule($modele, $client, $immatriculation,$dateIsertion, $id);
        }
        return null;
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

	static public function FindByProprietaireID($client_id){
		$query = db()->prepare("SELECT id FROM ".self::$tableName." WHERE client_id = ?");
        $query->bindParam(1, $client_id, PDO::PARAM_INT);
        $query->execute();
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

    static public function AdvancedSearch($pGlobalTxt, $pConstructeur, $pModele, $pOptionTypes){
        $preQuery = "";
        $preWhere = "";
        $whereIterator = 0;

        $preQuery .= "SELECT DISTINCT vehi.id FROM ".self::$tableName . " vehi ";

        if($pModele != null){
            if($whereIterator == 0)
                $preWhere .= "WHERE ";
            else
                $preWhere .= "AND ";

            $preWhere .= '(vehi.modele_id =\''.$pModele->id.'\') ';
            $whereIterator++;
        }
        else
            if($pConstructeur != null){
                $preQuery .= 'JOIN '.Modele::$tableName.' mo ON (vehi.modele_id=mo.id) ';

                if($whereIterator == 0)
                    $preWhere .= "WHERE ";
                else
                    $preWhere .= "AND ";

                $preWhere .= '(mo.constructeur_id =\''.$pConstructeur->id.'\') ';
                $whereIterator++;
            }

        if(count($pOptionTypes) != 0){

            if($whereIterator == 0)
                    $preWhere .= "WHERE ";
                else
                    $preWhere .= "AND ";

            $preWhere .= '(';

            $preQuery .= 'JOIN join_vehicule_option jvo ON (jvo.vehicule_id = vehi.id) ';
            $preQuery .= 'JOIN '.Option::$tableName.' opt ON (opt.id = jvo.option_id) ';

            $iterator = 0;
            foreach ($pOptionTypes as $aType) {
                if($iterator != 0)
                    $preWhere .= 'OR ';

                $preWhere .= 'opt.typeoption_id=\''.$aType->id.'\' ';
                $iterator++;
            }
            $preWhere .= ') ';
            $whereIterator++;
        }

        $preQuery .= $preWhere . ';';

        $query = db()->prepare($preQuery);
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
}
?>
