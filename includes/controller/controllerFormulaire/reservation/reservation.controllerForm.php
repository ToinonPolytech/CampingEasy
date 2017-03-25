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
	$id=$_POST["id"];
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
		$time=$db->getValue("activities", array("id" => $id), "time_start");
	}
	else if ($_POST["type"]=="ETAT_LIEUX")
	{
		$time=$_POST["time"];
		$db=new Database();
		$db->select("etat_lieux", array("debutTime" => array("<=", $time), "finTime" => array(">=", $time), array("idUser", "debutTime", "finTime", "duree_moyenne")));
		$db2=new Database();
		$staffDispo=array();
		while ($data=$db->fetch())
		{
			/// Il ne doit pas avoir de réservation pendant les horaires sélectionnés par le user
			if ($db2->count("reservation", array("id" => $data["idUser"], "type" => "ETAT_LIEUX", "time" => array($time-$data["duree_moyenne"]+1, $time+$data["duree_moyenne"]-1)))==0)
			{
				$count=$db2->count("reservation", array("id" => $data["idUser"], "type" => "ETAT_LIEUX", "time" => array($data["debutTime"], $data["finTime"])));
				$staffDispo[$data["idUser"]]=$count;
			}
		}
		arsort($staffDispo); // On tri de manière décroissante en conservant les index
		$id=key($staffDispo);
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
	
	$reservation = new Reservation(htmlspecialchars($id), htmlspecialchars($_POST["type"]), $_SESSION["id"], htmlspecialchars($_POST["nbrPersonnes"]), $time);
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