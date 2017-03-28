 <?php
	if (!isset($_SESSION))
		session_start();
	
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	require_once(i('client.class.php'));
	require_once(i('staff.class.php'));
	if(isset($_POST['id']) && isset($_POST['access_level']))
	{	if($_POST['access_level']=='CLIENT')
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
			<form role="form"  method="post">
				<div class="form-group">
					
					<label for="numPlace">Numéro d'emplacement </label><br/>
					<input class="form-control" type="number" name="numPlace" id="numPlace" value="<?php echo $userInfo->getEmplacement();?>"/> <br />
					<label for="email">Adresse mail</label><br/>
					<input class="form-control" type="email" name="email" id="email" value="<?php echo $userInfo->getEmail();?>"/> <br />
					<label for="date">Date de départ</label><br/>
					<input id="date" name="date" type="text"  value="<?php echo date("d/m/y H:m", $userInfo->getTimeDepart());?>"><br />
					<label for="type">Type du compte</label><br/>
					<select class="form-control" name="type" id="type"  value="<?php echo $user->getAccessLevel();?>">
						<option value="CLIENT">Client</option>
						<option value="ANIMATEUR">Animateur</option>
						<option value="TECHNICIEN">Technicien</option>
						<option value="PATRON">Directeur</option>
					</select><br/>
					<label for="nom">Nom</label><br/>
					<input class="form-control" type="text" name="nom" id="nom"  value="<?php echo $user->getNom();?>"/> <br/>
					<label for="prenom">Prénom</label><br/>
					<input class="form-control" type="text" name="prenom" id="prenom"  value="<?php echo $user->getPrenom();?>"/> <br/>
					<button class="btn btn-success" onclick="loadTo('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('user.controllerForm.php')); ?>', {id: <?php echo $_POST['id']; ?>, idInfo : <?php echo $userInfo->getId();?>, numPlace : $('#numPlace').val(), mail : $('#email').val(), date : $('#date').val(), type : $('#type').val(), nom : $('#nom').val(), prenom : $('#prenom').val()}, '#form-user', 'prepend'); return false;">Modifier</button>
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