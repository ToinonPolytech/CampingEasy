 <?php
if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
		
require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
require_once(i("database.class.php"));


if(isset($_POST['id']) && isset($_SESSION['id'])){
	
	$db = new Database();
$db->delete("users",array('id' => $_POST['id']),NULL); 

echo 'Utilisateur supprimé ';

}
else
{
	echo "erreur lors de la suppression";
	
	
}