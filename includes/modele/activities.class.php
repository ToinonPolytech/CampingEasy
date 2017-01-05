<?php 
require("database.class.php");
//classe du type Activité

class Activite
{
	private $_id;
	private $_date; 
	private $_nom;
	private $_descriptif;
	private $_duree;
	private $_categorie;
	private $_ageMin;
	private $_ageMax;
	private $_lieu;
	private $_type;
	private $_dateLim;
	private $_placesLim;
	private $_prix;
	private $_idPart;

	function __construct($_id) {
        $table = db.select(activite,$id);   
		$database = Database();
		$database->select('activites', array("id" => $id));

			$this->_id = $_id;
			$this->_date = $table['date'];
			$this->_nom = $table['nom'];
			$this->_descriptif = $table['descriptif'];
			$this->_duree = $table['duree'];
			$this->_categorie =  $table['categorie'];
			$this->_ageMin =  $table['ageMin'];
			$this->_ageMax =  $table['ageMax'];
			$this->_lieu =  $table['lieu'];
			$this->_type = $table['type'];
			$this->_dateLim = $table['dateLim'];
			$this->_placesLim =  $table['placesLim'];
			$this->_prix =  $table['prix'];
			$this->_idPart = $table['idPart'];
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