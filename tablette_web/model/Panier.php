<?php
	class Panier extends Model{
		
		public function __construct($pClient = null, $pUtilisateur, $pPath = null,$pDateInsertion = null,$pId = null){
			/* constructeur vide utilisé par les sockets */
			$this->id = uniqid();
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
		
		static public function create($clientId){
			$requete="insert into ".self::$tableName." values(default,".$clientId.",".$_SESSION['utilisateur'].",'path',CURRENT_TIMESTAMP)";
			echo $requete;
			$query = db()->prepare($requete);
			$query->execute();
		}
		
		public function getNbOptions(){
			$requete="select count(*) as nb from join_panier_option where panier_id=".$this->id;
			//echo $requete;
			$query = db()->prepare($requete);
			$query->execute();
			$returnList=[];
			if ($query->rowCount() > 0){
				$row = $query->fetch(PDO::FETCH_ASSOC);
				return $row['nb'];
			}else{
				return -1;
			}
		}
		
		public function getCoutTotal(){
			/* marche pas -> faire une requête imbriquée ou un truc dans le genre */
			//trouver un moyen pour que ça fasse la somme avec nombre un attribut de join_panier_option
			$requete=" [...] where panier_id=".$this->id.")";
			//echo $requete;
			$query = db()->prepare($requete);
			$query->execute();
			$returnList=[];
			if ($query->rowCount() > 0){
				$row = $query->fetch(PDO::FETCH_ASSOC);
				return $row['somme'];
			}else{
				return -1;
			}
		}
		
		static public function FindByID($pId){
			$query = db()->prepare("SELECT * FROM ".self::$tableName." WHERE id ='".$pId."'");
			$query->execute();
			if ($query->rowCount() > 0){
				$row = $query->fetch(PDO::FETCH_ASSOC);
				$id = $row['id'];
				$client = Client::FindById($row['client_id']);
				$utilisateur = Utilisateur::FindById($row['utilisateur_id']);
				$path = $row['path'];
				$dateInsertion = $row['date_insertion'];       
				return new Panier($client, $utilisateur, $path, $dateInsertion, $id);
			}else{
				self::create($_SESSION['client']);
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
			$requete="SELECT id FROM ".self::$tableName." WHERE client_id='".$clientId."'";
			//echo $requete;
			$query = db()->prepare($requete);
			$query->execute();
			$returnList = [];
			if ($query->rowCount() > 0){
				$row = $query->fetch(PDO::FETCH_ASSOC);
				return self::FindById($row['id']);
			}else{
				self::create($clientId);
				$id=db()->lastInsertId();
				return self::FindById($id);
			}
		}
		
		static public function FindJoinOptionsById($id){
			$requete="select * from join_panier_option where panier_id='".$id."'";
			//echo $requete;
			$query = db()->prepare($requete);
			$query->execute();
			$returnList=[];
			if ($query->rowCount() > 0){
				$results = $query->fetchAll();
				foreach ($results as $row) {
					array_push($returnList, ["option"=>Option::FindById($row["option_id"]),"nombre"=>$row['nombre']]);
				}
			}
			return $returnList;
		}
		
		static public function ajouterOption($optionId){
			$panier = Self::FindByClientId($_SESSION['client']);
			$requete = "select count(*) as count,id from join_panier_option where panier_id='".$panier->id."' and option_id='".$optionId."'";
			//echo $requete;
			$query = db()->prepare($requete);
			$query->execute();
			if ($query->rowCount() > 0){
				$row = $query->fetch(PDO::FETCH_ASSOC);
				if($row['count']==0){
					$requete = "INSERT INTO join_panier_option VALUES (DEFAULT,'".$optionId."','".$panier->id."', 1, CURRENT_TIMESTAMP)";
					$query = db()->prepare($requete);
					$query->execute();
				}else{
					$requete = "UPDATE join_panier_option SET nombre=nombre+1 where id=".$row['id'];
					$query = db()->prepare($requete);
					$query->execute();
				}
			}else{
				return null;
			}
		}
	}
?>
