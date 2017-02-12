<?php
require_once("database.class.php");
//Fonctions de la classe Partenaire 
class Partenaire{
	private $_id;
	private $_nom;
	private $_libelle;
	private $_mail;
	private $_siteWeb;
	private $_telephone;
	private $_deleted;
	function __construct($id, $nom=NULL, $description=NULL, $mail=NULL, $url=NULL, $telephone=NULL){
		$this->_id = $id;
		if ($id==NULL)
		{
			$this->_nom = $nom;
			$this->_libelle = $description;
			$this->_mail = $mail;
			$this->_siteWeb = $url;
			$this->_telephone = $telephone;
			$this->_deleted=false;
		}
		else
		{
			$database = new Database();
			$database->select('partenaire', array("id" => $this->_id));
			$data=$database->fetch();
			$this->_nom = $data['nom'];
			$this->_libelle = $data['description'];
			$this->_mail = $data['mail'];
			$this->_siteWeb = $data['url'];
			$this->_telephone = $data['telephone'];
			$this->_deleted=false;
		}
	}
	function saveToDb(){
		$database = new Database();
		if ($_deleted)
		{
			$database->delete('partenaire', array("id" => $this->_id));
		}	
		else if ($this->_id!=NULL && $database->count('partenaire', array("id" => $this->_id))) // Existe en db, on update
		{
			$database->update('partenaire', array("id" => $this->_id), array("nom" => $this->_nom, "description" => $this->_description, "mail" => $this->_mail, "url" => $this->_siteWeb, "telephone" => $this->_telephone));
		}
		else
		{
			$database->create('partenaire', array("id" => $this->_id, "nom" => $this->_nom, "description" => $this->_description, "mail" => $this->_mail, "url" => $this->_siteWeb, "telephone" => $this->_telephone));
		}
	}
	function getId() {
	   return $this->_id;
	}
	function getNom() {
	   return $this->_nom;
	}
	function getLibelle() {
	   return $this->_libelle;
	}
	function getMail() {
	   return $this->_mail;
	}
	function getSiteWeb() {
	   return $this->_siteWeb;
	}
	function getTelephone() {
	   return $this->_telephone;
	}
	function getDeleted(){
		return $this->_deleted;
	}
	function setId($id) {
	   $this->_id = $id;
	}
	function setNom($nom) {
	   $this->_nom = $nom;
	}
	function setLibelle($libelle) {
	   $this->_libelle = $libelle;
	}
	function setMail($mail) {
	   $this->_mail = $mail;
	}
	function setSiteWeb($siteWeb) {
	   $this->_siteWeb = $siteWeb;
	}
	function setTelephone($telephone) {
	   $this->_telephone = $telephone;
	}
	function setDeleted($deleted){
		$this->_deleted=$deleted;
	}
}









