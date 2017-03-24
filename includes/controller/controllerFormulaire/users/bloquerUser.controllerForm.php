 <?php
if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
		
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	require_once(i("client.class.php"));
	require_once(i("client.controller.class.php"));
	if (!auth())
		exit();



	if(isset($_POST['id']))
	{
		$client_edit = new Client(htmlspecialchars($_POST['id']));
		$clientOwner = new Client(htmlspecialchars($_SESSION['id']));
		$cclient = new Controller_Client($client);
		$cclient_owner = new Controller_Client($clientOwner);
		
		if (!$cclient_owner->canEdit($client_edit))
			exit();
		
		if ($cuser->can(CAN_LOG))
		{
			$client_edit->removeDroits(CAN_LOG);
			echo 'Utilisateur bloqué';
		}
		else
		{
			$client_edit->addDroits(CAN_LOG);
			echo 'Utilisateur débloqué'; 
		}
		$client_edit->saveToDb();
	}
	else
	{
		echo "erreur lors de l'opération";
	}
?>