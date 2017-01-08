<?php
require("database.class.php");


class LieuCommun {
/* 
données : 
 * -id : Int => clef primaire 
 * -nom : String => nom
 * -desc : String => description
 */
	private $_id;
	private $_nom;
	private $_description; 
	
	function __construct($id, $nom, $description){
		$_id=$id;
		$_nom=$nom;
		$_description=$description;
	}
	function __construct($id){
		$database = new Database();
		$database->select('lieu_commun', array("id" => $id));
		$data=$database->fetch();
		$_id=$id;
		$_nom=$data["nom"];
		$_description=$data["description"];
	}
	function saveToDb(){
		$database = new Database();
		if ($database->count('lieu_commun', array("id" => $this->_id))) // Existe en db, on update
		{
			$database->update('lieu_commun', array("id" => $this->_id), array("nom" => $this->_nom, "description" => $this->_description));
		}
		else
		{
			$database->create('lieu_commun', array("id" => $this->_id, "nom" => $this->_nom, "description" => $this->_description));
		}
	}
	function getId() {
		return $this->_id;
	}
	function getNom() {
		return $this->_nom;
	}
	function getDescription() {
		return $this->_description;
	}
	function setId($id) {
		$this->_id = $id;
	}
	function setNom($nom) {
		$this->_nom = $nom;
	}
	function setDescription($description) {
		$this->_description = $description;
	}  
}