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
		
		static public function FindByClientId($clientId){
			$requete="SELECT id FROM ".self::$tableName." WHERE client_id=".$clientId;
			//echo $requete;
			$query = db()->prepare($requete);
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
		
		static public function FindJoinOptionsByClientId($clientId){
			$requete="select * from join_panier_option where panier_id=(select id from panier where client_id=".$clientId.")";
			//echo $requete;
			$query = db()->prepare($requete);
			$query->execute();
			$returnList=[];
			if ($query->rowCount() > 0){
				$results = $query->fetchAll();
				foreach ($results as $row) {
					array_push($returnList, ["option"=>Option::FindById($row["option_id"])]);
				}
			}
			return $returnList;
		}
		
		static public function ajouterOption($optionId){
			$panier=Self::FindByClientId($_SESSION['client'])[0];
			$requete = "INSERT INTO join_panier_option VALUES (DEFAULT,'".$optionId."','".$panier->id."',CURRENT_TIMESTAMP)";		
			$query = db()->prepare($requete);
			$query->execute();
		}
	}
?>