<?php
require_once("database.class.php");
class PbTechInfo{
	private $_id;    // clé primaire
	private $_idPbTech;    // id probleme technique
	private $_idUser;  // id technicien
	private $_time;  // timestamp de l'entrée
	private $_message; // timestamp de quand le problème devrait être résolu
	private $_deleted; // true si on doit supprimer, false sinon
	public function __construct($idPbTech, $idUser, $time, $message) {
		$this->_id = NULL;
		$this->_idPbTech=$idPbTech;
		$this->_idUser=$idUser;
		$this->_time=$time;
		$this->_message=$message;
		$this->_deleted=false;
	}
	public function __construct($id) {
		$database = new Database();
		$database->select('problemes_technique_info', array("id" => $id));
		$data=$database->fetch();
		$this->_id = $id;
		$this->_idPbTech=$data["idPbTech"];
		$this->_idUser=$data["idUser"];
		$this->_time=$data["time"];
		$this->_message=$data["message"];
		$this->_deleted=false;
	}
	public function saveToDb(){
		$database = new Database();
		if ($_deleted)
		{
			$database->delete('problemes_technique_info', array("id" => $this->_id));
		}	
		else if ($this->_id!=NULL && $database->count('problemes_technique_info', array("id" => $this->_id))) // Existe en db, on update
		{
			$database->update('problemes_technique_info', array("id" => $this->_id), array("idPbTech" => $this->_idPbTech, "idUser" => $this->_idUser, "time" => $this->_time, "message" => $this->_message));
		}
		else
		{
			$database->create('problemes_technique_info', array("id" => $this->_id, "idPbTech" => $this->_idPbTech, "idUser" => $this->_idUser, "time" => $this->_time, "message" => $this->_message));
		}
	}
	public function getId(){
		return $this->_id;
	}
	public function getIdPbTech(){
		return $this->_idPbTech;
	}
	public function getIdUser(){
		return $this->_idUser;
	}
	public function getTime(){
		return $this->_time;
	}
	public function getMessage(){
		return $this->_message;
	}
	public function getDeleted(){
		return $this->_deleted;
	}
	public function setId($id){
		$this->_id=$id;
	}
	public function setIdPbTech($idPbTech){
		$this->_idPbTech=$idPbTech;
	}
	public function setIdUser($idUser){
		$this->_idUser=$idUser;
	}
	public function setTime($time){
		$this->_time=$time;
	}
	public function setMessage($message){
		$this->_message=$message;
	}
	public function setDeleted($deleted){
		$this->_deleted=$deleted;
	}
}
?>