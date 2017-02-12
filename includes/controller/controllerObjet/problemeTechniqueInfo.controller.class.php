<?php 
require("../../modele/database.class.php");
require("../../modele/problemeTechniqueInfo.class.php");

class Controller_PbTechInfo{
	private $_PbTechInfo; 
	function __construct ($pbTechInfo){
		$this->_PbTechInfo=$pbTechInfo; 
	}
	function isGood(){
		// On ne vérifie pas le time, car le time n'est pas envoyé par le client mais géré depuis le serveur
		return(idIsGood() && idPbTechIsGood() && idUserIsGood() && messageIsGood()); 
	}
	function idIsGood(){
		return ($this->_PbTechInfo->getId()==NULL && is_numeric($this->_PbTechInfo->getId()));
	}
	function idPbTechIsGood(){
		$database = new Database();
		return (is_numeric($this->_PbTechInfo->getIdPbTech()) && $database->count('problemes_technique', array("id" => $this->_PbTechInfo->getIdPbTech())));
	}
	function idUserIsGood(){
		$database = new Database();
		return (is_numeric($this->_PbTechInfo->getIdUser()) && $database->count('users', array("id" => $this->_PbTechInfo->getIdUser())));
	}
	function messageIsGood(){
		return (!empty($this->_PbTechInfo->getMessage()));
	}
}


?> 


