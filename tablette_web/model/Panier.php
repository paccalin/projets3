<?php
	class Panier extends Model{
		
		public function __construct($pClient = null, $pUtilisateur, $pPath = null,$pDateInsertion = null,$pId = null){
			/* constructeur vide utilisé par les sockets */
			$this->id = $pId;
			$this->client = $pClient;
			$this->utilisateur = $pUtilisateur;
			$this->path = $pPath;
			if($pDateInsertion == null){
				$this->dateInsertion = date('d/m/Y h:i:s a', time());
			}else{
				$this->dateInsertion = $pDateInsertion;
			}
		}
		static public $tableName = "panier";
		protected $id;
		protected $client;
		protected $utilisateur;
		protected $path;
		protected $dateInsertion;
		
		static public function FindByID($pId){
        $query = db()->prepare("SELECT * FROM ".self::$tableName." WHERE id = ?");
        $query->bindParam(1, $pId, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $id = $row['id'];
            $client = Client::FindById($row['client_id']);
            $utilisateur = Utilisateur::FindById($row['utilisateur_id']);
            $path = $row['path'];
            $dateInsertion = $row['date_insertion'];       
            return new Panier($client, $utilisateur, $path, $dateInsertion, $id);
        }
        return null;
    }
		
		static public function FindAll(){
			$query = db()->prepare("SELECT id FROM ".self::$tableName);
			$query->execute();
			$returnList = [];
			if ($query->rowCount() > 0){
				$results = $query->fetchAll();
				foreach ($results as $row) {
					array_push($returnList, self::FindById($row["id"]));
				}
			}
			return $returnList;
		}
		
		static public function FindByClientId(){
			
		}
	}
?>