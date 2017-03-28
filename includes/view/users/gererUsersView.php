   <?php
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
		
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	require_once(i("database.class.php"));
	?> 
	<div class="col-lg-6" style="width:100%;" name="form-equipe" id="form-equipe">
	<?php
	if($_SESSION['access_level']!='CLIENT')
	{
			?>
			<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('ajoutUserForm.php')); ?>" class="pull-left">Ajouter un utilisateur </a>
		<?php	
			$db = new Database();
			$db2 = new Database(); 
			$db->select("userinfos");
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
			while($data=$db->fetch())
			{	$db2->select('users',array('infoId' => $data['id'], 'clef' => $data['clef']));
				$user = $db2->fetch();
				?>
				<tr>
					<td><?php echo $data['emplacement']; ?></td>
					<td><?php echo $data['email']; ?></td>
					<td><?php echo date("d/m/y H:m", $data['time_depart']); ?></td>
					<td><?php echo $user['access_level']; ?></td>
					<td><?php echo $user['nom']; ?></td>
					<td><?php echo $user['prenom']; ?></td>
					<td><button type="button" class="btn btn-info btn-sm" name="modifUser" onclick="loadToMain('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('modifUserForm.php')); ?>', {id : <?php echo $user["id"]; ?>, access_level : '<?php echo $user['access_level']; ?>' }); return false;">Modifier</button>
					<button type="button" class="btn btn-danger btn-sm" name="suppUser" onclick="loadToMain('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('bloquerUser.controllerForm.php')); ?>', {id : <?php echo $user["id"]; ?>}); return false;">Bloquer</button></td>
					
				</tr>
				<?php
				$db2->select('users',array('infoId' => $data['id'], 'clef' => array('!=',$data['clef'])));
				while($user=$db2->fetch())
				{
				?> 
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td><?php echo $user['access_level']; ?></td>
					<td><?php echo $user['nom']; ?></td>
					<td><?php echo $user['prenom']; ?></td>
					<td><button type="button" class="btn btn-info btn-sm" name="modifUser" onclick="loadToMain('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('modifSousComptesForm.php')); ?>', {id : <?php echo $user["id"]; ?> }); return false;">Modifier</button>
					<button type="button" class="btn btn-danger btn-sm" name="suppUser" onclick="loadToMain('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('bloquerUser.controllerForm.php')); ?>', {id : <?php echo $user["id"]; ?>}); return false;">Bloquer</button></td>
				</tr>
				<?php
				}
			}
			?>
			</tbody>
		</table> 
	</div>
	<?php 
	}
	else
	{
		"Vous n'êtes pas autorisé à accéder à cette page";
	}