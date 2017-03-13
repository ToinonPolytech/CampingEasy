<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
require_once(i("database.class.php"));
require_once(i("problemeTechniqueInfo.class.php"));

class Controller_PbTechInfo{
	private $_PbTechInfo; 
	public function __construct ($pbTechInfo){
		$this->_PbTechInfo=$pbTechInfo; 
	}
	public function isGood(){
		// On ne vérifie pas le time, car le time n'est pas envoyé par le client mais géré depuis le serveur
		
		return($this->idIsGood() && $this->idPbTechIsGood() && $this->idUserIsGood() && $this->messageIsGood()); 
	}
	public function idIsGood(){
		
		if($this->_PbTechInfo->getId()!=NULL && is_numeric($this->_PbTechInfo->getId()))
		{
			return true;
		}
		else
		{
			echo 'ERREUR : id du message incorrect';
		}
		return false; 
	}
	public function idPbTechIsGood(){
		$database = new Database();
		if(is_numeric($this->_PbTechInfo->getIdPbTech()))
		{
			if($database->count('problemes_technique', array("id" => $this->_PbTechInfo->getIdPbTech())))
			{
				return true;
			}
			else
			{
				echo "ERREUR : le problème concerné n'existe pas "; 
				
			}
		}
		else
		{
			echo "ERREUR : l'id du problème n'est pas un nombre";
		}
		return false; 
	}
	public function idUserIsGood(){
		$database = new Database();
		if(is_numeric($this->_PbTechInfo->getIdPbTech()))
		{
			if( $database->count('users', array("id" => $this->_PbTechInfo->getIdUser())))
			{
				return true;
			}
			else
			{
				echo "ERREUR : l'utilisateur concerné n'existe pas "; 
				
			}
		}
		else
		{
			echo "ERREUR : l'id de l'utilisateur n'est pas un nombre";
		}
		return false; 
	}
		
	
	public function messageIsGood(){
		//à voir pour vérifications supplémentaire sur le message 
		if(!empty($this->_PbTechInfo->getMessage()))
		{
			return true;
		}
		else
		{
			echo 'ERREUR : le message est vide'; 
		}
	}
}


?> 


