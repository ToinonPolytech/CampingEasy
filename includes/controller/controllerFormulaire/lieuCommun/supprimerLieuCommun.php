  <?php
if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
		
require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
require_once(i("database.class.php"));


if(isset($_POST['id'])){
	
	$db = new Database();
$db->delete("lieu_commun",array('id' => $_POST['id'])); 

echo "Le lieu a été supprimé";

}
else
{
	echo "erreur lors de la suppression";
	
	
}