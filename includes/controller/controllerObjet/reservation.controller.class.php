<?php 
require("../../modele/database.class.php");
require("../../modele/reservation.class.php");


class Controller_Reservation
{
	private $_reservation;
	function __construct Controller_Reservation($reservation){
		$this->_reservation=$reservation;
	}
	function isGood(){
		return (idActivitesIsGood() && idUserIsGood() && idEquipeIsGood() && nbrPersonneIsGood());
	}
	function idActivitesIsGood(){
		if (empty($_reservation->getIdActivite()))
			return false;
		
		$database=new Database();
		return ($database->count('activities', array("id" => $_reservation->getIdActivite()))==1);
	}
	function idUserIsGood(){
		if (empty($_reservation->getIdUser()))
			return false;
		
		$database=new Database();
		return ($database->count('users', array("id" => $_reservation->getIdUser()))==1);
	}
	function idEquipeIsGood(){
		if (empty($_reservation->idEquipe()))
			return false;
		
		if ($_reservation->getIdEquipe()!=0)
		{
			$database=new Database();
			return ($database->count('equipe', array("id" => $_reservation->getIdActivite()))==1);
		}
		return true;
	}
	function nbrPersonneIsGood(){ // pourquoi une expression régulière ? Pas de vérification si c'est un entier ? 
		return !(empty($_reservation->getNbrPersonne()) ||  !preg_match("#^[0-9]+{1,2}$#",$_reservation->getNbrPersonne()));
	}
}
?>