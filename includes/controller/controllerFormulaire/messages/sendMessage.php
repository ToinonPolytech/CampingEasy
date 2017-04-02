<?php
	if (!isset($_SESSION))
		session_start();
	
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	require_once(i("database.class.php"));
	require_once(i("user.class.php"));
	require_once(i("user.controller.class.php"));
	if (!auth())
		exit();
	
	if (!isset($_POST["id"]) || !isset($_POST["message"]))
		exit();
	
	$message=trim($_POST["message"]);
	if (empty($message))
	{
		exit();
	}
	else
	{
		if ($_POST["id"]!=$_SESSION["id"])
		{
			$db=new Database();
			if (!$db->count("users", array("id" => $_POST["id"])))
				exit();
			
			$user_destinataire=new User($_POST["id"]);
			$user_expediteur=new User($_SESSION["id"]);
			$cuserd=new Controller_User($user_destinataire);
			$cusere=new Controller_User($user_expediteur);
			if ($user_destinataire->getAccessLevel()!="CLIENT" && $user_destinataire->getAccessLevel()!="PARTENAIRE")
			{
				$allowed=false;
				// MESSAGE AUX STAFF, PERMISSION ???
				if ($user_expediteur->getAccessLevel()!="CLIENT" && $user_destinataire->getAccessLevel()!="PARTENAIRE")
				{
					$allowed=$user_expediteur->can("SEND_MESSAGE_STAFF");
				}
				else
				{
					if ($db->count("messagerie", array("destinataire" => array("OR", array('=', $_POST["id"]), array('=', $_SESSION["id"])), "expediteur" => array("OR", array('=', $_POST["id"]), array('=', $_SESSION["id"])))))
						$allowed=$user_expediteur->can("SEND_MESSAGE");
				}
			}
			else
			{
				if ($user_expediteur->getAccessLevel()!="CLIENT" && $user_destinataire->getAccessLevel()!="PARTENAIRE")
				{
					$allowed=$user_expediteur->can("SEND_MESSAGE_STAFF");
				}
				else
				{
					$allowed=$user_expediteur->can("SEND_MESSAGE");
				}
			}
			
			if ($allowed)
			{
				$db->create("messagerie", array("date" => time(), "destinataire" => $_POST["id"], "expediteur" => $_SESSION["id"], "lu" => 0, "message" => $message));
				// ici on pourra mettre un script js pour réactualiser la messagerie
			}
		}
	}
?>