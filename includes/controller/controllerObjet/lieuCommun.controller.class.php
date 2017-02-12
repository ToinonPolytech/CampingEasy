<?php

require_once("/../../modele/database.class.php");
require_once("/../../modele/lieuCommun.class.php");



class Controller_LieuCommun {

	private $LC; 
	
	public function __construct ($LC){
		$this->LC=$LC;
	}
	public function isGood(){
		return ($this->nomIsGood() && $this->descriptionIsGood());
	}
	
	public function nomIsGood(){
		if(!empty($this->LC->getNom()))
		{
			if((strlen($this->LC->getNom())<40) && strlen($this->LC->getNom())>3)
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
			echo 'ERREUR : Le nom du lieu crée est vide';
			return false; 
		}	
	}
	 

 
 
	public function descriptionIsGood(){
	if(!empty($this->LC->getDescription()))
		{
			if(strlen($this->LC->getDescription())<=500)
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
