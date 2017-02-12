<?php
require_once("database.class.php");
class Equipe {
	private $_id;
	private $_nom;
	private $_score;
	private $_deleted;
	public function __construct($id, $nom=NULL, $score=NULL){
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
	public function saveToDb(){
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
	public function getId() {
		return $this->_id;
	}
	public function getNom() {
		return $this->_nom;
	}
	public function getScore() {
		return $this->_score;
	}
	public function getDeleted(){
		return $this->_deleted;
	}
	public function setId($id) {
		$this->_id = $id;
	}
	public function setNom($nom) {
		$this->_nom = $nom;
	}
	public function setScore($score) {
		$this->_score = $score;
	}
	public function setDeleted($deleted){
		$this->_deleted=$deleted;
	}
}
?>