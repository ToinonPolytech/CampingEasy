 <?php
require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
require_once(i("database.class.php"));

class Equipe_Membres {
	private $_idEquipe;
	private $_idUser;

	public function __construct($idEquipe,$idUser,$deleted=false){
		$this->_idEquipe=$idEquipe;
		$this->_idUser=$idUser;
		$this->_deleted=$deleted; 
		
	}
	public function saveToDb(){
		$database = new Database();
		if ($this->_deleted)
		{
			$database->delete('equipe_membres', array("idEquipe" => $this->_idEquipe, "idUser" => $this->_idUser));
		}	
		else if($database->count('equipe_membres', array("idEquipe" => $this->_idEquipe, "idUser" => $this->_idUser))) // Existe en db, on update
		{
			$database->update('equipe_membres', array("idEquipe" => $this->_idEquipe, "idUser" => $this->_idUser));
		}
		else
		{
			$database->create('equipe_membres', array("idEquipe" => $this->_idEquipe, "idUser" => $this->_idUser));
		}
		return true;
	}
	public function getUser() {
		return $this->_idUser;
	}
	public function getEquipe() {
		return $this->_idEquipe;
	}
	
	public function getDeleted(){
		return $this->_deleted;
	}
	public function setUser($id) {
		$this->_idUser = $id;
	}
	public function setEquipe($id) {
		$this->_idEquipe = $id;
	}
	
	public function setDeleted($deleted){
		$this->_deleted=$deleted;
	}
}