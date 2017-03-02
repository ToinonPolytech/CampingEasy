<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
require_once(i("partenaire.class.php"));
require_once(i("partenaire.controller.class.php"));
if(isset($_POST['nom']) && isset($_POST['libelle']) && isset($_POST['mail']) && isset($_POST['siteWeb']) && isset($_POST['telephone']))
{	if(isset($_POST['id']))
	{	
		$partenaire = new Partenaire(htmlspecialchars($_POST['id']));
		$partenaire->setNom(htmlspecialchars($_POST['nom']));
		$partenaire->setLibelle(htmlspecialchars($_POST['libelle']));
		$partenaire->setMail(htmlspecialchars($_POST['mail']));
		$partenaire->setSiteWeb(htmlspecialchars($_POST['siteWeb']));
		$partenaire->setTelephone(htmlspecialchars($_POST['telephone']));
	}
	
	else 
	{
	$partenaire = new Partenaire(NULL,htmlspecialchars($_POST['nom']), htmlspecialchars($_POST['libelle']), htmlspecialchars($_POST['mail']), htmlspecialchars($_POST['siteWeb']), htmlspecialchars($_POST['telephone']));
	}
	
	
	$partenaireController = new Controller_Partenaire($partenaire);
	if($partenaireController->isGood())
	{
		$partenaire->saveToDb();
		echo "Mise à jour des partenaires réussie ";
	}
}
else
{
	echo "ERREUR : Un problème est survenu lors de l'envoi du formulaire.";
}
?>