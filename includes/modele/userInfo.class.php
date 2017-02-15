<?php 

require_once("database.class.php");
/**
	Cette classe permet juste de définir celle de Client et Staff, on ne l'utilisera jamais
**/
abstract class User
{
	protected $_numPlace;
	protected $_email;
	protected $_solde;
	protected $_timeDepart;
	protected $_clef;
	protected $_deleted;
	
	public function __construct($id, $numPlace=NULL, $email=NULL, $timeDepart=NULL, $clef=NULL){
		$this->_id=$id;
		if ($id==NULL)
		{
			$this->_numPlace=$numPlace;
			$this->_email=$email;
			$this->_timeDepart=$timeDepart;
			$this->_clef=$clef;
			
		}
		else
		{
			$database = new Database();
			$database->select('users', array("id" => $id));
			$data=$database->fetch();
			$this->_numPlace=$data["emplacement"];
			$this->_email=$data["email"];
			$this->_solde=$data["solde"];
			$this->_timeDepart=$data["time_depart"];
			$this->_clef=$data["clef"];
			
		}
		$this->_deleted=false;
	}

	public function saveToDb(){
		$database = new Database();
		if ($this->_deleted)
		{
			$database->delete('users', array("id" => $this->_id));
		}	
		else if ($this->_id!=NULL && $database->count('users', array("id" => $this->_id))) // Existe en db, on update
		{
			$database->update('users', array("id" => $this->_id), array("emplacement" => $this->_numPlace, "email" => $this->_email, "solde" => $this->_solde, "time_depart" => $this->_timeDepart, "clef" => $this->_clef));
		}
		else
		{
			$clef=$controller->generateKey();
			$database->create('users', array("clef" => $clef, "id" => $this->_id), array("emplacement" => $this->_numPlace, "email" => $this->_email, "solde" => $this->_solde, "time_depart" => $this->_timeDepart);
		}
	}
	
	
	public function getId(){
		return $this->_id;
	}
	public function getEmplacement(){
		return $this->_numPlace;
	}
	public function getEmail(){
		return $this->_email;
	}
	public function getSolde(){
		return $this->_solde;
	}
	public function getTimeDepart(){
		return $this->_timeDepart;
	}
	public function getClef(){
		return $this->_clef;
	}
	
	public function getDeleted(){
		return $this->_deleted;
	}
	public function setId($id){
		$this->_id=$id;
	}
	public function setEmplacement($emplacement){
		$this->_numPlace=$emplacement;
	}
	public function setEmail($email){
		$this->_email=$email;
	}
	public function setSolde($solde){
		$this->_solde=$solde;
	}
	public function setTimeDepart($timeDepart){
		$this->_timeDepart=$timeDepart;
	}
	public function setClef($clef){
		$this->_clef=$clef;
	}
	
	public function setDeleted($deleted){
		$this->_deleted=$deleted;
	}
}

?> 