<?php 
require_once("database.class.php");
//classe du type Activité

class Activite
{
	private $_id;
	private $_timeStart; 
	private $_duree;
	private $_nom;
	private $_descriptif;
	private $_ageMin;
	private $_ageMax;
	private $_idLieu;
	private $_lieu;
	private $_type;
	private $_placesLim;
	private $_prix;
	private $_idOwner;
	private $_points;	
	private $_mustBeReserved;
	private $_deleted;
	/*données : 
	-id : Int => clef primaire 
	-timeStart : Int => secondes   
	-descriptif : String => description de l'activité 
	-durée : Int => temps en min 
	-catégorie : String (enum) : genre de l'activité (sportive, intellectuelle ...) : 
	-ageMin : Int => age minimum pour participer à l'activité 
	-ageMax : Int => age maximum pour participer à l'activité 
	-idLieu : Int => id du lieu si celui ci existe dans la base de données 
	-lieu : String => lieu de l'activité (dans le camping ou à l'extérieur)
	-type : String => type de l'activite ( sportif, intellectuel, jeux ..)
	-dateLim : (type=réservable) date  => date et heure limite pour la réservation de l'activité 
	-placesLim : (type=réservable) Int  => nombre de places limites réservables 
	-prix : (type= payante) float => prix par personnes de l'activité 
	-idPart : (type = partenariat) Int => Id du partenaire associé à l'activité 
	_mustBeReserved : (type = boolean) => 1 il faut réserver, sinon pas besoin
	*/
	public function __construct($id, $timeStart=NULL, $nom=NULL, $descriptif=NULL, $duree=NULL, $ageMin=NULL, $ageMax=NULL, $lieu=NULL, $idLieu=NULL, $type=NULL, $placesLim=NULL, $prix=NULL, $idOwner=NULL, $points=NULL, $mustBeReserved=NULL) {
		$this->_id = $id;
		if ($id==NULL)
		{
			$this->_timeStart = $timeStart;
			$this->_nom = $nom;
			$this->_descriptif = $descriptif;
			$this->_duree = $duree;
			$this->_ageMin =  $ageMin;
			$this->_ageMax =  $ageMax;
			$this->_lieu =  $lieu;
			$this->_idLieu = $idLieu;
			$this->_type = $type;
			$this->_placesLim =  $placesLim;
			$this->_prix =  $prix;
			$this->_idOwner = $idOwner;
			$this->_points = $points;
			$this->_mustBeReserved = $mustBeReserved;
		}
		else
		{
			$database = new Database();
			$database->select('activites', array("id" => $id));
			$data=$database->fetch();
			$this->_timeStart = $data['time_start'];
			$this->_nom = $data['nom'];
			$this->_descriptif = $data['description'];
			$this->_duree = $data['duree'];
			$this->_ageMin =  $data['ageMin'];
			$this->_ageMax =  $data['ageMax'];
			$this->_lieu =  $data['lieu'];
			$this->_idLieu = $data['idLieu'];
			$this->_type = $data['type'];
			$this->_placesLim =  $data['capaciteMax'];
			$this->_prix =  $data['prix'];
			$this->_idOwner = $data['idOwner'];
			$this->_points = $data["points"];
			$this->_mustBeReserved = $data["mustBeReserved"];
		}
		$this->_deleted=false;
	}
	public function saveToDb(){
		$database = new Database();
		if ($this->deleted)
		{
			$database->delete('activites', array("id" => $this->_id));
		}	
		else if ($this->_id!=NULL && $database->count('activites', array("id" => $this->_id))) //Id non null et Existe en db, on update
		{
			$database->update('activites', array("id" => $this->_id), array("mustBeReserved" => $this->_mustBeReserved, "time_start" => $this->_timeStart, "duree" => $this->_duree, "nom" => $this->_nom, "description" => $this->_descriptif, "type" => $this->_type, "lieu" => $this->_lieu, "points" => $this->_points, "prix" => $this->_prix, "ageMin" => $this->_ageMin, "ageMax" => $this->_ageMax, "capaciteMax" => $this->_placesLim, "idDirigeant" => $this->_idOwner));
		}
		else
		{
			$database->create('activites', array("id" => $this->_id, "mustBeReserved" => $this->_mustBeReserved, "time_start" => $this->_timeStart, "duree" => $this->_duree, "nom" => $this->_nom, "description" => $this->_descriptif, "type" => $this->_type, "lieu" => $this->_lieu, "points" => $this->_points, "prix" => $this->_prix, "ageMin" => $this->_ageMin, "ageMax" => $this->_ageMax, "capaciteMax" => $this->_placesLim, "idDirigeant" => $this->_idOwner));
		} 
	}
	public function getId() {
	   return $this->_id;
	}
	public function getDate() {
	   return $this->_date;
	}
	public function getNom() {
	   return $this->_nom;
	}
	public function getDescriptif() {
	   return $this->_descriptif;
	}
	public function getDuree() {
	   return $this->_duree;
	}
	public function getCategorie() {
	   return $this->_categorie;
	}
	public function getAgeMin() {
	   return $this->_ageMin;
	}
	public function getAgeMax() {
	   return $this->_ageMax;
	}
	public function getLieu() {
	   return $this->_lieu;
	}
	public function getIdLieu(){
		return $this->_idLieu;
	}
	public function getType() {
	   return $this->_type;
	}
	public function getDateLim() {
	   return $this->_dateLim;
	}
	public function getPlacesLim() {
	   return $this->_placesLim;
	}
	public function getPrix() {
	   return $this->_prix;
	}
	public function getIdPart() {
	   return $this->_idPart;
	}
	public function getDeleted(){
		return $this->_deleted;
	}
	public function getMustBeReserved(){
		return $this->_mustBeReserved;
	}
	public function setId($id) {
	   $this->_id = $id;
	}
	public function setDate($date) {
	   $this->_date = $date;
	}
	public function setNom($nom) {
	   $this->_nom = $nom;
	}
	public function setDescriptif($descriptif) {
	   $this->_descriptif = $descriptif;
	}
	public function setDuree($duree) {
	   $this->_duree = $duree;
	}
	public function setCategorie($categorie) {
	   $this->_categorie = $categorie;
	}
	public function setAgeMin($ageMin) {
	   $this->_ageMin = $ageMin;
	}
	public function setAgeMax($ageMax) {
	   $this->_ageMax = $ageMax;
	}
	public function setLieu($lieu) {
	   $this->_lieu = $lieu;
	}
	public function setIdLieu($idLieu){
		$this->_idLieu = $idLieu;
	}
	public function setType($type) {
	   $this->_type = $type;
	}
	public function setDateLim($dateLim) {
	   $this->_dateLim = $dateLim;
	}
	public function setPlacesLim($placesLim) {
	   $this->_placesLim = $placesLim;
	}
	public function setPrix($prix) {
	   $this->_prix = $prix;
	}
	public function setIdPart($idPart) {
	   $this->_idPart = $idPart;
	}
	public function setDeleted($deleted){
		$this->_deleted=$deleted;
	}
	public function setMustBeReserved($mbr){
		$this->_mustBeReserved=$mbr;
	}
}
?>