<?php 
require_once("../../modele/activities.class.php");
require_once("../controllerObjet/activite.controller.class.php");

if (isset($_POST["timeStart"]) && isset($_POST["duree"]) && isset($_POST["nom"]) && isset($_POST["descriptif"]) 
&& isset($_POST["ageMin"]) && isset($_POST["ageMax"]) && isset($_POST["idLieu"]) && isset($_POST["lieu"]) 
&& isset($_POST["type"]) && isset($_POST["placesLim"]) && isset($_POST["prix"]) && isset($_POST["idOwner"]) && isset($_POST["points"]) && isset($_POST["mustBeReserved"]))
{
	$act = new Activite(htmlspecialchars($_POST["timeStart"]), htmlspecialchars($_POST["nom"]), htmlspecialchars($_POST["descriptif"]), htmlspecialchars($_POST["duree"]),
	htmlspecialchars($_POST["ageMin"]), htmlspecialchars($_POST["ageMax"]), htmlspecialchars($_POST["lieu"]), htmlspecialchars($_POST["idLieu"]), htmlspecialchars($_POST["type"]),
	htmlspecialchars($_POST["placesLim"]), htmlspecialchars($_POST["prix"]), htmlspecialchars($_POST["idOwner"]), htmlspecialchars($_POST["points"]), htmlspecialchars($_POST["mustBeReserved"]));
	$actController = new Controller_Activite($act);
	
	
	
	if($actController->isGood())
	{
		$act->saveToDb();
	}
}
else
{
	echo "ERREUR : Un problème est survenu lors de l'envoi du formulaire.";
}
?>
