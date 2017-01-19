<?php
class Socket extends Model{
    public function __construct($pAction, $pTable, $pObjet, $pDateInsertion = null, $pId=null){
        $this->id = $pId;
		$this->action = $pAction;
		$this->table = $pTable;
        $this->objet = $pObjet;
        if($pDateInsertion == null)
            $this->dateInsertion = date('d/m/Y h:i:s a', time());
        else
            $this->dateInsertion = $pDateInsertion;
    }

    static public $tableName = "socket";
    protected $id;
	protected $action;
	protected $table;
    protected $objet;
    protected $dateInsertion;
	
	static public function FindById($pId) {
        $query = db()->prepare("SELECT * FROM ".self::$tableName." WHERE id = ?");
        $query->bindParam(1, $pId, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
			$objetJson = json_decode($row['json']);
            $id = $row['id'];
            $action = $row['action'];
            $table = ucfirst($row['tableDb']);
            $objet = new $table();
			foreach (get_object_vars($objetJson) as $nomAttr=>$valeurAttr){
				$nomAttrMaj=ucfirst($nomAttr);
				/*
				
				But: instancier un atribut quand c'est une classe (ex Client de la classe Devis)
				
				Problème: PHP dit que aucun n'est une classe et en faisant la liste de toutes les classes on voit quand même nos
				nouvelles classe
				
				Edit: class_exists($classe,false); -> Tout le temps faux
				      class_exists($classe,true); -> vrai quand la classe existe casse le code sinon (avec l'autoload qui trouve pas la classe)
				
				"Solution": lister les classes dans un array
				*/
				$classes=['Client','Constructeur','Devis','Model','Modele','Option','Photo','Rendezvous','Socket','Utilisateur','Vehicule'];
				if(in_array($nomAttrMaj,$classes)){
					$objet->$nomAttr=$nomAttrMaj::FindById($valeurAttr);
				}else{
					$objet->$nomAttr=$valeurAttr;
				}
				/*
				if(class_exists($nomAttrMaj,false)){
					$objet->$nomAttr=$nomAttrMaj::FindById($valeurAttr);
					echo"<script>console.log('".$nomAttrMaj." est une classe');</script>";
				}else{
					echo"<script>console.log('".$nomAttrMaj." n\'est pas une classe');</script>";
					$objet->$nomAttr=$valeurAttr;	
				}
				*/
				/*foreach(get_declared_classes() as $class){
					echo"<script>console.log('".$class."');</script>";
				}*/
			}
            $dateInsertion = $row['date_insertion'];
            return new Socket($action, $table, $objet, $dateInsertion, $id);
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
	
	static public function store($action,$table,$objet){
		$socket = new Socket($action,$table,$objet);
		Socket::insert($socket);
	}
	
	static public function read($socket){
		/* Effectuer le tratement */
		
		//Socket::delete($socket);
	}
	
	static public function toRequete($socket){
		
	}
	
	static public function insert($socket){
		//Socket::read($socket);
		$requete = "INSERT INTO ".self::$tableName." VALUES (DEFAULT,'".$socket->action."','".$socket->table."','".$socket->objet->toJson()."',CURRENT_TIMESTAMP)";
		//echo $requete;
		$query = db()->prepare($requete);
		$query->execute();
	}
	
	static public function delete($socket){
		$query = db()->prepare("DELETE FROM ".self::$tableName." WHERE id=".$socket->id);
		$query->execute();
		echo $requete;
	}
}
?>