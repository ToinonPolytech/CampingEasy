 <?php
if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
		
require_once('../../modele/database.class.php');


if(isset($_POST['id']) && isset($_SESSION['id'])){
	
	$db = new Database();
$db->delete("equipe",array('id' => $_POST['id'])); 

echo 'réservation supprimée';

}
else
{
	echo "erreur lors de la suppression";
	
	
}





?>