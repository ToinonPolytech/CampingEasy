<?php
require_once("database.class.php");
class Equipe {
	private $_id;
	private $_nom;
	private $_score;
	private $_deleted;
	function __construct($id, $nom=NULL, $score=NULL){
		$this->_id=$id;
		if ($id==NULL)
		{
			$this->_nom=$nom;
			$this->_score=$score;
		}
		else
		{
			$database = new Database();
			$database->select('equipe', array("id" => $id));
			$data=$database->fetch();
			$this->_nom=$data["nom"];
			$this->_score=$data["score"];
		}
		$this->_deleted=false;
	}
	function saveToDb(){
		$database = new Database();
		if ($_deleted)
		{
			$database->delete('equipe', array("id" => $this->_id));
		}	
		else if ($this->_id!=NULL && $database->count('equipe', array("id" => $this->_id))) // Existe en db, on update
		{
			$database->update('equipe', array("id" => $this->_id), array("nom" => $this->_nom, "score" => $this->_score));
		}
		else
		{
			$database->create('equipe', array("id" => $this->_id, "nom" => $this->_nom, "score" => $this->_score));
		}
		return true;
	}
	function getId() {
		return $this->_id;
	}
	function getNom() {
		return $this->_nom;
	}
	function getScore() {
		return $this->_score;
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
	function setScore($score) {
		$this->_score = $score;
	}
	function setDeleted($deleted){
		$this->_deleted=$deleted;
	}
}
?>