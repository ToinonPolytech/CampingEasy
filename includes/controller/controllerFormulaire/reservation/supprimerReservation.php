<?php
if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
		
require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
require_once(i("database.class.php"));


if(isset($_POST['id']) && isset($_SESSION['id'])){
	
	$db = new Database();
$db->delete("reservation",array('idActivite' => $_POST['id'], 'idUser' => $_SESSION['id']),NULL); 

echo 'réservation supprimée';

}
else
{
	echo "erreur lors de la suppression";
	
	
}





?>
