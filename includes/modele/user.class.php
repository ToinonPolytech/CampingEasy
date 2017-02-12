<?php 
require_once("database.class.php");
/**
	Cette classe permet juste de définir celle de Client et Staff, on ne l'utilisera jamais
**/
abstract class User
{
	protected $_id;
	protected $_infoId;
	protected $_accessLevel;
	protected $_droits;
	protected $_nom;
	protected $_prenom;
	protected $_code;
	protected $_deleted;
	
	public function __construct($infoId, $accessLevel, $droits, $nom, $prenom, $code){
		$this->_id=NULL;
		$this->_infoId=$infoId;
		$this->_accessLevel=$accessLevel;
		$this->_droits=$droits;
		$this->_nom=$nom;
		$this->_prenom=$prenom;
		$this->_code=$code;
		$this->_deleted=false;
	}
	
	public function __construct($id){
		$database = new Database();
		$database->select('users', array("id" => $id));
		$data=$database->fetch();
		$this->_id=$id;
		$this->_infoId=$data["infoId"];
		$this->_accessLevel=$data["access_level"];
		$this->_droits=$data["droits"];
		$this->_nom=$data["nom"];
		$this->_prenom=$data["prenom"];
		$this->_code=$data["code"];
		$this->_deleted=false;
	}
	public function saveToDb(){
		$database = new Database();
		if ($_deleted)
		{
			$database->delete('users', array("id" => $this->_id));
		}	
		else if ($this->_id!=NULL && $database->count('users', array("id" => $this->_id))) // Existe en db, on update
		{
			$database->update('users', array("id" => $this->_id), array("infoId" => $this->_infoId, "access_level" => $this->_accessLevel, "droits" => $this->_droits, "nom" => $this->_nom, "prenom" => $this->_prenom, "code" => $this->_code));
		}
		else
		{
			$clef=$controller->generateKey();
			$database->create('users', array("clef" => $clef, "id" => $this->_id), array("infoId" => $this->_infoId, "access_level" => $this->_accessLevel, "droits" => $this->_droits, "nom" => $this->_nom, "prenom" => $this->_prenom, "code" => $this->_code));
		}
	}
	public function addDroits($which){
		$controller= new Controller_User($this);
		if (!$controller->can($which)) // Si le droit n'est pas déjà activé
			$this->_droits+=pow(2,$which); // on lui rajoute
	}
	public function getUserInfos(){
		$userInfo = new UserInfos($this->_infoId);
		return $userInfo;
	}
	public function getId(){
		return $this->_id;
	}
	public function getInfoId(){
		return $this->_infoId;
	}
	public function getAccessLevel(){
		return $this->_accessLevel;
	}
	public function getDroits(){
		return $this->_droits;
	}
	public function getNom(){
		return $this->_nom;
	}
	public function getPrenom(){
		return $this->_prenom;
	}
	public function getCode(){
		return $this->_code;
	}
	public function getDeleted(){
		return $this->_deleted;
	}
	public function setId($id){
		$this->_id=$id;
	}
	public function setInfoId($infoId){
		$this->_infoId=$infoId;
	}
	public function setAccessLevel($accessLevel){
		$this->_accessLevel=$accessLevel;
	}
	public function setDroits($droits){
		$this->_droits=$droits;
	}
	public function setNom($nom){
		$this->_nom=$nom;
	}
	public function setPrenom($prenom){
		$this->_prenom=$prenom;
	}
	public function setCode($code){
		$this->_code=$code;
	}
	public function setDeleted($deleted){
		$this->_deleted=$deleted;
	}
}