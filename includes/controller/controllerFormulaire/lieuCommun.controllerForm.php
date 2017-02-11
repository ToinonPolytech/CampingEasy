<?php 
	require("../../modele/lieuCommun.class.php");
	require("../controllerObjet/lieuCommun.controller.class.php");
	if(isset($_POST['nom']) && isset($_POST['description']))
	{
		$LC = new lieuCommun(htmlspecialchars($_POST['nom']), htmlspecialchars ($_POST['description']));
		$LCController=new Controller_LieuCommun($LC);
		if($LCController->isGood()){
			$LC->saveToDb();
		}
	}	
	else
	{
		echo "ERREUR : Un problème est survenu lors de l'envoi du formulaire.";
	}
?>