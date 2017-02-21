<?php

require_once("/../../modele/database.class.php");
require_once("/../../modele/activities.class.php");
require_once("/../../fonctions/general.php");


class Controller_Activite {
	
	private $act;
	public function __construct ($act){
		$this->act=$act; 
	}
	
	public function isGood(){
		
		return($this->timeStartIsGood() && $this->dureeIsGood() && $this->nomIsGood() 
		&& $this->descriptifIsGood() && $this->ageIsGood() && $this->lieuIsGood() &&
		$this->typeIsGood() && $this->placesLimIsGood() && $this->prixIsGood() &&
		$this->idOwnerIsGood() && $this->pointsIsGood() && $this->mustBeReservedIsGood()); 
		
	}
	
	
	
	public function timeStartIsGood(){
		if(!empty($this->act->getDate())){
			if(is_numeric($this->act->getDate()))
			{
				if($this->act->getDate()>time())
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
			echo "ERREUR : La date de début d'activité est vide ";
			return false; 
		}
		
	}
	
	public function dureeIsGood(){
		if(!empty($this->act->getDuree()))
		{	if(is_numeric($this->act->getDuree()))
			{
				if($this->act->getDuree()>0)
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
	public function nomIsGood(){
		if(!empty($this->act->getNom()))
		{
			if((strlen($this->act->getNom())<40) &&
		strlen($this->act->getNom())>3)
			{
			return true;
			}
			else 
			{
				echo 'ERREUR : Le nom doit contenir entre 3 et 40 caractères';
				return false;
			}
		}
		else
		{
			echo 'ERREUR : Le nom de l activité est vide';
			return false; 
		}
		
				
		
		
	}
	public function descriptifIsGood(){
		if(!empty($this->act->getDescriptif()))
		{
			if((strlen($this->act->getDescriptif())>=20) && strlen($this->act->getDescriptif())<=300)
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
	
	public function ageIsGood(){
		if(empty($this->act->getAgeMin()))
			{
				$this->act->setAgeMin(0);
			}
		if(empty($this->act->getAgeMax()))
			{
				$this->act->setAgeMax(0);
			}
		
		
		if(is_numeric($this->act->getAgeMin()) && is_numeric($this->act->getAgeMax()))
		{
			if(($this->act->getAgeMin()>=0) && ($this->act->getAgeMax()<100))
			{ if(($this->act->getAgeMin()<=$this->act->getAgeMax()) ||  $this->act->getAgeMin()==0 )
				
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
	
		
		
	
	public function lieuIsGood(){
		$database = new Database();
		
		if(!empty($this->act->getLieu()))
			{
				if(strlen($this->act->getLieu())<50 && (strlen($this->act->getLieu())>4))
				{
					return true;
				}
				else 
				{
					echo "ERREUR : le nom du lieu doit être compris entre 4 et 50 caractères  ";
					
				}
			}
			else 
			{	$this->act->setLieu("Lieu non précisé");
				echo "Attention : aucun lieu n'a été précisé. L'activité est enregistrée mais nous vous conseillons d'ajouter un lieu dans Gérer mes activités";
				return true;
			}
		return false;
		
		
	}
	
	public function typeIsGood(){
		//le type reçu existe dans la base de données, s'il n'existait pas alors il est crée via un autre formulaire 
		
		
		if(!empty($this->act->getType()))
		{ 
			if($this->act->getType()=="SPORTIF" || $this->act->getType()=="INTELLECTUELLE")
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
	
	public function placesLimIsGood(){
		
		if(!empty($this->act->getPlacesLim()))
		{	if(is_int($this->act->getPlacesLim()))
			{
				if($this->act->getPlacesLim()>=0)
				{
					return true; 					
				}
				else
				{ echo "ERREUR : Le nombre de places maximum pour l'activité ne peut être négatif ";
				
				}
			}
			else
			{
				echo "ERREUR : le nombre de places entré n'est pas un entier ";
				
			}
		}
		else 
		{
			$this->act->setPlacesLim(0);
			return true; 
			
		}
		
		return false;
			
		
		
	}
	public function prixIsGood(){
		
		if(!empty($this->act->getPrix()) || $this->act->getPrix()==0)
		{	if(is_numeric($this->act->getPrix()))
			{
				if($this->act->getPrix()>=0)
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
		{	echo $this->act->getPrix();
			echo "ERREUR : Le prix de l'activité est vide";
			return false; 
		}
		
		
		
	}
	
	public function idOwnerIsGood(){
		$database = new Database();
		if(is_numeric($this->act->getIdOwner()))
		{
			if($database->count('users', array("id" => $this->act->getIdOwner())==1))
			{
				return true; 					
			}
			else
			{ echo "ERREUR : Le créateur de l'activité n'existe pas ";
			  return false; 
			}
		}
		else
		{
			echo "ERREUR :L'id du créateur de l'éctivité passé en paramètre n'est pas un entier ";
			return false;
		}
	
		
		
		
		
	}
	public function pointsIsGood(){
		
		if(is_numeric($this->act->getPoints()))
		{
			if($this->act->getPoints()>=0 && $this->act->getPoints()<1000000000)
			{	
				if(empty($this->act->getPoints()))
				{
					
					$this->act->setPoints(0);
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
		
			
	public function mustBeReservedIsGood(){
		if ($this->act->getMustBeReserved()==0 || $this->act->getMustBeReserved()==1) 
			return true;
		
		echo "ERREUR : Vous devez indiquer si l'activité doit être réserver ou non.";
		return false;
	}	
}






?> 
