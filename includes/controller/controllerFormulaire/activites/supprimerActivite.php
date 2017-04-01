 <?php
if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
		
require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
require_once(i("activities.class.php"));


if (isset($_POST['id']))
{	
	$act=new Activite(htmlspecialchars($_POST['id']));
	if($act->getIdOwner()==$_SESSION['id'] || $_SESSION['access_level']!='CLIENT')
	{
		$act->setDeleted(true);
		$act->saveToDb();
		echo 'Activité supprimée';
	}
	else
	{
		echo "ERREUR : vous n'avez pas les droits pour supprimer cette activité ";
	}
	
}
else
{
	echo "erreur lors de la suppression";
}