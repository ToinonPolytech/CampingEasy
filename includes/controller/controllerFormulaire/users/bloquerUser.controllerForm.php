 <?php
if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
		
require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
require_once(i("client.class.php"));


if(isset($_POST['id']) && isset($_SESSION['id']) && $_POST['action']){
	
	$client = new Client(htmlspecialchars($_POST['id']));
	if($_POST['action']=='bloque')
	{
		$client->subDroits(CAN_LOG);
		echo 'Utilisateur bloqué';
	}
	else if($_POST['action']=='debloque')
	{
		$client->addDroits(CAN_LOG);
		echo 'Utilisateur débloqué'; 
	}



}
else
{
	echo "erreur lors de l'opération";
	
	
}