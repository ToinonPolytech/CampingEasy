<?php 
require_once("../../modele/problemeTechnique.class.php");
require_once("../controllerObjet/problemeTechnique.controller.class.php");
if(isset($_SESSION['id'] && isset($_POST['timeCreated']) && isset($_POST['timeEstimated']) && isset($_POST['description']) && isset($_POST['isBungalow']))
{
	//conversion des dates en secondes écoulées depuis le 1er janvier 1970 
	$timeSecCreated = strtotime(htmlspecialchars($_POST['timeCreated'])) ; 
	$timeSecEstimated = strtotime(htmlspecialchars($_POST['timeEstimated']));
	$pbTech = new PbTech(htmlspecialchars($_SESSION['id'], $timeSecCreated, $timeSecEstimated, htmlspecialchars ($_POST['description']), htmlspecialchars($_POST['isBungalow']));
	$pbTechController = new Controller_PbTech($pbTech);
	if($pbTechController->isGood()){	 
		$pbTech->saveToDb();
	}
}
else
{	
	echo "ERREUR : Un problème est survenu lors de l'envoi du formulaire.";
}
?> 