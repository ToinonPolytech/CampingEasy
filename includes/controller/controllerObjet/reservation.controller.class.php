<?php 
require_once("../../modele/database.class.php");
require_once("../../modele/reservation.class.php");

class Controller_Reservation
{
	private $_reservation;
	public function __construct ($reservation){
		$this->_reservation=$reservation;
	}
	public function isGood(){
		return ($this->idActivitesIsGood() && $this->idUserIsGood() && $this->idEquipeIsGood() && $this->nbrPersonneIsGood());
	}
	public function idActivitesIsGood(){
		if (!empty($_reservation->getIdActivite()))
		{
			if (is_numeric($_reservation->getIdActivite()))
			{
				$database=new Database();
				if ($database->count('activities', array("id" => $_reservation->getIdActivite()))==1)
					return true;
				else
					echo "ERREUR : L'activité n'existe pas.";
			}
			else
				echo "ERREUR : L'activité n'est pas valide.";
		}
		else
			echo "ERREUR : Vous devez sélectionner une activité.";
		
		return false;
	}
	public function idUserIsGood(){
		if (!empty($_reservation->getIdUser()))
		{
			if (is_numeric($_reservation->getIdUser()))
			{
				$database=new Database();
				if ($database->count('users', array("id" => $_reservation->getIdUser()))==1)
					return true;
				else
					echo "ERREUR : Le client n'existe pas.";
			}
			else
				echo "ERREUR : Le client n'est pas valide.";
		}
		else
			echo "ERREUR : Vous devez être connecté / Le client sélectionné doit être valide.";
		
		return false;
	}
	public function idEquipeIsGood(){
		if (!empty($_reservation->idEquipe()))
		{
			$database=new Database();
			if ($_reservation->getIdEquipe()==0 || $database->count('equipe', array("id" => $_reservation->getIdActivite()))==1)
				return true;
			else
				echo "ERREUR : Ce groupe n'existe pas.";
		}
		else
			echo "ERREUR : Vous devez indiquer un groupe ou si vous vous inscrivez tout seul.";

		return false;
	}
	public function nbrPersonneIsGood(){
		if (!empty($_reservation->getNbrPersonne()))
		{
			if (is_numeric($_reservation->getNbrPersonne()) && $_reservation->getNbrPersonne()>0 && $_reservation->getNbrPersonne()<15)
				return true;
			else
				echo "ERREUR : Vous devez rentrer un nombre de personnes entre 1 et 14 pour la réservation.";
		}
		else
			echo "ERREUR : Vous devez indiquer pour combien vous réservez.";
		
		return false;
	}
}
?>