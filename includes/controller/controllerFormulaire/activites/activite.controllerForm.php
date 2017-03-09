<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
require_once(i("activities.class.php"));
require_once(i("activite.controller.class.php"));
if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
echo 'controller';
if (isset($_POST["timeStart"]) && isset($_POST["duree"]) && isset($_POST["nom"]) && isset($_POST["descriptif"]) 
&& isset($_POST["ageMin"]) && isset($_POST["ageMax"]) && isset($_POST["lieu"])
&& isset($_POST["type"]) && isset($_POST["placesLim"]) && isset($_POST["prix"]) && isset($_POST["points"]) && isset($_POST["lieu_type"]) && isset($_POST["debutReservation"]) && isset($_POST["finReservation"]))
{	 
	$photos_path=""; // TODO
	
	$mustBeReserved = (isset($_POST["mustBeReserved"])) ? 1 : 0;
	$lieu=$_POST["lieu"];
	if (!is_numeric($_POST["lieu"]) && $_POST["lieu_type"]==1)
	{
		echo "ERREUR : Un problème est survenu lors de l'envoi du formulaire.  ";
	}
	else
	{
		if ($_POST["lieu_type"]==1)
		{
			$db = new Database();
			$lieu=$db->getValue("lieu_commun", array("id" => $_POST["lieu"]), "nom");
		}
		if(isset($_POST['id']))
		{
			$act = new Activite(htmlspecialchars($_POST['id'])); 
			$act->setDate(htmlspecialchars(strtotime($_POST["timeStart"]))); 
			$act->setNom(htmlspecialchars($_POST["nom"]));
			$act->setDescriptif(htmlspecialchars($_POST["descriptif"]));
			$act->setDuree(htmlspecialchars($_POST["duree"]));
			$act->setAgeMin(htmlspecialchars($_POST["ageMin"]));
			$act->setAgeMax(htmlspecialchars($_POST["ageMax"]));
			$act->setLieu(htmlspecialchars($lieu)); 
			$act->setType(htmlspecialchars($_POST["type"]));
			$act->setPlacesLim(htmlspecialchars($_POST["placesLim"]));
			$act->setPrix(htmlspecialchars($_POST["prix"]));
			$act->setPoints(htmlspecialchars($_POST["points"]));
			$act->setDebutReservation(htmlspecialchars(strtotime($_POST["debutReservation"])));
			$act->setFinReservation(htmlspecialchars(strtotime($_POST["finReservation"])));
			$act->setPhotos($photos_path);
			

		}
		else
		{
		$act = new Activite(NULL, htmlspecialchars(strtotime($_POST["timeStart"])), htmlspecialchars($_POST["nom"]), htmlspecialchars($_POST["descriptif"]), htmlspecialchars($_POST["duree"]),
		htmlspecialchars($_POST["ageMin"]), htmlspecialchars($_POST["ageMax"]), htmlspecialchars($lieu), htmlspecialchars($_POST["type"]),
		htmlspecialchars($_POST["placesLim"]), htmlspecialchars($_POST["prix"]),$_SESSION['id'], htmlspecialchars($_POST["points"]),$mustBeReserved,htmlspecialchars(strtotime($_POST["debutReservation"])),htmlspecialchars(strtotime($_POST["finReservation"])),$photos_path);
		}
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
