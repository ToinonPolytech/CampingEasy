<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
require_once(i("problemeTechniqueInfo.class.php"));
require_once(i("problemeTechniqueInfo.controller.class.php"));
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
echo $_POST['message'];
if(isset($_SESSION['id']) && isset($_POST['idPbTech']) && isset($_POST['message'])) // Nos variables existent, alors on peut les utiliser
{
	$objectPbTechInfo = new PbTechInfo($idPbTech = htmlspecialchars($_POST['idPbTech']), htmlspecialchars($_POST['idUser']), time(),$message = htmlspecialchars($_POST['message']));
	$controllerPbTechInfo = new Controller_PbTechInfo($objectPbTechInfo);
	if ($controllerPbTechInfo->isGood())
	{
		$objectPbTechInfo->saveToDb();
		echo "Message envoyé";
	}	
	else
	{
		echo "ERREUR : Un problème est survenu lors de l'envoie du formulaire. *";

	}	
}
else
{
	echo "ERREUR : Un problème est survenu lors de l'envoi du formulaire.";
}
?> 