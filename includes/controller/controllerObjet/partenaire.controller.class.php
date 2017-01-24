<?php 
require("../../modele/database.class.php");
require("../../modele/partenaire.class.php");



class Controller_Partenaire
{
	private $_partenaire;
	function __construct Controller_Partenaire($partenaire){
		$this->_partenaire=$partenaire;
	}
	function isGood(){
		return (nomIsGood() && libelleIsGood() && mailIsGood() && siteWebIsGood() && telephoneIsGood());
	}
	function nomIsGood(){
		return(!empty(_partenaire->getNom()) && (strlen(_partenaire->getNom())<40) &&
		strlen(_partenaire->getNom())>3);
		
	}
	function libelleIsGood(){
		return(!empty(_partenaire->getLibelle()) && (strlen(_partenaire->getLibelle())>20)
		&& strlen(_partenaire->getLibelle())<300);
	}
	function mailIsGood(){
		return (!empty(_partenaire->getMail()); //manque reg exp pour le format du mail 
	}
	function siteWebIsGood(){
		return (true); //manque le regexp pour le format de l'adresse web 
		//pas de vérification du vide car ce champ peut être null 
	}
	function telephoneIsGood(){
		return (); //manque regexp pour format du numéro de téléphone 
	}
}
?>