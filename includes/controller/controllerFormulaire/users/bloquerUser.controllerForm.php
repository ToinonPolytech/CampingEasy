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
		$user_edit = new Client(htmlspecialchars($_POST['id']));
		$cuser = new Controller_Client($user_edit);
		
		if(isset($_SESSION['access_level'])=='CLIENT')
		{	
			
			$clientOwner = new Client(htmlspecialchars($_SESSION['id']));
			$cclient_owner = new Controller_Client($clientOwner);
			
			if (!$cclient_owner->canEdit($user_edit))
				exit();
		}
				
		if ($cuser->can(CAN_LOG))
		{
			$user_edit->removeDroits(CAN_LOG);
			echo 'Utilisateur bloqué';
		}
		else
		{
			$user_edit->addDroits(CAN_LOG);
			echo 'Utilisateur débloqué'; 
		}
		$user_edit->saveToDb();
	}
	else
	{
		echo "erreur lors de l'opération";
	}
?>