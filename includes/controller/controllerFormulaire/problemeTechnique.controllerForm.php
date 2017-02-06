<?php 

//controller de vérification des données lors de la création ou modification d'un problème technique via un formulaire


require("../../modele/database.class.php");

$idUser = htmlspecialchars ($_POST['idUser']);
  $timeCreated = htmlspecialchars ($_POST['timeCreated']);
  $timeEstimated = htmlspecialchars ($_POST['timeEstimated']);
  $description = htmlspecialchars ($_POST['description']);
  $isBungalow = htmlspecialchars ($_POST['isBungalow']);
  $solved = htmlspecialchars ($_POST['solved']);
  $deleted = htmlspecialchars ($_POST['deleted']);
 


function envoiForm($idUser,$timeCreated,$timeEstimated,$description,$isBungalow,$solved,$deleted){
	if(idUserIsGood($idUser) && timeCreatedIsGood($timeCreated) && timeEstimatedIsGood($timeEstimated) 
		&& descriptionIsGood($description) && isBungalowIsGood($isBungalow) && solvedIsGood($solved) && deletedIsGood($deleted))
		{
			
			//appel création ou modification problème technique 
		}
	
	
}
//DONE : c/c des fonctions controller du problème technique.class 
//TODO : modification adaptées au controller formulaire +ajout deletedIsGood 
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
	
	function timeCreatedIsGood($idUser){
		
		return(!empty(_PbTech->getTimeCreated()) &&  is_numeric(_PbTech->getTimeCreated()));
		
	}
	
	function timeEstimatedIsGood(){
		if(!empty(_PbTech->getTimeEstimated()) && is_numeric(_PbTech->getTimeEstimated()))
		{	 if(!_PbTech->getTimeEstimated()==0)
			{
				return( _PbTech->getTimeEstimated()>_PbTech->getTimeCreated() );
			
			}
		}
			
	}	
	function descriptionIsGood(){
		return(!empty(_PbTech->getDescription()) && (strlen(_PbTech->getDescriptionIsGood())>20) 
		&& (strlen(_PbTech->getDescriptionIsGood())<1000));
		
	}
	
	function isBungalowIsGood(){
		return(!empty(_PbTech->getIsBungalow()) && is_bool(_PbTech->getIsBungalow());
	}
	
	function solvedIsGood(){
		return(!empty(_PbTech->getSolved()) && is_bool(_PbTech->getSolved());
		
	}



?> 