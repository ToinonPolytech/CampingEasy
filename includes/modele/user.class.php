<?php 
require("database.class.php");
require("../controller/controllerObjet/user.controller.class.php");
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
	
	function __construct($id, $infoId, $accessLevel, $droits, $nom, $prenom, $code){
		$this->_id=$id;
		$this->_infoId=$infoId;
		$this->_accessLevel=$accessLevel;
		$this->_droits=$droits;
		$this->_nom=$nom;
		$this->_prenom=$prenom;
		$this->_code=$code;
		$this->_deleted=false;
	}
	
	function __construct($id){
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
	function saveToDb(){
		$controller=new Controller_User($this);
		if ($controller->isGood()){
			$database = new Database();
			if ($_deleted)
			{
				$database->delete('users', array("id" => $this->_id));
			}	
			else if ($database->count('users', array("id" => $this->_id))) // Existe en db, on update
			{
				$database->update('users', array("id" => $this->_id), array("infoId" => $this->_infoId, "access_level" => $this->_accessLevel, "droits" => $this->_droits, "nom" => $this->_nom, "prenom" => $this->_prenom, "code" => $this->_code));
			}
			else
			{
				$clef=$controller->generateKey();
				$database->create('users', array("clef" => $clef, "id" => $this->_id), array("infoId" => $this->_infoId, "access_level" => $this->_accessLevel, "droits" => $this->_droits, "nom" => $this->_nom, "prenom" => $this->_prenom, "code" => $this->_code));
			}
			return true;
		}
		return false;
	}
	function addDroits($which){
		$controller= new Controller_User($this);
		if (!$controller->can($which)) // Si le droit n'est pas déjà activé
			$this->_droits+=pow(2,$which); // on lui rajoute
	}
	function getUserInfos(){
		$userInfo = new UserInfos($this->_infoId);
		return $userInfo;
	}
	function getId(){
		return $this->_id;
	}
	function getInfoId(){
		return $this->_infoId;
	}
	function getAccessLevel(){
		return $this->_accessLevel;
	}
	function getDroits(){
		return $this->_droits;
	}
	function getNom(){
		return $this->_nom;
	}
	function getPrenom(){
		return $this->_prenom;
	}
	function getCode(){
		return $this->_code;
	}
	function getDeleted(){
		return $this->_deleted;
	}
	function setId($id){
		$this->_id=$id;
	}
	function setInfoId($infoId){
		$this->_infoId=$infoId;
	}
	function setAccessLevel($accessLevel){
		$this->_accessLevel=$accessLevel;
	}
	function setDroits($droits){
		$this->_droits=$droits;
	}
	function setNom($nom){
		$this->_nom=$nom;
	}
	function setPrenom($prenom){
		$this->_prenom=$prenom;
	}
	function setCode($code){
		$this->_code=$code;
	}
	function setDeleted($deleted){
		$this->_deleted=$deleted;
	}
}