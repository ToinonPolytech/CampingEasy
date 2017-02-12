<?php 
require("../../modele/equipe.class.php");
require("../controllerObjet/equipe.controller.class.php");
if(isset($_POST['nom']) && isset($_POST['score']))
{
	$equipe = new Equipe($_POST['nom'],$_POST['score']);
	$equipeController = new Controller_Equipe($equipe);
	if($equipeController->isGood())
	{
		$equipe->saveToDb();
	}
}
else
{
	echo "ERREUR : Un problème est survenu lors de l'envoi du formulaire.";
}
?> 
