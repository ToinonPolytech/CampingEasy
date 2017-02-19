<?php 
	require_once("../../modele/lieuCommun.class.php");
	require_once("../controllerObjet/lieuCommun.controller.class.php");
	if(isset($_POST['nom']) && isset($_POST['description']))
	{
		$LC = new lieuCommun(NULL,htmlspecialchars($_POST['nom']), htmlspecialchars ($_POST['description']));
		$LCController=new Controller_LieuCommun($LC);
		if($LCController->isGood()){
			$LC->saveToDb();
			echo "Lieu ajouté ";
		}
	}	
	else
	{
		echo "ERREUR : Un problème est survenu lors de l'envoi du formulaire.";
	}
?>