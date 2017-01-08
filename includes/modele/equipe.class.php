<?php
require("database.class.php");


class Equipe {
/* 
données : 
 * -Id : Int => clef primaire 
 * -Nom : String => nom d'équipe 
 * -Score : Int => points de l'équipe
 * 
 */
	private $_id;
	private $_nom;
	private $_score;
	function __construct($id, $nom, $score){
		$_id=$id;
		$_nom=$nom;
		$_score=$score;
	}
	function __construct($id){
		$database = new Database();
		$database->select('equipe', array("id" => $id));
		$data=$database->fetch();
		$_id=$id;
		$_nom=$data["nom"];
		$_score=$data["score"];
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
	function setId($id) {
		$this->_id = $id;
	}
	function setNom($nom) {
		$this->_nom = $nom;
	}
	function setScore($score) {
		$this->_score = $score;
	}
}
?>