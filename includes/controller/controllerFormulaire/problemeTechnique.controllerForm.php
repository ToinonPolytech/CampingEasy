<?php 

//controller de vérification des données lors de la création ou modification d'un problème technique via un formulaire


require("../../modele/database.class.php");

	$idUser = htmlspecialchars ($_POST['idUser']);
  $timeCreated = htmlspecialchars ($_POST['timeCreated']); //temps reçu en string 
  $timeEstimated = htmlspecialchars ($_POST['timeEstimated']); //temps reçu en string 
  $description = htmlspecialchars ($_POST['description']);
  $isBungalow = htmlspecialchars ($_POST['isBungalow']);
  $solved = htmlspecialchars ($_POST['solved']);
  $deleted = htmlspecialchars ($_POST['deleted']);
  
  
  //conversion des dates en secondes écoulées depuis le 1er janvier 1970 
 $timeSecCreated = strtotime($timeCreated) ; 
 $timeSecEstimated = strtotime($timeEstimated);


function envoiForm($idUser,$timeSecCreated,$timeSecEstimated,$description,$isBungalow,$solved,$deleted){
	if(idUserIsGood($idUser) && timeIsGood($timeSecCreated, $timeSecEstimated)	&& descriptionIsGood($description) &&
	isBungalowIsGood($isBungalow) && solvedIsGood($solved) && deletedIsGood($deleted))
		{
			
			//appel création ou modification problème technique 
		}
	
	
}

function idUserIsGood($idUser){
	$database = new Database(); 
	if(!empty($idUser))
	{
		if($is_int($idUser))
		{
			if($database->count('problemes_technique', array("id" => $idUser)==1)
			{
				return true;
			}
			else
			{
				echo "ERREUR : l'utilisateur créant le problème technique n'existe pas dans la base de données ";
				return false;
			}
		}
		else 
		{
			echo "ERREUR : l'id de l'utilisateur créant le problème technique n'est pas un entier ";
			return false;
		}
		
		
	}
	else 
	{
		echo "ERREUR : il n a pas d'utilisateur passé en paramètre dans le formulaire ";
		return false;
	}

				
	}
	
	function timeIsGood($timeCreated,$timeEstimated){
		if(!empty($timeCreated) && isset($timeEstimated))
		{
			if($timeCreated<=time())
			{
				if($timeEstimated>time())
				{
					if($timeCreated<$timeEstimated)
					{
						return true;
					}
					else
					{
						echo "ERREUR : la date de passage estimée ne peut être avant la date de création du problème technique ";
						return false; 
					}
				}
				else 
				{
					echo "ERREUR : la date de passage estimée ne peut être avant la dtae actuelle ";
					return false; 
				}
			}
			else 
			{
				echo "ERREUR : la date de création du problème ne peut être après la date actuelle ";
				return false; 
			}
		}
		else
		{
			echo "ERREUR : la date de création est vide ou la date de passage estimée n'existe pas ";
			return false; 
			
		}
		
	}
	
		
			
		
	function descriptionIsGood($description){
		
		if(!empty($description))
		{
			if((strlen($description)>20) && (strlen($description)<1000))
			{
				return true;
			}
			else
			{	
				echo "ERREUR : la description doit être comprise entre 21 et 999 caractères ";
				return false;
			}
		}
		else
		{	echo "ERREUR : la description du problème technique est vide ";
			return false;
		}
		
		
	}
	
	
	function isBungalowIsGood($isBungalow){
		if(!empty($isBungalow)
		{
			if(is_bool($isBungalow)
			{
				return true;
				
			}
			else
			{
				echo "ERREUR : le critère définissant si le problème est dans un bungalow n'est pas du bon type  ";
				return false;
			}
		}
		else
		{
			echo "ERREUR : vous devez préciser si le problème se passe dans un bungalow ou non   ";
			return false;
			
		}
		
		
	}
	
	function solvedIsGood($solved){
		if(isset($solved))
		{	if(empty($solved)
			{//si le critère résolu n'est pas donné alors il est à false 
				$solved = false; 
			}
			if(is_bool($solved)
			{
				return true;
			}
			else
			{
				echo "ERREUR : la variable définissant si le problème est résolu n'est pas du bon type  ";
				return false;
			}
		}
		else
		{
			echo "ERREUR : le critère résolu du problème est inexistant ";
			return false; 
		}
		
		
	}
	
	function deletedIsGood($deleted){
		if(isset($deleted))
		{	if(empty($deleted)
			{//si le critère supprimé n'est pas donné alors il est à false 
				$deleted = false; 
			}
			if(is_bool($deleted)
			{
				return true;
			}
			else
			{
				echo "ERREUR : la variable définissant si le problème est supprimé n'est pas du bon type  ";
				return false;
			}
		}
		else
		{
			echo "ERREUR : le critère supprimé du problème est inexistant ";
			return false;
		}
		
		
	}
	


?> 