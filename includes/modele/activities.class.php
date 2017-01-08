<?php 
require("database.class.php");
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
	private $_lieu;
	private $_type;
	private $_placesLim;
	private $_prix;
	private $_idOwner;

	function __construct($id, $timeStart, $nom, $descriptif, $duree, $ageMin, $ageMax, $lieu, $type, $placesLim, $prix, $idOwner) {
		$this->_id = $id;
		$this->_timeStart = $timeStart;
		$this->_nom = $nom;
		$this->_descriptif = $descriptif;
		$this->_duree = $duree;
		$this->_ageMin =  $ageMin;
		$this->_ageMax =  $ageMax;
		$this->_lieu =  $lieu;
		$this->_type = $type;
		$this->_placesLim =  $placesLim;
		$this->_prix =  $prix;
		$this->_idOwner = $idOwner;
	}
	function __construct($id) {
		$database = new Database();
		$database->select('activites', array("id" => $id));
		$data=$database->fetch();
		$this->_id = $id;
		$this->_timeStart = $data['time_start'];
		$this->_nom = $data['nom'];
		$this->_descriptif = $data['description'];
		$this->_duree = $data['duree'];
		$this->_ageMin =  $data['ageMin'];
		$this->_ageMax =  $data['ageMax'];
		$this->_lieu =  $data['lieu'];
		$this->_type = $data['type'];
		$this->_placesLim =  $data['capaciteMax'];
		$this->_prix =  $data['prix'];
		$this->_idOwner = $data['idOwner'];
	}
       /*données : 
	-id : Int => clef primaire 
	-date : date => date et heure de l'activité à venir  
	-descriptif : String => description de l'activité 
	-durée : Int => temps en min 
	-catégorie : String (enum) : genre de l'activité (sportive, intellectuelle ...) : 
	-ageMin : Int => age minimum pour participer à l'activité 
	-ageMax : Int => age maximum pour participer à l'activité 
	-lieu : String => lieu de l'activité (dans le camping ou à l'extérieur)
	-type : String (enum) => réservable/payante/partenariat
	-dateLim : (type=réservable) date  => date et heure limite pour la réservation de l'activité 
	-placesLim : (type=réservable) Int  => nombre de places limites réservables 
	-prix : (type= payante) float => prix par personnes de l'activité 
	-idPart : (type = partenariat) Int => Id du partenaire associé à l'activité 
	*/
   function getId() {
	   return $this->_id;
   }
   function getDate() {
	   return $this->_date;
   }
   function getNom() {
	   return $this->_nom;
   }
   function getDescriptif() {
	   return $this->_descriptif;
   }
   function getDuree() {
	   return $this->_duree;
   }
   function getCategorie() {
	   return $this->_categorie;
   }
   function getAgeMin() {
	   return $this->_ageMin;
   }
   function getAgeMax() {
	   return $this->_ageMax;
   }
   function getLieu() {
	   return $this->_lieu;
   }
   function getType() {
	   return $this->_type;
   }
   function getDateLim() {
	   return $this->_dateLim;
   }
   function getPlacesLim() {
	   return $this->_placesLim;
   }
   function getPrix() {
	   return $this->_prix;
   }
   function getIdPart() {
	   return $this->_idPart;
   }
   function setId($id) {
	   $this->_id = $id;
   }
   function setDate($date) {
	   $this->_date = $date;
   }
   function setNom($nom) {
	   $this->_nom = $nom;
   }
   function setDescriptif($descriptif) {
	   $this->_descriptif = $descriptif;
   }
   function setDuree($duree) {
	   $this->_duree = $duree;
   }
   function setCategorie($categorie) {
	   $this->_categorie = $categorie;
   }
   function setAgeMin($ageMin) {
	   $this->_ageMin = $ageMin;
   }
   function setAgeMax($ageMax) {
	   $this->_ageMax = $ageMax;
   }
   function setLieu($lieu) {
	   $this->_lieu = $lieu;
   }
   function setType($type) {
	   $this->_type = $type;
   }
   function setDateLim($dateLim) {
	   $this->_dateLim = $dateLim;
   }
   function setPlacesLim($placesLim) {
	   $this->_placesLim = $placesLim;
   }
   function setPrix($prix) {
	   $this->_prix = $prix;
   }
   function setIdPart($idPart) {
	   $this->_idPart = $idPart;
   }
}
?>