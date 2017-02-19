<?php 
require_once("../../modele/activities.class.php");
require_once("../controllerObjet/activite.controller.class.php");


if (!isset($_POST['nom'])){ echo "La variable n'existe pas";}
if (isset($_POST["timeStart"]) && isset($_POST["duree"]) && isset($_POST["nom"]) && isset($_POST["descriptif"]) 
&& isset($_POST["ageMin"]) && isset($_POST["ageMax"]) && isset($_POST["idLieu"]) && isset($_POST["lieu"]) 
&& isset($_POST["type"]) && isset($_POST["placesLim"]) && isset($_POST["prix"]) && isset($_SESSION['id']) && isset($_POST["points"]) && isset($_POST["mustBeReserved"]))
{
	$act = new Activite(NULL, htmlspecialchars($_POST["timeStart"]), htmlspecialchars($_POST["nom"]), htmlspecialchars($_POST["descriptif"]), htmlspecialchars($_POST["duree"]),
	htmlspecialchars($_POST["ageMin"]), htmlspecialchars($_POST["ageMax"]), htmlspecialchars($_POST["lieu"]), htmlspecialchars($_POST["idLieu"]), htmlspecialchars($_POST["type"]),
	htmlspecialchars($_POST["placesLim"]), htmlspecialchars($_POST["prix"]),$_SESSION['id'], htmlspecialchars($_POST["points"]), htmlspecialchars($_POST["mustBeReserved"]));
	$actController = new Controller_Activite($act);
	
	
	
	if($actController->isGood())
	{
		$act->saveToDb();
		echo "Activité enregistrée ";
	}
}
else
{
	echo "ERREUR : Un problème est survenu lors de l'envoi du formulaire.";
}
?>
