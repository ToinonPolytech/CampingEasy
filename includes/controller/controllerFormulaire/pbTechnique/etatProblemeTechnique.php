 <?php 
require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
require_once(i("problemeTechnique.class.php"));
require_once(i("problemeTechnique.controller.class.php"));
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
echo 'controller';
if(isset($_POST['etat']) && isset($_POST['idPbTech']))) // Nos variables existent, alors on peut les utiliser
{
	//manque sécu pour vérifier que le user peut changer l'état  
	$pbtech = new PbTechInfo(htmlspecialchars($_POST['idPbTech']));
	$controllerPbTech = new Controller_PbTech($pbtech);
	$pbtech->setSolved(htmlspecialchars($_POST['etat']));
	if ($controllerPbTech->isGood())
	{	
		$pbtech->saveToDb();
		echo "Problème marqué comme ".$_POST['etat'];
	}	
	else
	{
		echo "ERREUR : Un problème est survenu lors du changement d'état.";

	}	
}
else
{
	echo "ERREUR : Un problème est survenu lors du changement d'état.";
}
?> 