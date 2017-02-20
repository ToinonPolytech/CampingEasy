<?php 
require_once("../../modele/activities.class.php");
require_once("../controllerObjet/activite.controller.class.php");
if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();

if (isset($_POST["timeStart"]) && isset($_POST["duree"]) && isset($_POST["nom"]) && isset($_POST["descriptif"]) 
&& isset($_POST["ageMin"]) && isset($_POST["ageMax"]) && isset($_POST["lieu"])
&& isset($_POST["type"]) && isset($_POST["placesLim"]) && isset($_POST["prix"]) && isset($_POST["points"]) && isset($_POST["mustBeReserved"]) && isset($_POST["lieu_type"]))
{
	$lieu=$_POST["lieu"];
	if (!is_numeric($_POST["lieu"]) && $_POST["lieu_type"]==1)
	{
		echo "ERREUR : Un problème est survenu lors de l'envoi du formulaire.";
	}
	else
	{
		if ($_POST["lieu_type"]==1)
		{
			$db = new Database();
			$lieu=$db->getValue("lieu_commun", array("id" => $_POST["lieu"]), "nom");
		}
		
		$act = new Activite(NULL, htmlspecialchars(strtotime($_POST["timeStart"])), htmlspecialchars($_POST["nom"]), htmlspecialchars($_POST["descriptif"]), htmlspecialchars($_POST["duree"]),
		htmlspecialchars($_POST["ageMin"]), htmlspecialchars($_POST["ageMax"]), htmlspecialchars($lieu), htmlspecialchars($_POST["type"]),
		htmlspecialchars($_POST["placesLim"]), htmlspecialchars($_POST["prix"]),$_SESSION['id'], htmlspecialchars($_POST["points"]), htmlspecialchars($_POST["mustBeReserved"]));
		$actController = new Controller_Activite($act);	
		if($actController->isGood())
		{
			$act->saveToDb();
			echo "Activité enregistrée ";
		}
	}
}
else
{
	echo "ERREUR : Un problème est survenu lors de l'envoi du formulaire.";
}
?>
