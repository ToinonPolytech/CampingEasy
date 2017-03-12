<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
require_once(i("reservation.class.php"));
require_once(i("reservation.controller.class.php"));
echo 'controller';
if (isset($_POST["id"]) && isset($_POST["type"]) && isset($_POST["idUser"]) && isset($_POST["idEquipe"]) && isset($_POST["nbrPersonnes"]))
{
	if ($_POST["type"]=="ACTIVITE")
	{
		$db=new Database();
		$time=$db->getValue("activities", array("id" => $_POST["id"]), "time_start");
	}
	else if (isset($_POST["time"]))
	{
		$time=$_POST["time"];
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
}
else
{
	echo "ERREUR : Un problème est survenu lors de l'envoi du formulaire.";
}
?> 