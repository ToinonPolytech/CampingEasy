<?php
require("database.class.php");

class Reservation {
	private $_idActivite;
	private $_idUser;
	private $_idEquipe;
	private $_nbrPersonne;
	private $_deleted;
	function __construct($idActivite, $idUser, $idEquipe, $nbrPersonne){
		$this->_idActivite=$idActivite;
		$this->_idUser=$idUser;
		$this->_idEquipe=$idEquipe;
		$this->_nbrPersonne=$nbrPersonne;
		$this->_deleted=false;
	}
	function __construct($idActivite, $idUser){
		$database = new Database();
		$database->select('reservation', array("idActivite" => $idActivite, "idUser" => $idUser));
		$data=$database->fetch();
		$this->_idActivite=$idActivite;
		$this->_idUser=$idUser;
		$this->_idEquipe=$data["idEquipe"];
		$this->_nbrPersonne=$data["nbrPersonne"];
		$this->_deleted=false;
	}
    function getIdActivites() {
        return $this->_idActivite;
    }
    function getIdUser() {
        return $this->_idUser;
    }
    function getIdEquipe() {
        return $this->_idEquipe;
    }
    function getNbrPersonne() {
        return $this->_nbrPersonne;
    }
	function getDeleted(){
		return $this->_deleted;
	}
	function setIdActivites($idActivite) {
        $this->_idActivite=$idActivite;
    }
    function setIdUser($idUser) {
        $this->_idUser=$idUser;
    }
    function setIdEquipe($idEquipe) {
        $this->_idEquipe=$idEquipe;
    }
    function setNbrPersonne($nbrPersonne) {
        $this->_nbrPersonne=$nbrPersonne;
    }
	function setDeleted($deleted){
		$this->_deleted=$deleted;
	}
}


?>