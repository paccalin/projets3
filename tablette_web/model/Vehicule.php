<?php
class Vehicule  extends Model{
	
    public function __construct($pModele = null, $pClient = null, $pImmatriculation = null, $pDateInsertion = null, $pId=null){
		/* constructeur vide utilisé par les sockets */
        if($pId == null){
				$this->id = Model::RandomId();
		}
		else{
				$this->id = $pId;
		}
        $this->modele = $pModele;
		$this->client = $pClient;
		$this->immatriculation = $pImmatriculation;
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

	static public function FindByImmatriculation($immat){
		$query = db()->prepare("SELECT id FROM ".self::$tableName." WHERE immatriculation = ?");
        $query->bindParam(1, $immat, PDO::PARAM_STR);
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
	
	static public function insert($vehicule){
		$requete="INSERT INTO ".self::$tableName." VALUES ('".$vehicule->id."','".$vehicule->modele->id."','".$vehicule->client->id."','".$vehicule->immatriculation."',CURRENT_TIMESTAMP)";
		//echo $requete;
		$query = db()->prepare($requete);
		$query->execute();
	}
	
	static public function update($vehicule){
		/* Fonction non testée */
		$requete="UPDATE ".self::$tableName."SET modele_id='".$vehicule->modele->id."', client_id='".$vehicule->client->id."',immatriculation='".$vehicule->immatriculation.",date_insertion='".$vehicule->dateInsertion."'";
		//echo $requete;
		$query = db()->prepare($requete);
		$query->execute();
	}
	
	static public function delete($vehicule){
		$query = db()->prepare("DELETE FROM ".self::$tableName." WHERE id='".$vehicule->id."'");
		$query->execute();
	}

    static public function SearchByTxt($pTxt){
        $preQuery = "";
        $returnList = array();

        $preQuery .= "SELECT DISTINCT vehi.id FROM ".self::$tableName." ";
        $preQuery .= "vehi JOIN ".Modele::$tableName." mo ON vehi.modele_id = mo.id ";
        $preQuery .= "JOIN ".TypeModele::$tableName." tmo ON mo.typemodele_id = tmo.id ";
        $preQuery .= "JOIN join_vehicule_option jvo ON vehi.id = jvo.vehicule_id ";
        $preQuery .= "JOIN ".Option::$tableName." opt ON jvo.option_id = opt.id ";

        $preQuery .= "WHERE lower(tmo.libelle) like lower(\"%".$pTxt."%\") ";
        $preQuery .= "OR lower(concat(opt.libelle, ' ', opt.description) like lower(\"%".$pTxt."%\"))";

        $query = db()->prepare($preQuery);
        $query->execute();
        if ($query->rowCount() > 0){
            $results = $query->fetchAll();
            foreach ($results as $row) {
                array_push($returnList, self::FindById($row["id"]));
            }
        }
        return $returnList;

    }

    static public function AdvancedSearch($pConstructeur, $pModele, $pOptionTypes){
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
