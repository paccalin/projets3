<?php
class DevisController extends Controller{
	
	public function creer(){	
		if($_SESSION['droits']>=1){
			$data['constructeurs']=Constructeur::FindAll();
			$data['modeles']=Modele::FindAll();
			$data['options']=Option::FindAll();				
			$data['clients']=Client::FindAll();		
			if(!isset($_POST['submit'])){
					$this->render("formCreationDevis",$data);
			}else{
				$data['erreursSaisie']=[];
				if(false){
					array_push($data['erreursSaisie'],"Erreur de saisie 1");
				}
				foreach($_POST as $key=>$value){
					if($key=='constructeur'){
						if($value=='null'){
							array_push($data['erreursSaisie'],"Aucun constructeur n'est sélectionné");
						}
					}
					if($key=='modele'){
						if($value=='null'){
							array_push($data['erreursSaisie'],"Aucun modèle n'est sélectionné");
						}
					}
					if($key=='client'){
						if($value=='null'){
							array_push($data['erreursSaisie'],"Aucun client n'est sélectionné");
						}
					}
					if(substr($key,0,6)=='option' and $value=='null'){
						array_push($data['erreursSaisie'],"L'option ".substr($key,-1)." n'est pas sélectionnée");
					}
				}
				if($data['erreursSaisie']!=[]){	
					$this->render("formCreationDevis",$data);
				}else{
					$client = Client::FindByID($_POST['client']);
					$utilisateur = Utilisateur::FindByPseudo($_SESSION['identifiant']);
					$nextId = Devis::getNextID();
					$modele = Modele::FindByID($_POST['modele']);
					$devis = new Devis($client, $utilisateur, 'devis/devis'.$nextId.'.pdf', 1, $modele,null);
					Devis::insert($devis);
					Socket::store('tablette','insert','devis',$devis);
					$options = [];
					foreach($_POST as $key=>$value){
						if(substr($key,0,6)=='option'){
							array_push($options, Option::FindByID($value));
						}
					}
					Devis::createJoinOptions($devis,$options);
					header('Location: ./?r=devis/afficherParID&devis='.$devis->id);
				}
			}
		}else{
			$this->render("erreurAutorisation");
		}
	}

	public function afficherTous(){
		$data=array();
		$data['devis']=Devis::FindAll();
		$this->render("visualisationDevisTous",$data);
	}
	
	public function afficherParId(){
		$data=array();
		$data['devis']=Devis::FindByID($_GET['devis']);
		$data['joinOptions']=Devis::FindJoinOptionsByDevisID($_GET['devis']);
		$data['total']=0;
		foreach($data['joinOptions'] as $joinOption){
			$data['total']+=$joinOption['prix'];
		}
		$data['total']=number_format ($data['total'], 2, ',', ' ');
		$this->render("visualisationDevisParId",$data);
	}

	public function genererXML(){
		/* C'est pas très beau mais ça affiche bien les données -> on pourra toujours en faire un truc */
		$data['devis']=Devis::FindByID($_GET['devis']);
		$data['client']=$data['devis']->client;
		$data['joinOptions']=Devis::FindJoinOptionsByDevisID($_GET['devis']);
		$data['total']=0;
		foreach($data['joinOptions'] as $joinOption){
			$data['total']+=$joinOption['prix'];
		}
		$data['total']=number_format ($data['total'],2,',',' '); // -> 1 845 000,00

		$dom = new DomDocument('1.0', 'UTF-8');
		$devis = $dom->createElement('devis');
		$dom->appendChild($devis);

		$titre = $dom->createElement('titre');
		$devis->appendChild($titre);
		$titre->appendChild($dom->createTextNode('Devis'));

		$societe = $dom->createElement('societe');
		$devis->appendChild($societe);
		$nomSociete = $dom->createElement('nom');
		$nomSociete->appendChild($dom->createTextNode('ID Aménagements utilitaires'));
		$telephoneSociete = $dom->createElement('telephone');
		$telephoneSociete->appendChild($dom->createTextNode('0474451739'));
		$mailSociete = $dom->createElement('mail');
		$mailSociete->appendChild($dom->createTextNode('id.utilitaires@orange.fr'));
		$adresseSociete = $dom->createElement('adresse');
		$adresseSociete->appendChild($dom->createTextNode('2799, Route Départementale 1075'));
		$villeSociete = $dom->createElement('ville');
		$villeSociete->appendChild($dom->createTextNode(' Montagnat'));
		$societe->appendChild($nomSociete);
		$societe->appendChild($telephoneSociete);
		$societe->appendChild($mailSociete);
		$societe->appendChild($adresseSociete);
		$societe->appendChild($villeSociete);

		$reference = $dom->createElement('reference');
		$devis->appendChild($reference);
		$referenceDevis = $dom->createElement('identifiant');
		$referenceDevis->appendChild($dom->createTextNode($data['devis']->id));
		$dateDevis = $dom->createElement('date');
		$dateDevis->appendChild($dom->createTextNode($data['devis']->dateInsertion));
		$numClientDevis = $dom->createElement('num_client');
		$numClientDevis->appendChild($dom->createTextNode($data['client']->id));
		$reference->appendChild($referenceDevis);
		$reference->appendChild($dateDevis);
		$reference->appendChild($numClientDevis);

		$client = $dom->createElement('client');
		$devis->appendChild($client);
		$nomClient = $dom->createElement('nom');
		$nomClient->appendChild($dom->createTextNode($data['client']->nom));
		$prenomClient = $dom->createElement('prenom');
		$prenomClient->appendChild($dom->createTextNode($data['client']->prenom));
		$telephoneClient = $dom->createElement('telephone');
		$telephoneClient->appendChild($dom->createTextNode($data['client']->tel));
		$client->appendChild($nomClient);
		$client->appendChild($prenomClient);
		$client->appendChild($telephoneClient);

		$options = $dom->createElement('options');
		$devis->appendChild($options);
		$compteur=1;
		foreach($data['joinOptions'] as $joinOption){
			$option = $dom->createElement('option_'.$compteur);
			$libelle = $dom->createElement('libelle');
			$libelle->appendChild($dom->createTextNode($joinOption['option']->libelle));
			$prix = $dom->createElement('prix');
			$prix->appendChild($dom->createTextNode(number_format($joinOption['prix'],2,',',' ')));
			$option->appendChild($libelle);
			$option->appendChild($prix);
			$options->appendChild($option);
			$compteur+=1;
		}

		$total = $dom->createElement('total');
		$total->appendChild($dom->createTextNode($data['total']));
		$devis->appendChild($total);
		
		$dom->formatOutput = true;
		$devis1 = $dom->saveXML();
		$dom->save('./devis/devis'.$_GET['devis'].'.xml');
		include_once "view/header.php";
		echo '<pre>'.htmlentities($dom->saveHTML()).'</pre>';
		echo "<script type='text/javascript'>window.open('./devis/devis".$_GET['devis'].".xml', '_blank')</script>";
	}

	public function genererPDF(){
		$data['devis']=Devis::FindByID($_GET['devis']);
		$data['joinOptions']=Devis::FindJoinOptionsByDevisID($_GET['devis']);
		$data['totalHT']=0;
		foreach($data['joinOptions'] as $joinOption){
			$data['totalHT']+=$joinOption['prix'];
		}
		$data['TVA']=0.2*$data['totalHT'];
		$data['totalTTC']=$data['totalHT']+$data['TVA'];
		$data['totalHT']=number_format ($data['totalHT'],2,',',' ');
		$data['TVA']=number_format ($data['TVA'],2,',',' ');
		$data['totalTTC']=number_format ($data['totalTTC'],2,',',' ');

		require('./assets/tftpd/tfpdf.php');

		$pdf = new tFPDF();
		$pdf->AddPage();
		$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
		$pdf->setFillColor(184, 233, 250); 

		$pdf->Image('./images/logo.jpg', 10, 10, 40);

		$pdf->Cell(0,20,'',0,1,'G');

		$pdf->SetFont('DejaVu','',16);
		$pdf->Cell(20,10,'ID Aménagements Utilitaires',0,0,'G');

		$pdf->SetFont('DejaVu','',25);
		$pdf->SetX(-80);
		$pdf->Cell(60,15,'DEVIS',0,1,'C',true);

		$pdf->SetFont('DejaVu','',12);
		$pdf->Cell(20,5,'2799, Route Départementale 1075',0,1,'G');
		$pdf->Cell(20,5,'01250 Montagnat',0,1,'G');
		$pdf->Cell(20,5,'04 74 45 17 39',0,1,'G');
		$pdf->Cell(20,5,'id.utilitaires@orange.fr',0,1,'G');

		$pdf->Cell(0,12,'',0,1,'G');

		$pdf->Cell(50,5,'Référence : '.$data['devis']->id,0,0,'G',true);
		$pdf->SetFont('DejaVu','',16);
		$pdf->SetX(-75);
		$pdf->Cell(50,5,$data['devis']->client->nom.' '.$data['devis']->client->prenom,0,1,'G');
		$pdf->SetFont('DejaVu','',12);
		$pdf->Cell(50,5,'Date : DATE ACTUELLE',0,0,'G',true);
		$pdf->SetX(-75);
		$pdf->Cell(50,5,$data['devis']->client->rue,0,1,'G');
		$pdf->Cell(50,5,'N° client : '.$data['devis']->client->id,0,0,'G',true);
		$pdf->SetX(-75);
		$pdf->Cell(50,5,$data['devis']->client->cp.' '.$data['devis']->client->ville,0,2,'G');
		$pdf->Cell(50,5,$data['devis']->client->tel,0,1,'G');
		
		$pdf->Cell(0,10,'',0,1,'G');

		$pdf->Cell(60,5,'Intitulé : Installation d\'options',0,1,'G');

		$pdf->Cell(0,5,'',0,1,'G');

		$pdf->Cell(60,5,'Modèle du véhicule : '.$data['devis']->modele->constructeur->libelle.' '.$data['devis']->modele->libelle,0,1,'G');

		$pdf->Cell(0,5,'',0,1,'G');

		$pdf->Cell(60,5,'Liste des options : ',0,1,'G');

		$header=['Option','Prix'];
		foreach($header as $col){
			$pdf->Cell(80,7,$col,1,0,'C','fill');
		}
    	$pdf->Ln();
		foreach($data['joinOptions'] as $joinOption){
		    $pdf->Cell(80,8,$joinOption['option']->libelle,1);
			$pdf->Cell(80,8,number_format($joinOption['prix'],2,',',' ').' €',1,0,'R');
		    $pdf->Ln();
		}

		$pdf->Cell(0,7,'',0,1,'G');
		
		$pdf->SetX(-120);
		$pdf->Cell(40,7,'Total HT',1,0);
		$pdf->Cell(40,7,$data['totalHT'].' €',1,1,'R');
		$pdf->SetX(-120);
		$pdf->Cell(40,7,'TVA à 20%',1,0);
		$pdf->Cell(40,7,$data['TVA'].' €',1,1,'R');
		$pdf->SetX(-120);
		$pdf->Cell(40,7,'Total TTC',1,0);
		$pdf->Cell(40,7,$data['totalTTC'].' €',1,1,'R');

		$pdf->Cell(0,5,'',0,1,'G');

		$pdf->Cell(0,7,'Nous restons à votre disposition pour toute information complémentaire.',0,1,'G');

		$pdf->Cell(0,5,'',0,1,'G');

		$pdf->Cell(0,5,'Si ce devis vous convient, veuillez nous le retourner signé précédé de la mention :',0,1,'G');
		$pdf->Cell(0,5,'BON POUR ACCORD ET EXECUTION DU DEVIS',0,1,'G');

		$pdf->Cell(0,7,'',0,1,'G');

		$pdf->Cell(0,5,'Date',0,0,'G');
		$pdf->SetX(-90);
		$pdf->Cell(0,5,'Signature',0,1,'G');

		$pdf->Cell(0,22,'',0,1,'G');

		$pdf->SetFont('DejaVu','',10);
		$pdf->SetTextColor(150,150,150);
		$pdf->Cell(0,5,'Validité du devis : X mois',0,1,'G');
		$pdf->Cell(0,5,'Condition de règlement : X',0,1,'G');
		$pdf->Cell(0,5,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus porta maximus orci, in semper tellus dignissim ut.',0,1,'G');

		$pdf->Output('./devis/devis'.$_GET['devis'].'.pdf','F');
		$pdf->Output();
	}

	public function rechercher(){
		if(isset($_POST['recherche'])){
			$data['resultat']=Devis::FindByString($_POST['recherche']);
			if($data['resultat']==[]){
				$data['message']='Aucun devis n\'a été trouvé à ce numéro, ni dont le nom/prénom du client ou le nom du véhicule correspond à cette expression.';
			}
			$this->render("formRechercheDevis",$data);
		}else{
			$this->render("formRechercheDevis");
		}
	}
}	
