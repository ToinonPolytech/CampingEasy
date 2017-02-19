<?php 
require_once("../../modele/reservation.class.php");
require_once("../controllerObject/reservation.controller.class.php");

if (isset($_POST["idActivite"]) && isset($_POST["idUser"]) && isset($_POST["idEquipe"]) && isset($_POST["nbrPersonnes"]))
{
	$reservation = new Reservation(NULL,htmlspecialchars($_POST["idActivite"]), htmlspecialchars($_POST["idUser"]), htmlspecialchars($_POST["idEquipe"]), htmlspecialchars($_POST["nbrPersonnes"]));
	$reservationController = new Controller_Reservation($reservation);
	if ($reservationController->isGood())
		$reservation->saveToDb();
	echo 'réservation effectuée'; 
}
else
{
	echo "ERREUR : Un problème est survenu lors de l'envoi du formulaire.";
}
?> 