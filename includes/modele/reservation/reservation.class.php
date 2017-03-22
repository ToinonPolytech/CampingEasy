<?php
require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
require_once(i("database.class.php"));
class Reservation {
	private $_id;
	private $_type;
	private $_idUser;
	private $_time;
	private $_idEquipe;
	private $_nbrPersonne;
	private $_deleted;
	public function __construct($id, $type, $idUser,$idEquipe=NULL, $nbrPersonne=NULL, $time=NULL){
		$this->_id=$id;
		$this->_idUser=$idUser;
		$this->_type=$type;
		
		if ($time!=NULL && $nbrPersonne!=NULL)
		{	
			$this->_idEquipe=$idEquipe;
			$this->_nbrPersonne=$nbrPersonne;
			$this->_time=$time;
		}
		else
		{
			$database = new Database();
			$database->select('reservation', array("id" => $id, "type" => $type, "idUser" => $idUser));
			$data=$database->fetch();
			$this->_idEquipe=$data["idEquipe"];
			$this->_nbrPersonne=$data["nbrPersonne"];
			$this->_time=$data["time"];
		}
		$this->_deleted=false;
	}
	public function saveToDb(){
		$database = new Database();
		if ($this->_deleted)
		{
			$database->delete('reservation', array("id" => $this->_id, "type" => $this->_type, "idUser" => $this->_idUser));
		}	
		else if ($database->count('reservation', array("id" => $this->_id, "type" => $this->_type, "idUser" => $this->_idUser))) // Existe en db, on update
		{
			$database->update('reservation', array("id" => $this->_id, "time" => $this->_time, "type" => $this->_type, "idUser" => $this->_idUser), array("idEquipe" => $this->_idEquipe, "nbrPersonne" => $this->_nbrPersonne));
		}
		else
		{
			$database->create('reservation', array("id" => $this->_id, "time" => $this->_time, "type" => $this->_type, "idUser" => $this->_idUser, "idEquipe" => $this->_idEquipe, "nbrPersonne" => $this->_nbrPersonne));
		}
	}
    public function getId() {
        return $this->_id;
    }
    public function getIdUser() {
        return $this->_idUser;
    }
    public function getIdEquipe() {
        return $this->_idEquipe;
    }
	public function getType() {
        return $this->_type;
    }
    public function getNbrPersonne() {
        return $this->_nbrPersonne;
    }
	public function getDeleted(){
		return $this->_deleted;
	}
	public function getTime(){
		return $this->_time;
	}
	public function setId($id) {
        $this->_id=$id;
    }
	public function setType($type) {
        $this->_type=$type;
    }
    public function setIdUser($idUser) {
        $this->_idUser=$idUser;
    }
    public function setIdEquipe($idEquipe) {
        $this->_idEquipe=$idEquipe;
    }
    public function setNbrPersonne($nbrPersonne) {
        $this->_nbrPersonne=$nbrPersonne;
    }
	public function setDeleted($deleted){
		$this->_deleted=$deleted;
	}
	public function setTime($time){
		$this->_time=$time;
	}
}
?>