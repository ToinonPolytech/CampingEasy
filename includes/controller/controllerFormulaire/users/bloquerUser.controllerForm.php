 <?php
if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
		
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	require_once(i("user.class.php"));
	require_once(i("user.controller.class.php"));
	if (!auth())
		exit();

	if(isset($_POST['id']))
	{
		$user_edit = new User(htmlspecialchars($_POST['id']));
		$cuser = new Controller_User($user_edit);
		$userOwner = new User(htmlspecialchars($_SESSION['id']));
		$cuser_owner = new Controller_User($userOwner);
		if(($_SESSION['access_level']=='CLIENT' || $_SESSION['access_level']=='PARTENAIRE') && !$cuser_owner->canEdit($user_edit))
			exit();
		elseif ($_SESSION['access_level']!='CLIENT' && $_SESSION['access_level']!='PARTENAIRE' && !$cuser_owner->can(CAN_EDIT_ACCOUNT_STAFF))
			exit();
			
		if ($cuser->can(CAN_LOG))
			$user_edit->removeDroits(CAN_LOG);
		else
			$user_edit->addDroits(CAN_LOG);

		$user_edit->saveToDb();
		$cuser = new Controller_User($user_edit);
		if ($_SESSION["access_level"]=='CLIENT' || $_SESSION['access_level']=='PARTENAIRE')
		{
			?>
			<button type="button" class="btn btn-danger btn-sm" name="suppUser" onclick="loadTo('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('bloquerUser.controllerForm.php')); ?>', {id : <?php echo $_POST["id"]; ?>}, '#<?php echo $_POST["id"]; ?>_options', 'replace'); return false;"><?php if ($cuser->can(CAN_LOG)) { echo "Bloquer"; } else { echo "Débloquer"; } ?></button>
			<?php
		}
		else
		{
			?>
			<button type="button" class="btn btn-info btn-sm" name="modifUser" onclick="loadToMain('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('modifUserForm.php')); ?>', {id : <?php echo $_POST["id"]; ?>}); return false;">Modifier</button>
			<?php if ($cuser->can(CAN_LOG)) { ?><button type="button" class="btn btn-danger btn-sm" name="suppUser" onclick="loadTo('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('bloquerUser.controllerForm.php')); ?>', {id : <?php echo $_POST["id"]; ?>}, '#<?php echo $_POST["id"]; ?>_options', 'replace'); return false;">Bloquer</button><?php } else { ?><button type="button" class="btn btn-success btn-sm" name="suppUser" onclick="loadTo('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('bloquerUser.controllerForm.php')); ?>', {id : <?php echo $_POST["id"]; ?>}, '#<?php echo $_POST["id"]; ?>_options', 'replace'); return false;">Débloquer</button><?php }
		}
	}
?>