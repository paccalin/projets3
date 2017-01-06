<?php
class DevisController extends Controller{
	/*
	public function show(){
		$constructeurs = Constructeur::FindAll();
		
		$modeles = Modele::FindAll();
		
		//$modele->constructeur;
		
		$data = ['constructeurs'=>$constructeurs, 'modeles'=>$modeles];
		
		$this->render("show", $data);
	}
	*/
	
	public function creer(){	
		if($_SESSION['droits']>=1){
			if(!isset($_POST['constructeur'])){//Mettre le premier champ du formulaire de création
				
					$constructeurs = Constructeur::FindAll();
				
					$modeles = Modele::FindAll();

					$options = Option::FindAll();					

					$data["Devis/creer"] = array();
					
					$data["Devis/creer"] = ['constructeurs'=>$constructeurs, 'modeles'=>$modeles, 'options'=>$options];
					
					$this->render("formCreationDevis",$data);
			}else{
				$data=array();
				$data['erreursSaisie']=array();
				if(false){
					array_push($data['erreurSaisies'],"Erreur de saisie 1");
				}
				if(false){
					array_push($data['erreurSaisies'],"Erreur de saisie 2");
				}
				if(true){
					array_push($data['erreurSaisies'],"Erreur de saisie 3");
				}
				if($data['erreurSaisies']!=[]){	
					$this->render("formCreationDevis",$data);
				}else{
					
					echo("<script type='text/javascript'>alert('yop')</script>");
					
					$modele = null;
					$client = null;
					$options = array();
					
					foreach($_POST as $key=>$value){
						if($key=='modeles'){
							if($value!=null){
								$modele = $value;
							}else{
								//definir si null
							}
						}elseif($key=='client'){
							if($value!=null){
								$idClient = substr($value, 0, 2);
								$client = Client::FindById($idClient);
							}else{
								//definir si null
							}
						}elseif(strstr($key, 'option')){
							if($value!=null){
								array_push($options, $value);
							}else{
								//definir si null
							}
						}
						
						if($modeles!= null && $client != null && empty($options)){
							
							//$pClient, $pUtilisateur, $pPath, $pActif, $pDateInsertion,$pId=null
							
							$devis = new Devis($client, $_SESSION['utilistateur'], './', '1', null, null);
							
							$request = 'insert into devis(client_id, utilisateur_id, path, actif, modele_id, date_insertion) values(';
							$request += $devis->client->id.','.$devis->utilisateur->id.','.$devis->path.','.$devis->actif.','.$devis->modele->id.','.$devis->dateInsertion.')';
							
							$db = db()->prepare($request);
							$db->execute();
							
							$devis->id = $db->fetch(PDO::lastInsertId);
							
							foreach($options as $option){
								$request = 'insert into join_devis_option(option_id, devis_id, date_insertion)';
								$request += 'value((select option_id from option where libelle = '."\'".$option."\')".','.$devis->id.','.$devis->dateInsertion.')';
							}
							
						}else{
							//definir si une des valeurs est null alors
						}
					}
				}
			}
		}else{
			$this->render("erreurAutorisation");
		}
	}

	public function afficherTous(){
		$data=array();
		$this->render("visualisationDevisTous",$data);
	}
	
	public function afficherParId(){
		$data=array();
		$this->render("visualisationDevisParId",$data);
	}

	public function rechercher(){
		if(!isset($_POST['recherche'])){
			$this->render("rechercheDevis");
		}
	}
}
