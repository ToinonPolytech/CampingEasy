<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
require_once(i("database.class.php"));
require_once(i("reservation.class.php"));
require_once(i("activities.class.php"));
require_once(i("lieuCommun.class.php"));
require_once(i("user.class.php"));
class Controller_Reservation
{
	private $_reservation;
	public function __construct ($reservation){
		$this->_reservation=$reservation;
	}
	public function isGood(){
		return ($this->idIsGood() && $this->typeIsGood() && $this->idUserIsGood() /*&& $this->idEquipeIsGood()*/ && $this->nbrPersonneIsGood() && $this->reservationIsAvailable() && $this->timeIsGood());
	}
	public function timeIsGood(){
		if (!empty($this->_reservation->getTime()))
		{
			if (is_numeric($this->_reservation->getTime()))
			{
				if ($this->_reservation->getTime()>time())
					return true;
				else
					echo "ERREUR : Vous ne pouvez réserver dans le passé.";
			}
			else
				echo "ERREUR : Merci de sélectionner l'horaire pour la réservation.";
		}
		else
			echo "ERREUR : Merci de sélectionner l'horaire pour la réservation.";
		
		return false;
	}
	public function typeIsGood(){
		if(!empty($this->_reservation->getType()))
		{
			if($this->_reservation->getType()=='ACTIVITE' || $this->_reservation->getType()=='LIEU_COMMUN' 
			|| $this->_reservation->getType()=='RESTAURANT' ||$this->_reservation->getType()=='ETAT_LIEUX')
			{
				return true;
			}
			else
			{
				echo "ERREUR : le service que vous chez à réserver n'existe pas";
				
			}
		}
		else
		{
			echo "ERREUR : aucun service à réserver selectionné"; 
		}
		return false;
		
		
	}
	public function reservationIsAvailable(){
		if ($this->_reservation->getType()=="ACTIVITE")
			return $this->actIsAvailable();
		
		return false;
	}
	public function idIsGood(){
		echo $this->_reservation->getId();
		if (!empty($this->_reservation->getId()))
		{
			if (is_numeric($this->_reservation->getId()))
			{
				return true;
			}
			else
				echo "ERREUR : Le service réservé n'est pas valide.";
		}
		else
			echo "ERREUR : Vous devez sélectionner un service à réserver .";
		
		return false;
	}
	public function idUserIsGood(){
		if (!empty($this->_reservation->getIdUser()))
		{
			if (is_numeric($this->_reservation->getIdUser()))
			{
				$database=new Database();
				if ($database->count('users', array("id" => $this->_reservation->getIdUser()))==1)
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
	//Stand by pour le moment pour la réservation par équipe 
	/*public function idEquipeIsGood(){
		if (!empty($this->_reservation->idEquipe()))
		{
			$database=new Database();
			if ($this->_reservation->getIdEquipe()==0 || $database->count('equipe', array("id" => $this->_reservation->getId()))==1)
				return true;
			else
				echo "ERREUR : Ce groupe n'existe pas.";
		}
		else
			echo "ERREUR : Vous devez indiquer un groupe ou si vous vous inscrivez tout seul.";

		return false;
	}*/
	public function nbrPersonneIsGood(){
		if (!empty($this->_reservation->getNbrPersonne()))
		{
			if (is_numeric($this->_reservation->getNbrPersonne()) && $this->_reservation->getNbrPersonne()>0 && $this->_reservation->getNbrPersonne()<15)
				return true;
			else
				echo "ERREUR : Vous devez rentrer un nombre de personnes entre 1 et 14 pour la réservation.";
		}
		else
			echo "ERREUR : Vous devez indiquer pour combien vous réservez.";
		
		return false;
	}
	public function actIsAvailable(){
		$database=new Database();
		if (!$database->count('activities', array("id" => $this->_reservation->getId()))==1)
		{
			echo "ERREUR : L'activité n'existe pas.";
			return false;
		}
		$act=new Activite($this->_reservation->getId());
		$user=new User($this->_reservation->getIdUser());
		if (!$act->getMustBeReserved())
		{
			echo "ERREUR : Cette activité ne peut être réservée.";
			return false;
		}
		if ($act->getDebutReservation()>time())
		{
			echo "ERREUR : Cette activité n'est pas encore réservable.";
			return false;
		}
		if ($act->getFinReservation()<time())
		{
			echo "ERREUR : Cette activité n'est plus réservable";
			return false;
		}
		if ($act->getDate()<time())
		{
			echo "ERREUR : Vous ne pouvez pas réserver une activité qui est déjà passé.";
			return false;
		}
		return true;
	}
}
?>