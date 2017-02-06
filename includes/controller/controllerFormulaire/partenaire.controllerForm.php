<?php 
//controller des données passées par formulaire pour la création d'un partenaire 


$nom = htmlspecialchars ($_POST['nom']);
  $libelle = htmlspecialchars ($_POST['libelle']);
  $mail = htmlspecialchars ($_POST['mail']);
  $siteWeb = htmlspecialchars ($_POST['siteWeb']);
  $telephone = htmlspecialchars ($_POST['telephone']);
  $deleted = htmlspecialchars ($_POST['deleted']);
 


function envoiForm($nom,$libelle,$mail,$siteWeb,$telephone,$deleted){
	
	if((nomIsGood($nom) && libelleIsGood($libelle) && mailIsGood($mail) && siteWebIsGood($siteWeb) && telephoneIsGood($telephone)){
		
		//envoi des données vers la création objet 
		
		
	}
	
	
}

//TODO : gérer le deleted (non vérifié ici mais quand même pris dans les paramètres )

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
				echo 'ERREUR : Le nom doit du partenaire contenir entre 3 et 40 caractères';
				return false;
			}
		else
		{
			echo 'ERREUR : Le nom du partenaire est vide';
			return false; 
		}
		
				
		}
	
		
	}
	function libelleIsGood($libelle){
		
		if(!empty($libelle))
		{
			if((strlen($libelle)>=20) && strlen($libelle)=<300))
			{
				return true;
			}
			else
			{
				echo 'ERREUR : Le descriptif du partenaire doit contenir entre 20 et 300 caractères';
				return false;
			}
		}
		else
		{
			echo 'ERREUR : Le libelle de du partenaire est vide';
			return false;
		}
		
		
	}
	function mailIsGood($mail){
		if(!empty($mail))
		{
				if($mail=regexp) //format voulu du mail en regexp
				{
					return true;
				}
				else 
				{
					echo "ERREUR : le format du mail n'est pas correct";
					return false;
				}
		}
		else
		{
			echo "ERREUR : le mail n'est n'est pas passé en paramètre "
		}
	
		
	}
	function siteWebIsGood($siteWeb){
		if(isset($siteWeb))
		{
			if(empty($siteWeb))
			{
				$mail= NULL; 
			}
			if($siteWeb==regexp)// format voulu di site web en regexp 
			{
				return true;
			}
			else
			{
				echo "ERREUR : le site web n'a pas le bon format ";
				return false;
			}
		}
		else 
		{
			echo "ERREUR : le site web n'est pas passé en paramètre  ";
			return false; 
		}
		
	}
	
	
	
	
	function telephoneIsGood($telephone){
		if(isset($telephone))
		{
			if(empty($telephone))
			{
				$telephone= NULL; 
			}
			if($telephone==regexp)// format voulu di site web en regexp 
			{
				return true;
			}
			else
			{
				echo "ERREUR : le numéro de téléphone n'a pas le bon format ";
				return false;
			}
		}
		else 
		{
			echo "ERREUR : le numero de téléphone  n'est pas passé en paramètre  ";
			return false; 
		}
		
	}
		
	//manque deletedIsGood()



?>