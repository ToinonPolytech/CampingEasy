<?php 

require("../../modele/database.class.php");
require("../../modele/problemeTechnique.class.php");



class Controller_PbTech {
	
	
	private $pbTech; 
	
	function __construct Controller_PbTech($pbTech){
		this->_PbTech=$pbTech; 
			
	}
	
	function isGood(){
		
		return(idUserIsGood() && timeCreatedIsGood() && timeEstimatedIsGood() 
		&& descriptionIsGood() && isBungalowIsGood() && solvedIsGood()); 
		
	}

function idUserIsGood(){
	$database = new Database(); 
	if(!empty($_PbTech->getIdUser()))
	{
		if($is_int($_PbTech->getIdUser()))
		{
			if($database->count('problemes_technique', array("id" => $_PbTech->getIdUser())==1)
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
	
	function timeIsGood(){
		if(!empty($_PbTech->getTimeCreated()) && isset($_PbTech->getTimeEstimated()))
		{
			if($_PbTech->getTimeCreated()<=time())
			{
				if($_PbTech->getTimeEstimated()>time())
				{
					if($_PbTech->getTimeCreated()<$_PbTech->getTimeEstimated())
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
	
		
			
		
	function descriptionIsGood(){
		
		if(!empty($_PbTech->getDescription()))
		{
			if((strlen($_PbTech->getDescription())>20) && (strlen($_PbTech->getDescription())<1000))
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
	
	
	function isBungalowIsGood(){
		if(!empty($_PbTech->getIsBungalow())
		{
			if(is_bool($_PbTech->getIsBungalow())
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
	
	function solvedIsGood(){
		if(isset($_PbTech->getSolved()))
		{	if(empty($_PbTech->getSolved())
			{//si le critère résolu n'est pas donné alors il est à false 
				$_PbTech->getSolved() = false; 
			}
			if(is_bool($_PbTech->getSolved())
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
}


?> 


