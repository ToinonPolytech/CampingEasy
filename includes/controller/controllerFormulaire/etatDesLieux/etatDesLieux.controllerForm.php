  <?php 
require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
require_once(i("etatDesLieux.class.php"));
require_once(i("etatDesLieux.controller.class.php"));
if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
		
		
if(isset($_POST['idUser']) && isset($_POST['dateDeb']) && isset($_POST['dateFin']) && isset($_POST['dateFin']) && isset($_POST['duree']))
{	
	

	
	$edl = new EtatDesLieux(NULL,htmlspecialchars($_POST['idUser']), htmlspecialchars($_POST['dateDeb']), htmlspecialchars($_POST['dateFin']), htmlspecialchars($_POST['duree']));
	
	$edlController = new Controller_EtatDesLieux($edl);
	
	if($_POST['id'])
	{
		$edl->setId($_POST['id']);
	}
	if($edlController->isGood())
	{
		$edl->saveToDb();
		echo "Mise à jour des états des lieux réussie ";
	}
}
else
{
	echo "ERREUR : Un problème est survenu lors de l'envoi du formulaire.";
}
?>