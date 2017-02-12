<?php 
require_once("../../modele/database.class.php");
require_once("../../modele/equipe.class.php");

class Controller_Equipe
{
	private $_equipe;
	function __construct ($equipe){
		$this->_equipe=$equipe;
	}
	function isGood(){
		return (nomIsGood() && scoreIsGood());
	}
	function nomIsGood(){
		if(!empty($_equipe->getNom() || preg_match("#^[a-zA-Z0-9]+{3,40}$#",$_equipe->getNom()) ))
		{
			return true;
		}
		else 
		{
			echo "ERREUR : le nom n'a pas été rempli ou n'a pas la bonne forme (entre 3 et 40 caractères) ";
			return false; 
		}
		
	}
	
	function scoreIsGood(){
		
		if(!empty($_equipe->getScore()) ||  preg_match("#^[0-9]+{1,255}$#",$_equipe->getScore()))
		{
				return true;
		}
		else
		{
			echo "ERREUR : le score de l'équipé est vide ou n'est pas un nombre correct ";
			return false;
		}
	}
}
?>