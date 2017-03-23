<?php 
if (!isset($_SESSION))
	session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
require_once(i("reservation.class.php"));
require_once(i("reservation.controller.class.php"));
if (!auth())
	exit();

if (isset($_POST["id"]) && isset($_POST["type"])  && isset($_POST["nbrPersonnes"]))
{	
	if(isset($_POST["idEquipe"]))
	{
		$idEquipe =  htmlspecialchars($_POST["idEquipe"]);
	}
	else
	{
		$idEquipe = 0 ; 
	}
	if ($_POST["type"]=="ACTIVITE")
	{
		$db=new Database();
		$time=$db->getValue("activities", array("id" => $_POST["id"]), "time_start");
	}
	else if (isset($_POST["time"]))
	{
		$time=$_POST["time"];
	}
	else
	{
		echo "ERREUR : Un problème est survenu lors de l'envoi du formulaire.";
		exit();
	}
	
	$reservation = new Reservation(htmlspecialchars($_POST["id"]), htmlspecialchars($_POST["type"]), $_SESSION["id"],$idEquipe, htmlspecialchars($_POST["nbrPersonnes"]), $time);
	$reservationController = new Controller_Reservation($reservation);
	if ($reservationController->isGood())
	{
		$reservation->saveToDb();
		echo 'Réservation effectuée'; 
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