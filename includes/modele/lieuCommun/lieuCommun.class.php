<?php
require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
require_once(i("database.class.php"));
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
	private $_deleted;
	
	public function __construct($id, $nom=NULL, $description=NULL){
		$this->_id=$id;
		if ($id==NULL)
		{
			$this->_nom=$nom;
			$this->_description=$description;
		}
		else
		{
			$database = new Database();
			$database->select('lieu_commun', array("id" => $id));
			$data=$database->fetch();
			$this->_nom=$data["nom"];
			$this->_description=$data["description"];
			$this->_deleted=false;
		}
		$this->_deleted=false;
	}
	public function saveToDb(){
		$database = new Database();
		if ($this->_deleted)
		{
			$database->delete('lieu_commun', array("id" => $this->_id));
		}	
		else if ($this->_id!=NULL && $database->count('lieu_commun', array("id" => $this->_id))) // Existe en db, on update
		{
			$database->update('lieu_commun', array("id" => $this->_id), array("nom" => $this->_nom, "description" => $this->_description));
		}
		else
		{
			$database->create('lieu_commun', array("id" => $this->_id, "nom" => $this->_nom, "description" => $this->_description));
		}
	}
	public function getId() {
		return $this->_id;
	}
	public function getNom() {
		return $this->_nom;
	}
	public function getDescription() {
		return $this->_description;
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
	public function setDescription($description) {
		$this->_description = $description;
	} 
	public function setDeleted($deleted){
		$this->_deleted=$deleted;
	}
}