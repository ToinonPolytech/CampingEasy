<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
require_once(i("reservation.class.php"));
require_once(i("reservation.controller.class.php"));
if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();


if (isset($_POST["id"]) && isset($_POST["type"]) && isset($_POST["nbrPersonnes"]))
{
	if ($_POST["type"]=="ACTIVITE")
	{
		$db=new Database();
		$time=$db->getValue("activities", array("id" => $_POST["id"]), "time_start");
	}
	
	$time=time();
	$reservation = new Reservation(NULL,htmlspecialchars($_POST["id"]), htmlspecialchars($_POST["type"]), htmlspecialchars($_POST["idUser"]), htmlspecialchars($_POST["idEquipe"]), htmlspecialchars($_POST["nbrPersonnes"]), $time);
	$reservationController = new Controller_Reservation($reservation);
	if ($reservationController->isGood())
	{
		$reservation->saveToDb();
		echo 'Réservation effectuée'; 
	}
	
}
else
{
	echo "ERREUR : Un problème est survenu lors de l'envoi du formulaire.";
}
?> 