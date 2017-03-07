<?php
if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
		
require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
require_once(i("reservation.class.php"));


if (isset($_POST['id']) && isset($_POST['type']) && isset($_SESSION['id']))
{
	$reservation=new Reservation(htmlspecialchars($_POST['id']), htmlspecialchars($_POST['type']), $_SESSION['id']);
	$reservation->setDeleted(true);
	$resevation->saveToDb();
	echo 'Réservation supprimée';
}
else
{
	echo "erreur lors de la suppression";
}





?>
