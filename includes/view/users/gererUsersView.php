   <?php
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
		
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	require_once(i("database.class.php"));
	require_once(i("user.class.php"));
	if (!auth() || $_SESSION["access_level"]=="CLIENT" || $_SESSION["access_level"]=="PARTENAIRE")
		exit();
	
	?> 
	<div class="col-lg-6" style="width:100%;" name="form-equipe" id="form-equipe">
		<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('ajoutUserForm.php')); ?>" class="pull-left">Ajouter un utilisateur </a>
		<?php	
			$db = new Database();
			$db2 = new Database();
			$db->setOrderCol("ui.id");
			$db->setAsc();
			$db->selectJoin("userinfos AS ui", array(" users AS u ON u.infoId=ui.id"), array(), array("emplacement", "email", "time_depart", "access_level", "nom", "prenom", "u.id", "infoId", "droits"));
		?>
		<table class='table'>
			<thead>
				<tr>
					<th>Emplacement</th>
					<th>Email</th>
					<th>Date de départ</th>
					<th>Qualité </th>
					<th>Nom </th>
					<th>Prenom </th>
					<th>Options</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$old_id=-1;
			while($data=$db->fetch())
			{	
				$user=new User(NULL, NULL, NULL, $data["droits"], NULL, NULL, NULL, NULL);
				$cUser=new Controller_User($user);
				?>
				<tr>
					<td><?php if ($old_id!=$data["infoId"]) { echo $data['emplacement']; } ?></td>
					<td><?php if ($old_id!=$data["infoId"]) { echo $data['email']; } ?></td>
					<td><?php if ($old_id!=$data["infoId"]) { echo date("d/m/y H:m", $data['time_depart']); } ?></td>
					<td><?php echo $data['access_level']; ?></td>
					<td><?php echo $data['nom']; ?></td>
					<td><?php echo $data['prenom']; ?></td>
					<td id="<?php echo $data["id"]; ?>_options"><button type="button" class="btn btn-info btn-sm" name="modifUser" onclick="loadToMain('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('modifUserForm.php')); ?>', {id : <?php echo $data["id"]; ?>}); return false;">Modifier</button>
					<?php if ($cUser->can(CAN_LOG)) { ?><button type="button" class="btn btn-danger btn-sm" name="suppUser" onclick="loadTo('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('bloquerUser.controllerForm.php')); ?>', {id : <?php echo $data["id"]; ?>}, '#<?php echo $data["id"]; ?>_options', 'replace'); return false;">Bloquer</button><?php } else { ?><button type="button" class="btn btn-success btn-sm" name="suppUser" onclick="loadTo('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('bloquerUser.controllerForm.php')); ?>', {id : <?php echo $data["id"]; ?>}, '#<?php echo $data["id"]; ?>_options', 'replace'); return false;">Débloquer</button><?php } ?>
					</td>
				</tr>
				<?php
				$old_id=$data["infoId"];
			}
			?>
			</tbody>
		</table> 
	</div>