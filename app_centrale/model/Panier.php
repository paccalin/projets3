<?php
	class Panier extends Model{
		
		public function __construct($pClient, $pUtilisateur, $pPath = null,$pDateInsertion = null,$pId = null){
			/* constructeur vide utilisé par les sockets */			
			if($pId == null){
				$this->id = uniqid();
			}
			else{
				$this->id = $pId;
			}
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
			$id = Model::RandomId();
			$requete="insert into ".self::$tableName." values('".$id."','".$clientId."','".$_SESSION['utilisateur']."','path',CURRENT_TIMESTAMP)";
			//echo $requete;
			$query = db()->prepare($requete);
			$query->execute();
			return $id;
		}
		
		public function getCoutTotal(){
			$joinsPO = Panier::FindJoinOptionsById($this->id);
			$total=0;
			foreach($joinsPO as $joinPO){
				$total+=$joinPO['option']->prixDeBase*$joinPO['nombre'];
			}
			return $total;
		}
		
		public function getNbOptions(){
			$joinsPO = Panier::FindJoinOptionsById($this->id);
			$total=0;
			foreach($joinsPO as $joinPO){
				$total+=$joinPO['nombre'];
			}
			return $total;
			
			$requete="select count(*) as nb from join_panier_option where panier_id='".$this->id."'";
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
				$id = self::create($clientId);
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
		
		public function ajouterOption($optionId){
			$requete = "select count(*) as count,id from join_panier_option where panier_id='".$this->id."' and option_id='".$optionId."'";
			//echo $requete;
			$query = db()->prepare($requete);
			$query->execute();
			if ($query->rowCount() > 0){
				$row = $query->fetch(PDO::FETCH_ASSOC);
				if($row['count']==0){
					$requete = "INSERT INTO join_panier_option VALUES ('".Model::RandomId()."','".$optionId."','".$this->id."', 1, CURRENT_TIMESTAMP)";
					//echo $requete;
					$query = db()->prepare($requete);
					$query->execute();
				}else{
					$requete = "UPDATE join_panier_option SET nombre=nombre+1 where id='".$row['id']."'";
					//echo $requete;
					$query = db()->prepare($requete);
					$query->execute();
				}
			}else{
				return null;
			}
		}
		
		public function changeNombreOption($option,$changement){
			$requete="select id from join_panier_option WHERE panier_id='".$this->id."' and option_id='".$option->id."'";
			//echo $requete;
			$query = db()->prepare($requete);
			$query->execute();
			if ($query->rowCount() > 0){
				$row = $query->fetch(PDO::FETCH_ASSOC);
				if($changement=='plus'){
					$requete="UPDATE join_panier_option SET nombre=nombre+1 where id='".$row['id']."'";
				}elseif($changement=='moins'){
					$requete="UPDATE join_panier_option SET nombre=nombre-1 where id='".$row['id']."'";
				}else{
					throw new Exception('Erreur Panier/changeNombreOption: paramètre "changement" incorrect');
				}
				//echo $requete;
				$query = db()->prepare($requete);
				$query->execute();
			}else{
				throw new Exception('Erreur Panier/changeNombreOption: id de join_panier_option non trouvé');
			}
		}
		
		public function retireOption($option){
			$requete="delete from join_panier_option WHERE option_id='".$option->id."' and panier_id='".$this->id."'";
			echo $requete;
			$query = db()->prepare($requete);
			$query->execute();
		}
		
		protected function getNbOptionsByOptionID($optionID){
			$requete="select count(*) as nb from join_panier_option where panier_id='".$this->id."' and option_id ='".$optionID."'";
			$query = db()->prepare($requete);
			$query->execute();
			if ($query->rowCount() > 0){
				$row = $query->fetch(PDO::FETCH_ASSOC);
				return $row['nb'];
			}else{
				return -1;
			}
		}
	}
?>
