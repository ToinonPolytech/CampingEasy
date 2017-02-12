<?php
require_once("database.class.php");
class PbTech{
	private $_id;    // clé primaire
	private $_idUser;  // id créateur probleme
	private $_timeCreated;  // timestamp de la création
	private $_timeEstimated; // timestamp de quand le problème devrait être résoly
	private $_description; // description du probleme
	private $_isBungalow; // boolean, si le probleme se situe dans le bungalow
	private $_solved;  // ENUM{NON_RESOLU, EN_COURS, RESOLU}
	private $_deleted; // true si on doit supprimer, false sinon
	public function __construct($idUsers, $timeCreated, $timeEstimated, $description, $isBungalow) {
		$this->_id = NULL;
		$this->_idUser=$idUsers;
		$this->_timeCreated=$timeCreated;
		$this->_timeEstimated=$timeEstimated;
		$this->_description=$description;
		$this->_isBungalow=$isBungalow;
		$this->_solved="NON_RESOLU";
		$this->_deleted=false;
	}
	public function __construct($id) {
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
	public function saveToDb(){
		$database = new Database();
		if ($_deleted)
		{
			$database->delete('problemes_technique', array("id" => $this->_id));
		}	
		else if ($this->_id!=NULL && $database->count('problemes_technique', array("id" => $this->_id))) // Existe en db, on update
		{
			$database->update('problemes_technique', array("id" => $this->_id), array("idUsers" => $this->_idUser, "time_start" => $this->_timeCreated, "time_estimated" => $this->_timeEstimated, "description" => $this->_description, "isBungalow" => $this->_isBungalow, "solved" => $this->_solved));
		}
		else
		{
			$database->create('problemes_technique', array("id" => $this->_id, "idUsers" => $this->_idUser, "time_start" => $this->_timeCreated, "time_estimated" => $this->_timeEstimated, "description" => $this->_description, "isBungalow" => $this->_isBungalow, "solved" => $this->_solved));
		}
	}
	public function getId(){
		return $this->_id;
	}
	public function getIdUser(){
		return $this->_idUser;
	}
	public function getTimeCreated(){
		return $this->_timeCreated;
	}
	public function getTimeEstimated(){
		return $this->_timeEstimated;
	}
	public function getDescription(){
		return $this->_description;
	}
	public function getIsBungalow(){
		return $this->_isBungalow;
	}
	public function getSolved(){
		return $this->_solved;
	}
	public function getDeleted(){
		return $this->_deleted;
	}
	public function setId($id){
		$this->_id=$id;
	}
	public function setIdUsers($idUsers){
		$this->_idUser=$idUsers;
	}
	public function setTimeCreated($timeCreated){
		$this->_timeCreated=$timeCreated;
	}
	public function setTimeEstimated($timeEstimated){
		$this->_timeEstimated=$timeEstimated;
	}
	public function setDescription($description){
		$this->_description=$description;
	}
	public function setIsBungalow($isBungalow){
		$this->_isBungalow=$isBungalow;
	}
	public function setSolved($solved){
		$this->_solved=$solved;
	}
	public function setDeleted($deleted){
		$this->_deleted=$deleted;
	}
}
?>