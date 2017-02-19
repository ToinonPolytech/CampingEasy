<?php 
require_once("../../modele/database.class.php");
require_once("../../modele/equipe.class.php");

class Controller_Equipe
{
	private $_equipe;
	public function __construct ($equipe){
		$this->_equipe=$equipe;
	}
	public function isGood(){
		return ($this->nomIsGood() && $this->scoreIsGood());
	}
	public function nomIsGood(){
		if(!empty($this->_equipe->getNom() || preg_match("#^[a-zA-Z0-9]{3,40}$#",$this->_equipe->getNom()) ))
		{
			return true;
		}
		else 
		{
			echo "ERREUR : le nom n'a pas été rempli ou n'a pas la bonne forme (entre 3 et 40 caractères) ";
			return false; 
		}
		
	}
	
	public function scoreIsGood(){
		
		if(!empty($this->_equipe->getScore()) ||  preg_match("#^[0-9]{1,255}$#",$this->_equipe->getScore()))
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