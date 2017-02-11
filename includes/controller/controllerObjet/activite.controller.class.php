<?php

require("../../modele/database.class.php");
require("../../modele/activite.class.php");
require("../../fonctions/general.php");


class Controller_Activite {
	
	private $_act;
	function __construct Controller_Activite($act){
		this->act=$act; 
		
		
	}
	
	function isGood(){
		
		return(timeStartIsGood() && dureeIsGood() && nomIsGood() 
		&& descriptifIsGood() && ageIsGood() && lieuIsGood() &&
		typeIsGood() && placesLimIsGood() && prixIsGood() &&
		idOwnerIsGood() && pointsIsGood()); 
		
	}
	
	
	
	function timeStartIsGood(){
		if(!empty($act->getTimeStart())){
			if(is_numeric($act->getTimeStart())
			{
				if($act->getTimeStart()>time()))
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
	
	function dureeIsGood(){
		if(!empty($act->getDuree()))
		{	if(is_numeric($act->getDuree()))
			{
				if($act->getDuree()>0)
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
	function nomIsGood(){
		if(!em	pty($act->getNom()))
		{
			if((strlen($act->getNom())<40) &&
		strlen($act->getNom)>3)
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
	function descriptifIsGood(){
		if(!empty($act->getDescriptif()))
		{
			if((strlen($act->getDescriptif())>=20) && strlen($act->getDescriptif())=<300))
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
	
	function ageIsGood(){
		
		if(is_int($act->getAgeMin()) && is_int($act->getAgeMax()))
		{
			if(($act->getAgeMin()<$act->getAgeMax()) && ($act->getAgeMin()>=0) && ($act->getAgeMax()<100))
			{
				if(empty($act->getAgeMin()))
				{
					$act->getAgeMin()=0;
				}
				if(empty($act->getAgeMax()))
				{
					$act->getAgeMax()=0;
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
	
		
		
	
	function lieuIsGood(){
		$database = new Database();
		if(empty($act->getIdLieu()))
		{ 
			if(!empty($act->getLieu()))
			{
				if(strlen($act->getLieu())<50 && (strlen($act->getLieu())>4)
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
			if($database->count('lieuCommun', array("id" =>$act->getIdLieu()))
			{
				return true;
			} 
			else
			{   echo "ERREUR : le lieu proposé n'existe pas encore";
				return false;
			}
		
		}
		
	}
	
	function typeIsGood(){
		//le type reçu existe dans la base de données, s'il n'existait pas alors il est crée via un autre formulaire 
		$database = new Database();
		
		if(!empty($act->getType()))
		{ 
			if($database->count('typeActivite', array("nom" =>$act->getType())==0)
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
	
	function placesLimIsGood(){
		
		if(!empty($act->getPlacesLim()))
		{	if(is_int($act->getPlacesLim()))
			{
				if($act->getPlacesLim()>=0)
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
	function prixIsGood(){
		
		if(!empty($act->getPrix()))
		{	if(is_numeric($act->getPrix()))
			{
				if($act->getPrix()>0)
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
	
	function idOwnerIsGood(){
		
		if(is_int($act->getIdOwner()))
		{
			if($database->count('users', array("id" => $act->getIdOwner())==1))
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
	function pointsIsGood(){
		
		if(is_int($act->getPoints()))
		{
			if($act->getPoints()>=0 && $act->getPoints()<1000000000)
			{	
				if(empty($act->getPoints()){
					
					$act->getPoints()=0;
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
		
			
		
	}
}
 






?> 
