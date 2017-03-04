<?php
require_once("database.class.php");
class Reservation {
	private $_idActivite;
	private $_idUser;
	private $_idEquipe;
	private $_nbrPersonne;
	private $_deleted;
	public function __construct($idActivite, $idUser, $idEquipe=NULL, $nbrPersonne=NULL){
		$this->_idActivite=$idActivite;
		$this->_idUser=$idUser;
		if ($idActivite==NULL && $idUser==NULL)
		{
			$this->_idEquipe=$idEquipe;
			$this->_nbrPersonne=$nbrPersonne;
		}
		else
		{
			$database = new Database();
			$database->select('reservation', array("idActivite" => $idActivite, "idUser" => $idUser));
			$data=$database->fetch();
			$this->_idEquipe=$data["idEquipe"];
			$this->_nbrPersonne=$data["nbrPersonne"];
		}
		$this->_deleted=false;
	}
	public function saveToDb(){
		$database = new Database();
		if ($this->_deleted)
		{
			$database->delete('reservation', array("idActivite" => $this->_idActivite, "idUser" => $this->_idUser));
		}	
		else if ($database->count('reservation', array("idActivite" => $this->_idActivite, "idUser" => $this->_idUser))) // Existe en db, on update
		{
			$database->update('reservation', array("idActivite" => $this->_idActivite, "idUser" => $this->_idUser), array("idEquipe" => $this->_idEquipe, "nbrPersonne" => $this->_nbrPersonne));
		}
		else
		{
			$database->create('reservation', array("idActivite" => $this->_idActivite, "idUser" => $this->_idUser, "idEquipe" => $this->_idEquipe, "nbrPersonne" => $this->_nbrPersonne));
		}
	}
    public function getIdActivites() {
        return $this->_idActivite;
    }
    public function getIdUser() {
        return $this->_idUser;
    }
    public function getIdEquipe() {
        return $this->_idEquipe;
    }
    public function getNbrPersonne() {
        return $this->_nbrPersonne;
    }
	public function getDeleted(){
		return $this->_deleted;
	}
	public function setIdActivites($idActivite) {
        $this->_idActivite=$idActivite;
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
}
?>