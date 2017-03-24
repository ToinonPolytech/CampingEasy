<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
?>
<div class="alert alert-danger" role="alert" name="infoErreur" id="infoErreur">
	<?php 
	//controller du formulaire de création d'un utilisateur via l'administration
	if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['numPlace']) && isset($_POST['mail']) && isset($_POST['date']) && isset($_POST['type']) && $date=strtotime($_POST["date"])!==false)
	{
		require_once(i("userInfos.controller.class.php"));
		if ($_POST['type']=="CLIENT")
		{
			require_once(i("client.class.php"));
			require_once(i("client.controller.class.php"));
			// Le client maître, a tout les droits disponible pour un client
			$droits=0;
			for ($i=$puissance;$i>0;$i--)
			{
				$droits+=$i;
			}
			if(isset($_POST['id']) &&  isset($_POST['idInfo']))
			{	//si modification 
				$user = new Client(htmlspecialchars($_POST['id']),$_POST['idInfo']);
				$userInfos = $user->getUserInfos();
				$user->setType(htmlspecialchars($_POST['type']));
				$user->setNom(htmlspecialchars($_POST['nom']));
				$user->setPrenom(htmlspecialchars($_POST['prenom']));
				$userInfos->setEmplacement(htmlspecialchars($_POST['numPlace']));
				$userInfos->setEmail(htmlspecialchars($_POST['mail']));
				$userInfos->setTimeDepart(strtotime(htmlspecialchars($_POST['date'])));
			}
			else
			{	//si nouveau user 
				$user = new Client(NULL, NULL, htmlspecialchars($_POST['type']), $droits, htmlspecialchars($_POST['nom']), htmlspecialchars($_POST['prenom']), NULL);
				$controllerUser = new Controller_Client($user);
				$clef = $controllerUser->generateKey();
				$userInfos = new UserInfo(NULL, htmlspecialchars($_POST['numPlace']), htmlspecialchars($_POST['mail']), strtotime(htmlspecialchars($_POST["date"])), $clef);
				$user->setUserInfos($userInfos);
				$user->setClef($clef);
			}
			$controllerUser = new Controller_Client($user, false); // On met à jour notre controller
			$controllerUserInfo = new Controller_UserInfo($userInfos);
			if ($controllerUserInfo->isGood() && $controllerUser->isGood())
			{
				$userInfos->saveToDb();
				$user->saveToDb();
				$success=true;
			}
		}
		else
		{
			require_once(i("staff.class.php"));
			require_once(i("staff.controller.class.php"));
			$droits=0;
			for ($i=$puissance;$i>0;$i--)
			{
				$droits+=$i;
			} // pour le moment un staff a tous les droits de client, à voir pour la suite 
			if(isset($_POST['id']) &&  isset($_POST['idInfo']))
			{	//si modification 
				$user = new Staff(htmlspecialchars($_POST['id']),$_POST['idInfo']);
				$userInfos = $user->getUserInfos();
				$user->setType(htmlspecialchars($_POST['type']));
				$user->setNom(htmlspecialchars($_POST['nom']));
				$user->setPrenom(htmlspecialchars($_POST['prenom']));
				$userInfos->setEmplacement(htmlspecialchars($_POST['numPlace']));
				$userInfos->setEmail(htmlspecialchars($_POST['mail']));
				$userInfos->setTimeDepart(strtotime(htmlspecialchars($_POST['date'])));
			}
			else
			{	//si nouveau user 
				$user = new Staff(NULL, NULL, htmlspecialchars($_POST['type']), $droits, htmlspecialchars($_POST['nom']), htmlspecialchars($_POST['prenom']), NULL);
				$userInfos = new UserInfo(NULL, htmlspecialchars($_POST['numPlace']), htmlspecialchars($_POST['mail']), strtotime(htmlspecialchars($_POST["date"])), $clef);
			}
			
			$controllerUser = new Controller_Staff($user);
			$clef = $controllerUser->generateKey();
			$user->setUserInfos($userInfos);
			$user->setClef($clef);
			$controllerUser = new Controller_Staff($user, false); // On met à jour notre controller
			$controllerUserInfo = new Controller_UserInfo($userInfos);
			if ($controllerUserInfo->isGood() && $controllerUser->isGood())
			{
				$userInfos->saveToDb();
				$user->saveToDb();
				$success=true;
			}
		}
	}
	if (isset($success))
	{
		?>
		L'utilisateur a bien été créé.<br/>
		<script type="text/javascript">
			$("#infoErreur").removeClass("alert-danger").addClass("alert-success");.fadeOut(5500, function(){ $("#infoErreur").remove(); });
		</script>
		<?php
		echo 'La clef de connexion du client est : '.$user->getClef();
	}
	?>
</div>
<script type="text/javascript">
	$("#infoErreur").fadeOut(5500, function(){ $("#infoErreur").remove(); });
</script>