<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
require_once(i("database.class.php"));
//classe du type Activité

class Activite
{
	private $_id;
	private $_timeStart; 
	private $_duree;
	private $_nom;
	private $_descriptif;
	private $_lieu;
	private $_type;
	private $_placesLim;
	private $_prix;
	private $_idOwner;
	private $_points;	
	private $_mustBeReserved;
	private $_debutReservation;
	private $_finReservation;
	private $_photos;
	private $_deleted;
	/*données : 
		-id : Int => clef primaire 
		-timeStart : Int => secondes   
		-descriptif : String => description de l'activité 
		-durée : Int => temps en min 
		-catégorie : String (enum) : genre de l'activité (sportive, intellectuelle ...) : 
		-ageMin : Int => age minimum pour participer à l'activité 
		-ageMax : Int => age maximum pour participer à l'activité 
		-lieu : String => lieu de l'activité (dans le camping ou à l'extérieur)
		-type : String => type de l'activite ( sportif, intellectuel, jeux ..)
		-dateLim : (type=réservable) date  => date et heure limite pour la réservation de l'activité 
		-placesLim : (type=réservable) Int  => nombre de places limites réservables 
		-prix : (type= payante) float => prix par personnes de l'activité 
		-idPart : (type = partenariat) Int => Id du partenaire associé à l'activité 
		-mustBeReserved : (type = boolean) => 1 il faut réserver, sinon pas besoin
	*/
	public function __construct($id, $timeStart=NULL, $nom=NULL, $descriptif=NULL, $duree=NULL, $lieu=NULL, $type=NULL, $placesLim=NULL, $prix=NULL, $idOwner=NULL, $points=NULL, $mustBeReserved=NULL, $debutReservation=NULL, $finReservation=NULL, $photos=NULL) {
		$this->_id = $id;
		if ($id==NULL)
		{	
			$this->_timeStart = $timeStart;
			$this->_nom = $nom;
			$this->_descriptif = $descriptif;
			$this->_duree = $duree;
			$this->_lieu =  $lieu;
			$this->_type = $type;
			$this->_placesLim =  $placesLim;
			$this->_prix =  $prix;
			$this->_idOwner = $idOwner;
			$this->_points = $points;
			$this->_mustBeReserved = $mustBeReserved;
			$this->_debutReservation = $debutReservation;
			$this->_finReservation = $finReservation;
			$this->_photos = $photos;
		}
		else
		{
			$database = new Database();
			$database->select('activities', array("id" => $id));
			$data=$database->fetch();
			$this->_timeStart = $data['time_start'];
			$this->_nom = $data['nom'];
			$this->_descriptif = $data['description'];
			$this->_duree = $data['duree'];
			$this->_lieu =  $data['lieu'];
			$this->_type = $data['type'];
			$this->_placesLim =  $data['capaciteMax'];
			$this->_prix =  $data['prix'];
			$this->_idOwner = $data['idDirigeant'];
			$this->_points = $data["points"];
			$this->_mustBeReserved = $data["mustBeReserved"];
			$this->_debutReservation = $data["debutReservation"];
			$this->_finReservation = $data["finReservation"];
			$this->_photos = $data["photos"];
		}
		$this->_deleted=false;
	}
	public function saveToDb(){
		$database = new Database();
		if ($this->_deleted)
		{
			$database->delete('activities', array("id" => $this->_id));
		}	
		else if ($this->_id!=NULL && $database->count('activities', array("id" => $this->_id))) //Id non null et Existe en db, on update
		{
			$database->update('activities', array("id" => $this->_id), array("debutReservation" => $this->_debutReservation, "finReservation" => $this->_finReservation, "photos" => $this->_photos, "mustBeReserved" => $this->_mustBeReserved, "time_start" => $this->_timeStart, "duree" => $this->_duree, "nom" => $this->_nom, "description" => $this->_descriptif, "type" => $this->_type, "lieu" => $this->_lieu, "points" => $this->_points, "prix" => $this->_prix, "capaciteMax" => $this->_placesLim, "idDirigeant" => $this->_idOwner));
		}
		else
		{
			$database->create('activities', array("debutReservation" => $this->_debutReservation, "finReservation" => $this->_finReservation, "photos" => $this->_photos, "id" => $this->_id, "mustBeReserved" => $this->_mustBeReserved, "time_start" => $this->_timeStart, "duree" => $this->_duree, "nom" => $this->_nom, "description" => $this->_descriptif, "type" => $this->_type, "lieu" => $this->_lieu, "points" => $this->_points, "prix" => $this->_prix, "capaciteMax" => $this->_placesLim, "idDirigeant" => $this->_idOwner));
		} 
	}
	public function getId() {
	   return $this->_id;
	}
	public function getDate() {
	   return $this->_timeStart;
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
	public function getLieu() {
	   return $this->_lieu;
	}
	public function getPoints(){
		return $this->_points;
	}
	public function getType() {
	   return $this->_type;
	}
	public function getPlacesLim() {
	   return $this->_placesLim;
	}
	public function getPrix() {
	   return $this->_prix;
	}
	public function getIdOwner() {
	   return $this->_idOwner;
	}
	public function getDeleted(){
		return $this->_deleted;
	}
	public function getMustBeReserved(){
		return $this->_mustBeReserved;
	}
	public function getDebutReservation() {
	   return $this->_debutReservation;
	}
	public function getFinReservation(){
		return $this->_finReservation;
	}
	public function getPhotos(){
		return $this->_photos;
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
	public function setLieu($lieu) {
	   $this->_lieu = $lieu;
	}
	public function setIdLieu($idLieu){
		$this->_idLieu = $idLieu;
	}
	public function setPoints($points){
		
		$this->_points=$points;
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
	public function setDebutReservation($debutR) {
	   $this->_debutReservation = $debutR;
	}
	public function setFinReservation($finR){
		$this->_finReservation=$finR;
	}
	public function setPhotos($photos){
		$this->_photos=$photos;
	}
}
?>