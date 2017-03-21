 <?php
require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
require_once(i("database.class.php"));
//Fonctions de la classe Restaurant
class Restaurant{
	private $_id;
	private $_nom;
	private $_description;
	private $_capacite;
	private $_hOuv;
	
	/** Ceci est une horaire d'ouverture fermé tout le temps
	0 = dimanche
	1 = lundi ect.. (c.f date("w"))
	-------------------------------
	Dans le sous-tableau, 0 = 00h, 1 = 00h30 ect... 47=23h30
	$array=array();
	for ($i=0;$i<=6;$i++)
	{
		$array[$i]=array();
		for ($j=0;$j<48;$j++)
			$array[$i][$j]=false;
	}
	$array=serialize($array);
	**/
	private $_photo;
	private $_deleted;
	public function __construct($id, $nom=NULL, $description=NULL, $capacite=NULL, $hOuv=NULL, $photo=NULL){
		$this->_id = $id;
		if ($id==NULL)
		{
			$this->_nom = $nom;
			$this->_description = $description; 
			$this->_capacite = $description;
			$this->_hOuv = $hOuv;
			$this->_photo = $photo;
		}
		else
		{
			$database = new Database();
			$database->select('restaurant', array("id" => $this->_id));
			$data=$database->fetch();
			$this->_nom = $data['nom'];
			$this->_description = $data['description']; 
			$this->_capacite = $data['description'];
			$this->_hOuv = $data['hOuv'];
			$this->_photo = $data['photo'];
		}
		$this->_deleted=false;
	}
	public function saveToDb(){
		$database = new Database();
		if ($this->_deleted)
		{
			$database->delete('restaurant', array("id" => $this->_id));
		}	
		else if ($this->_id!=NULL && $database->count('restaurant', array("id" => $this->_id))) // Existe en db, on update
		{
			$database->update('restaurant', array("id" => $this->_id), array("nom" => $this->_nom, "description" => $this->_capacite, "heureOuverture" => $this->_hOuv, "photo" => $this->_photo, "description" => $this->_description));
		}
		else
		{
			$database->create('restaurant', array("id" => $this->_id, "nom" => $this->_nom, "description" => $this->_capacite, "heureOuverture" => $this->_hOuv, "photo" => $this->_photo, "description" => $this->_description));
		}
	}
	public function getId() {
	   return $this->_id;
	}
	public function getNom() {
	   return $this->_nom;
	}
	public function getCapacite() {
	   return $this->_capacite;
	}
	public function getHeureOuverture() {
	   return $this->_hOuv;
	}
	public function getPhoto() {
	   return $this->_photo;
	}
	public function getDeleted(){
		return $this->_deleted;
	}
	public function getDescription(){
		return $this->_description;
	}
	public function setId($id) {
	   $this->_id = $id;
	}
	public function setNom($nom) {
	   $this->_nom = $nom;
	}
	public function setCapacite($capacite) {
	   $this->_capacite = $capacite;
	}
	public function setHeureOuverture($hOuv) {
	   $this->_hOuv = $hOuv;
	}
	public function setPhoto($photo) {
	   $this->_photo = $photo;
	}
	public function setDescription($description){
		$this->_description=$description;
	}
	public function setDeleted($deleted){
		$this->_deleted=$deleted;
	}
}
