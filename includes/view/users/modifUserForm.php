 <?php
	if (!isset($_SESSION))
		session_start();
	
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	require_once(i('client.class.php'));
	require_once(i('staff.class.php'));
	if(isset($_POST['id']))
	{	
		$user = new User($_POST['id']);
		if($user->getAccessLevel()=='CLIENT')
		{
			$user = new Client($_POST['id']);
		}
		else
		{
			$user = new Staff($_POST['id']);
		}
		$userInfo = $user->getUserInfos();
		?>
		<div class="col-lg-6" style="width:100%;" name="form-user" id="form-user">
			<h3>Modifier l'utilisateur </h3><br/>
			<form role="form"  method="post" id="form_user" name="form_user">
				<div class="form-group">
					<label for="numPlace">Numéro d'emplacement </label><br/>
					<input class="form-control" type="number" name="numPlace" id="numPlace" value="<?php echo htmlspecialchars($userInfo->getEmplacement()); ?>"/> <br />
					<label for="email">Adresse mail</label><br/>
					<input class="form-control" type="email" name="mail" id="mail" value="<?php echo htmlspecialchars($userInfo->getEmail()); ?>"/> <br />
					<label for="date">Date de départ</label><br/>
					<input id="date" name="date" type="text"  value="<?php echo date("d-m-y H:m", htmlspecialchars($userInfo->getTimeDepart())); ?>"><br />
					<label for="type">Type du compte</label><br/>
					<select class="form-control" name="type" id="type"  value="<?php echo htmlspecialchars($user->getAccessLevel()); ?>">
						<option value="CLIENT">Client</option>
						<option value="ANIMATEUR">Animateur</option>
						<option value="TECHNICIEN">Technicien</option>
						<option value="PATRON">Directeur</option>
					</select><br/>
					<label for="nom">Nom</label><br/>
					<input class="form-control" type="text" name="nom" id="nom"  value="<?php echo htmlspecialchars($user->getNom()); ?>"/> <br/>
					<label for="prenom">Prénom</label><br/>
					<input class="form-control" type="text" name="prenom" id="prenom"  value="<?php echo htmlspecialchars($user->getPrenom()); ?>"/> <br/>
					<input type="hidden" name="id" id="id" value="<?php echo htmlspecialchars($_POST['id']); ?>" />
					<button class="btn btn-success" onclick="loadTo('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('user.controllerForm.php')); ?>', $('#form_user').serialize(), '#form-user', 'prepend'); return false;">Modifier</button>
				</div>
			</form>
		</div>
		<script type="text/javascript">
			$("#date").datetimepicker({
				format:'d-m-Y H:00'
			});
		</script>
	<?php
	}
	else
	{
		echo 'aucun utilisateur reçu'; 
	}