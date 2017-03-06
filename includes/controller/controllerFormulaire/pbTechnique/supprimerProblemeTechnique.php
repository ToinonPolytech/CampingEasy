 <?php
if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
		
require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
require_once(i("problemeTechnique.class.php"));


if(isset($_POST['id']) && auth()){
	
	$pbTech = new PbTech($_POST['id']);
	if ($pbTech->getIdUser()==$_SESSION["id"])
	{
		$pbTech->setDeleted(true);
		$pbTech->saveToDb();
		echo "Supprimé";
	}

}
else
{
	echo "erreur lors de la suppression";
	
	
}