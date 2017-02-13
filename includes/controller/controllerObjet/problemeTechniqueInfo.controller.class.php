<?php 
require_once("../../modele/database.class.php");
require_once("../../modele/problemeTechniqueInfo.class.php");

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
		return ($this->_PbTechInfo->getId()==NULL && is_numeric($this->_PbTechInfo->getId()));
	}
	public function idPbTechIsGood(){
		$database = new Database();
		return (is_numeric($this->_PbTechInfo->getIdPbTech()) && $database->count('problemes_technique', array("id" => $this->_PbTechInfo->getIdPbTech())));
	}
	public function idUserIsGood(){
		$database = new Database();
		return (is_numeric($this->_PbTechInfo->getIdUser()) && $database->count('users', array("id" => $this->_PbTechInfo->getIdUser())));
	}
	public function messageIsGood(){
		return (!empty($this->_PbTechInfo->getMessage()));
	}
}


?> 


