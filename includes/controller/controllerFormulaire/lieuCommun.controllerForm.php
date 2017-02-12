<?php 
	require_once("../../modele/lieuCommun.class.php");
	require_once("../controllerObjet/lieuCommun.controller.class.php");
	foreach($_POST as $key => $val) { echo $key." : ".$val."<br/>"; }
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