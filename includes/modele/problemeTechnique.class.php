<?php
require("database.class.php");


class PbTech{
	private $_id;    // clé primaire
	private $_idUser;  // id créateur probleme
	private $_timeCreated;  // timestamp de la création
	private $_timeEstimated; // timestamp de quand le problème devrait être résoly
	private $_description; // description du probleme
	private $_isBungalow; // boolean, si le probleme se situe dans le bungalow
	private $_solved;  // 0 ou clé secondaire du technicien ayant résolu le probleme
	private $_deleted; // true si on doit supprimer, false sinon
	function __construct($id, $idUsers, $timeCreated, $timeEstimated, $description, $isBungalow, $solved) {
		$this->_id = $id;
		$this->_idUser=$idUsers;
		$this->_timeCreated=$timeCreated;
		$this->_timeEstimated=$timeEstimated;
		$this->_description=$description;
		$this->_isBungalow=$isBungalow;
		$this->_solved=$solved;
		$this->_deleted=false;
	}
	function __construct($id) {
		$database = new Database();
		$database->select('problemes_technique', array("id" => $id));
		$data=$database->fetch();
		$this->_id = $id;
		$this->_idUser=$data["idUsers"];
		$this->_timeCreated=$data["time_start"];
		$this->_timeEstimated=$data["time_estimated"];
		$this->_description=$data["description"];
		$this->_isBungalow=$data["isBungalow"];
		$this->_solved=$data["solved"];
		$this->_deleted=false;
	}
	function saveToDb(){
		$database = new Database();
		if ($_deleted)
		{
			$database->delete('problemes_technique', array("id" => $this->_id));
		}	
		else if ($database->count('problemes_technique', array("id" => $this->_id))) // Existe en db, on update
		{
			$database->update('problemes_technique', array("id" => $this->_id), array("idUsers" => $this->_idUser, "time_start" => $this->_timeCreated, "time_estimated" => $this->_timeEstimated, "description" => $this->_description, "isBungalow" => $this->_isBungalow, "solved" => $this->_solved));
		}
		else
		{
			$database->create('problemes_technique', array("id" => $this->_id, "idUsers" => $this->_idUser, "time_start" => $this->_timeCreated, "time_estimated" => $this->_timeEstimated, "description" => $this->_description, "isBungalow" => $this->_isBungalow, "solved" => $this->_solved));
		}
	}
	function getId(){
		return $this->_id;
	}
	function getIdUser(){
		return $this->_idUser;
	}
	function getTimeCreated(){
		return $this->_timeCreated;
	}
	function getTimeEstimated(){
		return $this->_timeEstimated;
	}
	function getDescription(){
		return $this->_description;
	}
	function getIsBungalow(){
		return $this->_isBungalow;
	}
	function getSolved(){
		return $this->_solved;
	}
	function getDeleted(){
		return $this->_deleted;
	}
	function setId($id){
		$this->_id=$id;
	}
	function setIdUsers($idUsers){
		$this->_idUser=$idUsers;
	}
	function setTimeCreated($timeCreated){
		$this->_timeCreated=$timeCreated;
	}
	function setTimeEstimated($timeEstimated){
		$this->_timeEstimated=$timeEstimated;
	}
	function setDescription($description){
		$this->_description=$description;
	}
	function setIsBungalow($isBungalow){
		$this->_isBungalow=$isBungalow;
	}
	function setSolved($solved){
		$this->_solved=$solved;
	}
	function setDeleted($deleted){
		$this->_deleted=$deleted;
	}
}
?>