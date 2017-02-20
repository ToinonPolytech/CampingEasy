<?php 
require_once("../../modele/problemeTechnique.class.php");
require_once("../controllerObjet/problemeTechnique.controller.class.php");
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
echo $_POST['description'];
if(isset($_SESSION['id']) && isset($_POST['description'])
	&& isset($_POST['isBungalow']))
	{
	
	$pbTech = new PbTech(htmlspecialchars(NULL,$_SESSION['id'], time(), $timeSecEstimated, htmlspecialchars ($_POST['description']), htmlspecialchars($_POST['isBungalow'])));
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