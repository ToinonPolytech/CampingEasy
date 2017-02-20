<?php 

require_once("../../modele/database.class.php");
require_once("../../modele/problemeTechnique.class.php");



class Controller_PbTech {

	private $_PbTech; 
	public function __construct ($pbTech){
		$this->_PbTech=$pbTech; 	
	}
	public function isGood(){
		return($this->idUserIsGood() && $this->timeIsGood()
		&& $this->descriptionIsGood() && $this->isBungalowIsGood() && $this->solvedIsGood()); 
		
	}

	public function idUserIsGood(){
		$database = new Database(); 
		
		if(!empty($this->_PbTech->getIdUser()))
		{	
			if(is_numeric($this->_PbTech->getIdUser()))
			{
				if($database->count('users', array("id" => $this->_PbTech->getIdUser())==1))
				{
					return true;
				}
				else
				{
					echo "ERREUR : l'utilisateur créant le problème technique n'existe pas dans la base de données ";
					
				}
			}
			else 
			{
				echo "ERREUR : l'id de l'utilisateur créant le problème technique n'est pas un entier ";
				
			}
		}
		else 
		{
			echo "ERREUR : il n a pas d'utilisateur passé en paramètre dans le formulaire ";
			
		}	
		return false;
	}
	
	public function timeIsGood(){
		if(!empty($this->_PbTech->getTimeCreated()) )
		{
			if($this->_PbTech->getTimeCreated()<=time())
			{	
				if(!empty($this->_PbTech->getTimeEstimated()))
				{
					if($this->_PbTech->getTimeEstimated()>time())
					{
						if($this->_PbTech->getTimeCreated()<$this->_PbTech->getTimeEstimated())
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
					$this->_PbTech->setTimeEstimated(-1);
					return true;
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
			echo "ERREUR : la date de création est vide  ";
			return false; 
			
		}
		
	}	
	public function descriptionIsGood(){
		if(!empty($this->_PbTech->getDescription()))
		{
			if((strlen($this->_PbTech->getDescription())>20) && (strlen($this->_PbTech->getDescription())<1000))
			{
				return true;
			}
			else
			{	
				echo "ERREUR : la description doit être comprise entre 21 et 999 caractères ";
				
			}
		}
		else
		{	echo "ERREUR : la description du problème technique est vide ";
			
		}
		return false;
	}
	public function isBungalowIsGood(){
		if(!empty($this->_PbTech->getIsBungalow()))
		{	
			if(is_bool($this->_PbTech->getIsBungalow()))
			{
				return true;
				
			}
			else
			{
				echo "ERREUR : le critère définissant si le problème est dans un bungalow n'est pas du bon type  ";
				
			}
		}
		else
		{
			echo "ERREUR : vous devez préciser si le problème se passe dans un bungalow ou non   ";
			
			
		}
		return false;
	}
	public function solvedIsGood(){
		if($this->_PbTech->getSolved()=="NON_RESOLU" || $this->_PbTech->getSolved()=="RESOLU" || $this->_PbTech->getSolved()=="EN_COURS")
			return true;
		
		echo "ERREUR : le type résolu du problème est incorrect   ";
		return false;
	}	
}


?> 


