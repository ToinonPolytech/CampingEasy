<?php 

require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
require_once(i("equipe.class.php"));
require_once(i("equipe.controller.class.php"));

if(isset($_POST['nom']))
{
	$equipe = new Equipe(NULL,$_POST['nom'],0);
	$equipeController = new Controller_Equipe($equipe);
	if($equipeController->isGood())
	{
		$equipe->saveToDb();
		echo "Equipe ajoutée";
	}
}
else
{
	echo "ERREUR : Un problème est survenu lors de l'envoi du formulaire.";
}
?> 
