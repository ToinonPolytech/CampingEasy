<?php 
require_once("../../modele/partenaire.class.php");
require_once("../controllerObjet/partenaire.controller.class.php");
if(isset($_POST['nom']) && isset($_POST['libelle']) && isset($_POST['mail']) && isset($_POST['siteWeb']) && isset($_POST['telephone']))
{
	$partenaire = new Partenaire(NULL,htmlspecialchars($_POST['nom']), htmlspecialchars($_POST['libelle']), htmlspecialchars($_POST['mail']), htmlspecialchars($_POST['siteWeb']), htmlspecialchars($_POST['telephone']));
	$partenaireController = new Controller_Partenaire($partenaire);
	if($partenaireController->isGood())
	{
		$partenaire->saveToDb();
		echo "Ajout du partenaire réussi";
	}
}
else
{
	echo "ERREUR : Un problème est survenu lors de l'envoi du formulaire.";
}
?>