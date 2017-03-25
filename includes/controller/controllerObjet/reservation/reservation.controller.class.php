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
		
		return ($this->idIsGood() && $this->typeIsGood() && $this->idUserIsGood() && $this->nbrPersonneIsGood() && $this->reservationIsAvailable() && $this->timeIsGood());
	}
	public function etatLieuxIsGood(){
		$user = new Client($this->_reservation->getIdUser()); 
		$dateDep= date('d/m/Y', $user->getUserInfos()->getTimeDepart());
		$debutJournee=strtotime(date('y-m-d', $user->getUserInfos()->getTimeDepart()));
		$finJournee=$debutJournee+3600*24;
		$db = new Database();
		$db2= new Database();
		$db->select('reservation',array('type' => 'ETAT_LIEUX', 'time' => array($debutJournee, $finJournee)),"time");
		$db2->select('etat_lieux',array('debutTime' => array('>=', $debutJournee), 'finTime' => array('<=', $finJournee)));
		$hDispo=array();
		$hPrise=array();
		while($res=$db->fetch())
		{
			if (isset($hPrise[$res['time']]))
				$hPrise[$res['time']]+=1;
			else
				$hPrise[$res['time']]=1;
		}
		while($edl=$db2->fetch())
		{	
			for($i=$edl['debutTime'];$i<=$edl['finTime'];$i+=60*$edl['duree_moyenne'])
			{
				if (isset($hDispo[$i]))
					$hDispo[$i]+=1;
				else
					$hDispo[$i]=1;
			}
		}
		return (isset($hDispo[$this->_reservation->getTime()]) && $hDispo[$this->_reservation->getTime()]-$hPrise[$this->_reservation->getTime()]>0 && $db->count("etat_lieux", array("idUser" => $this->_reservation->getId(), "debutTime" => array("<=", $this->_reservation->getTime()), "finTime" => array(">=", $this->_reservation->getTime())))>0);
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
		else if ($this->_reservation->getType()=="RESTAURANT")
			return true;
		else if ($this->_reservation->getType()=="ETAT_LIEUX")
			return $this->etatLieuxIsGood();
		
		return false;
	}
	public function idIsGood(){
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