<?php 
if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
		
		
require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
require_once(i("equipe.class.php"));
require_once(i("equipe_membres.class.php"));
require_once(i("equipe_membres.controller.class.php"));
require_once(i("equipe.controller.class.php"));

if(isset($_POST['nom']))
{
	$equipe = new Equipe(NULL,$_POST['nom'],0);
	
	$equipeController = new Controller_Equipe($equipe);
	if($equipeController->isGood())
	{
		$equipe->saveToDb();		
		
		$db= new Database(); 
		$db->select("equipe", array( 'nom' => $equipe->getNom()),array("id")); 
		$idEquipe = $db->fetch();
		$equipe_mb= new Equipe_membres($idEquipe[0],$_SESSION['id']); 
		$equipe_mbController = new Controller_Equipe_Membres($equipe_mb);
		if($equipe_mbController->isGood())
		{
			$equipe_mb->saveToDb(); 
			echo "Equipe ajoutée";
		}
		else
		{
			$db->delete("equipe", array("id" => $idEquipe));
		}
	}
}
else
{
	echo "ERREUR : Un problème est survenu lors de l'envoi du formulaire.";
}
?> 
