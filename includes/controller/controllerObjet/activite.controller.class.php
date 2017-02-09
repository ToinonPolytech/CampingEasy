<?php

require("../../modele/database.class.php");
require("../../modele/activite.class.php");
require("../../fonctions/general.php");


class Controller_Activite {
	
	private $_act;
	function __construct Controller_Activite($act){
		this->_act=$act; 
		
		
	}
	
	function isGood(){
		
		return(timeStartIsGood() && dureeIsGood() && nomIsGood() 
		&& descriptifIsGood() && ageIsGood() && lieuIsGood() &&
		typeIsGood() && placesLimIsGood() && prixIsGood() &&
		idOwnerIsGood() && pointsIsGood()); 
		
	}
	
	function timeStartIsGood(){
		if(!empty($timeStart)){
			if(is_numeric($act->timeStart))
			{
				if($timeStart>time()))
				{
					return true;
					
				}
				else
				{ 
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
		{	if(is_int($idOwner))
			{
				if($database->count('users', array("id" => $idOwner)==1))
				{
					return true; 					
				}
				else
				{ echo "ERREUR : Le créateur de l'activité n'existe pas "
				  return false; 
				}
			}
			else
			{
				echo "ERREUR :L'id du créateur de l'éctivité passé en paramètre n'est pas un entier ";
				return false;
			}
		}
		else 
		{
			echo "ERREUR : L'id du créateur de l'activité n'a pas été passé en paramètre  ";
			return false; 
		}
		
		
		
		
	}
	function pointsIsGood($points){
		
		if(isset($points))
		{	if(is_int($points))
			{
				if($points>=0 && $points<1000000000)
				{	
					if(empty($points){
						
						$points=0;
					}
					return true; 					
				}
				else
				{ echo "ERREUR : le nombre de points pour l'activité doit être compris entre 0 et 1 000 000 000  ";
				  return false; 
				}
			}
			else
			{
				echo "ERREUR : le nombre de points entré n'est pas un entier ";
				return false;
			}
		}
		else 
			
		{
			echo "ERREUR : Le nombre de points pour l'activité n'existe pas ";
			return false; 
		}
	}
		
		
		
		
		
		
		
	}
}
 






?> 