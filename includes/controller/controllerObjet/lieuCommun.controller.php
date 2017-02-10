<?php

require("../../modele/database.class.php");
require("../../modele/lieuCommun.class.php");



class Controller_LieuCommun(){

	private $LC; 
	
	function __construct Controller_LieuCommun($LC){
		$this->LC=$LC;

		
	}
	function isGood(){
		
		return(nomIsGood() && descriptionIsGood());
	}
	
function nomIsGood(){
	 
	 if(!empty($LC->getNom()))
		{
			if((strlen($LC->getNom)<40) && strlen($LC->getNom())>3)
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
			echo 'ERREUR : Le nom du lieu crée est vide';
			return false; 
		}
		
				
		}
	 
 }
 
 
 function descriptionIsGood(){
	if(!empty($LC->getDescription()))
		{
			if(strlen($LC->getDescription())=<500))
			{
				return true;
			}
			else
			{
				echo 'ERREUR : La description du lieu peut contenir au maximum 500 caractères';
				return false;
			}
		}
		else
		{
			echo 'ERREUR : La description du lieu est vide';
			return false;
		}
		
		
	} 	









}


?>
