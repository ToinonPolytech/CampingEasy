  <?php
if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
		
require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
require_once(i("database.class.php"));


if(isset($_POST['idUser']) && isset($_POST['idEquipe'])){
	
	$db = new Database();
$db->delete("equipe_membres",array('idUser' => $_POST['idUser'], 'idEquipe' => $_POST['idEquipe'])); 

echo "Le membre de l'équipe a été exlu";

}
else
{
	echo "erreur lors de la suppression";
	
	
}