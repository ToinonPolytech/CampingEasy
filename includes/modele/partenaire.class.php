<?php
require("database.class.php");
//Fonctions de la classe Partenaire 

class Partenaire{
    private $_id;
    private $_nom;
    private $_libelle;
    private $_mail;
    private $_siteWeb;
    private $_telephone;
    
    /*
-id : Int => Clef primaire 
-nom : String => nom du partenaire (ex : AQUABIKE66) (NOT NULL)
-libellé : String => descriptif du partenaire (ex : Notre partenaire qui propose des cours d'aquabike deux fois par semaine dans le camping) (NOT NULL)
-mail : String => adresse mail du partenaire (NOT NULL)
-siteWeb : String => site web éventuel 
-telephone : double => téléphone éventuel 
                  
                    */
    
    
    function __construct($id, $nom, $description, $mail, $url, $telephone){         
		$this->_id = $id;
		$this->_nom = $nom;
		$this->_libelle = $description;
		$this->_mail = $mail;
		$this->_siteWeb = $url;
		$this->_telephone = $telephone;
   }
	function __construct($id){         
		$database = new Database();
		$database->select('partenaire', array("id" => $id));
		$data=$database->fetch();

		$this->_id = $id;
		$this->_nom = $data['nom'];
		$this->_libelle = $data['description'];
		$this->_mail = $data['mail'];
		$this->_siteWeb = $data['url'];
		$this->_telephone = $data['telephone'];
	}
   function getId() {
	   return $this->_id;
   }
   function getNom() {
	   return $this->_nom;
   }
   function getLibelle() {
	   return $this->_libelle;
   }
   function getMail() {
	   return $this->_mail;
   }
   function getSiteWeb() {
	   return $this->_siteWeb;
   }
   function getTelephone() {
	   return $this->_telephone;
   }
   function setId($id) {
	   $this->_id = $id;
   }
   function setNom($nom) {
	   $this->_nom = $nom;
   }
   function setLibelle($libelle) {
	   $this->_libelle = $libelle;
   }
   function setMail($mail) {
	   $this->_mail = $mail;
   }
   function setSiteWeb($siteWeb) {
	   $this->_siteWeb = $siteWeb;
   }
   function setTelephone($telephone) {
	   $this->_telephone = $telephone;
   }
}









