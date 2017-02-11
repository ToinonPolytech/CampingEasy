<?php 
require("../../modele/problemeTechniqueInfo.class.php");
require("../controllerObjet/problemeTechniqueInfo.controller.class.php");
if(isset($_POST['idUser']) && isset($_POST['idPbTech']) && isset($_POST['message'])) // Nos variables existent, alors on peut les utiliser
{
	$idUser = htmlspecialchars($_POST['idUser']);
	$idPbTech = htmlspecialchars($_POST['idPbTech']); 
	$message = htmlspecialchars($_POST['message']);
	$objectPbTechInfo = new PbTechInfo($idPbTech, $idUser, time(), $message);
	$controllerPbTechInfo = new Controller_PbTechInfo($objectPbTechInfo);
	if ($controllerPbTechInfo->isGood())
		$objectPbTechInfo->saveToDb();
	else
		echo "ERREUR : Un problème est survenu lors de l'envoie du formulaire."
}
?> 