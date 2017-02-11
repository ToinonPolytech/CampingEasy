<?php 
require("../../modele/reservation.class.php");
require("../controllerObject/reservation.controller.class.php");

if (isset($_POST["idActivite"]) && isset($_POST["idUser"]) && isset($_POST["idEquipe"]) && isset($_POST["nbrPersonne"]))
{
	$reservation = new Reservation(htmlspecialchars($_POST["idActivite"]), htmlspecialchars($_POST["idUser"]), htmlspecialchars($_POST["idEquipe"]), htmlspecialchars($_POST["nbrPersonne"]));
	$reservationController = new Controller_Reservation($reservation);
	if ($reservationController->isGood())
		$reservation->saveToDb();
}
else
{
	echo "ERREUR : Un problème est survenu lors de l'envoi du formulaire.";
}
?> 