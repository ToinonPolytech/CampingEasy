<?php 

//controller des données passées en formulaire pour le type activité 


  $timeStart = htmlspecialchars ($_POST['timeStart']); //reçoit la valeur en secondes ? 
  $duree = htmlspecialchars ($_POST['duree']);
  $nom = htmlspecialchars ($_POST['nom']);
  $descriptif = htmlspecialchars ($_POST['descriptif']);
  $ageMin = htmlspecialchars ($_POST['ageMin']);
  $ageMax = htmlspecialchars ($_POST['ageMax']);
  $idLieu = htmlspecialchars ($_POST['idLieu']);
  $lieu = htmlspecialchars ($_POST['lieu']);
  //reçoit le nom d'un type de la base de données : l'ajout d'un type à celle-ci se fait dans un formulaire sur la même page mais à part entière 
  $type = htmlspecialchars ($_POST['type']);
  $placesLim = htmlspecialchars ($_POST['placesLim']);
  $prix = htmlspecialchars ($_POST['prix']);
  $idOwner = htmlspecialchars ($_POST['idOwner']);
  $points = htmlspecialchars ($_POST['points']);
 
  
//vérification des champs obligatoires non null et non vides
//TODO: si toutes les fonctions sont good, appelle du controller objet 

function timeStartIsGood($timeStart){
		if(!empty($timeStart)){
			if(is_numeric($timeStart))
			{
				if($timeStart>time()))
				{
					return true;
					
				}
				else
				{ //date de début erronée 
					echo 'ERREUR : La date de début est inférieure à la date actuelle';
					return false;
				}
			}
			else
			{
				echo "la date de début n'est pas une forme numerique ";
				return false;
			}
		}
		else 
		{ 
			echo "ERREUR : La date de début d'activité est vide "
			return false; 
		}
		
	}
	
	function dureeIsGood($duree){
		if(!empty($duree))
		{	if(is_numeric($duree))
			{
				if($durée>0)
				{
					return true; 					
				}
				else
				{ echo "ERREUR : La durée de l'activité ne peut être négative ou nulle";
				  return false; 
				}
			}
			else
			{
				echo "ERREUR : la durée entrée n'est pas de la forme numérique";
				return false;
			}
		}
		else 
		{
			echo "ERREUR : La durée de l'activité est vide";
			return false; 
		}
		
		
	}
	function nomIsGood($nom){
		if(!empty($nom))
		{
			if((strlen($nom)<40) &&
		strlen($nom)>3)
			{
			return true;
			}
			else 
			{
				echo 'ERREUR : Le nom doit contenir entre 3 et 40 caractères';
				return false;
			}
		else
		{
			echo 'ERREUR : Le nom de l activité est vide';
			return false; 
		}
		
				
		}
		
	}
	function descriptifIsGood($descriptif){
		if(!empty($descriptif))
		{
			if((strlen($descriptif)>=20) && strlen($descriptif)=<300))
			{
				return true;
			}
			else
			{
				echo 'ERREUR : Le descriptif de l activité doit contenir entre 20 et 300 caractères';
				return false;
			}
		}
		else
		{
			echo 'ERREUR : Le descriptif de l activite est vide';
			return false;
		}
		
		
	}
	
	function ageIsGood($ageMin,$ageMax){
		if(isset($ageMin) && isset($ageMax))
		{
			if(is_int($ageMin) && is_int($ageMax))
			{
				if(($AgeMin()<$AgeMax()) && ($AgeMin()>=0) && ($AgeMax()<100))
				{
					if(empty($ageMin))
					{
						$ageMin=0;
					}
					if(empty($ageMax))
					{
						$ageMax=0;
					}
				return true;
				}
				else
				{
					echo "ERREUR : les valeurs des ages doivent être comprises entre 0 et 99 et l'age maximum doit être supérieur à l'age minimum";
					return false;
				}
			}
			else
			{
				echo "ERREUR : Les valeurs entrées pour les age maximum et/ou minimum ne sont pas des nombres entiers";
				return false;
			}
		}
		else
		{
			echo "ERREUR : aucune donnée pour un des age ou les deux n'est parvenue";
			return false;
		}
		
			
		
	}
	function lieuIsGood($idLieu,$lieu){
		$database = new Database();
		if(empty($idLieu))
		{ 
			if(!empty($lieu))
			{
				if(strlen($Lieu())<50 && (strlen($Lieu())>4)
				{
					return true;
				}
				else 
				{
					echo "ERREUR : le nom du lieu doit être compris entre 4 et 50 caractères  ";
					return false;
				}
			}
			else 
			{
				echo "ERREUR : le champ du lieu est vide";
				return false;
			}
		}
		else{ 
			if($database->count('lieuCommun', array("id" =>$idLieu))
			{
				return true;
			} 
			else
			{   echo "ERREUR : le lieu proposé n'existe pas encore";
				return false;
			}
		
		}
		
	}
	
	function typeIsGood($type){
		//le type reçu existe dans la base de données, s'il n'existait pas alors il est crée via un autre formulaire 
		$database = new Database();
		
		if(!empty($type))
		{ 
			if($database->count('typeActivite', array("nom" =>$type)==0)
			{
				return true;
			}
			else
			{
				echo "ERREUR : ce type d'activité n'existe pas ";
				return false;
			}
		}
		else
		{
			echo 'ERREUR : Le type de l activite est vide';
			return false;
		}
		
		
		
		
	}
	
	function placesLimIsGood($placesLim){
		if(!empty($placesLim))
		{	if(is_int($placesLim))
			{
				if($placesLim>=0)
				{
					return true; 					
				}
				else
				{ echo "ERREUR : Le nombre de places maximum pour l'activité ne peut être négatif ";
				  return false; 
				}
			}
			else
			{
				echo "ERREUR : le nombre de places entré n'est pas un entier ";
				return false;
			}
		}
		else 
		{
			echo "ERREUR : Le nombre de places maximum pour l'activité est vide";
			return false; 
		}
		
		
			
		
		
	}
	function prixIsGood($prix){
		
		if(!empty($prix))
		{	if(is_numeric($prix))
			{
				if($prix>0)
				{
					return true; 					
				}
				else
				{ echo "ERREUR : Le prix de l'activité ne peut être négatif";
				  return false; 
				}
			}
			else
			{
				echo "ERREUR : le prix de l'activité n'est pas de la forme numérique";
				return false;
			}
		}
		else 
		{
			echo "ERREUR : Le prix de l'activité est vide";
			return false; 
		}
		
		
		
	}
	
	function idOwnerIsGood($idOwner){
		if(isset($idOwner))
		{	if(is_numeric($idOwner))
			{
				if($idOwner>=0)
				{
					return true; 					
				}
				else
				{ echo "ERREUR : La durée de l'activité ne peut être négative ou nulle";
				  return false; 
				}
			}
			else
			{
				echo "ERREUR : la durée entrée n'est pas de la forme numérique";
				return false;
			}
		}
		else 
		{
			echo "ERREUR : La durée de l'activité est vide";
			return false; 
		}
		
		return(!empty($IdOwner()) && ($database->count('users', array("id" => $act->getIdOwner()))==1));
		
		
	}
	function pointsIsGood(){
		
		return(!empty($Points()) && is_numeric($Points()) &&($Points()<999999999));
		
	}
?>
