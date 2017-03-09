   <?php
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
		
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	?> 
	<div class="col-lg-6" style="width:100%;" name="form-equipe" id="form-equipe">
	<?php
	if($_SESSION['access_level']!='CLIENT')
	{
			?>
			<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('ajoutUserForm.php')); ?>" class="pull-left">Ajouter un utilisateur </a>
		<?php
		
			require_once(i("database.class.php"));
			$db = new Database();
			$db2 = new Database(); 
			$db->select("users");
		?>
		<table class='table'>
			<thead>
				<tr>
				  <th>Nom</th>
				  <th>Prénom<th>
				   <th>Emplacement</th>
				   <th>Qualité</th>
					<th>Modifier </th>
					<th> Supprimer </th> 
									 
				</tr>
			</thead>
			<tbody>
			<?php
			while($data=$db->fetch())
			{	$db2->select('userinfos',array('id' => $data['infoId']));
				$infoU = $db2->fetch();
				?>
				<tr>
					<td><?php echo $data['nom']; ?></td> 
					<td><?php echo $data['prenom']; ?></td>
					<td><?php echo $infoU['emplacement']; ?></td>
					<td><?php echo $data['access_level']; ?></td>
					<td><button type="button" class="btn btn-info btn-sm" name="voirActivite" onclick="loadToMain('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('activiteView.php')); ?>', {id : <?php echo $data["id"]; ?>  }); return false;">Consulter </button></td>
					<td><button type="button" class="btn btn-info btn-sm" name="modifPart" onclick="loadToMain('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('modifierPartenaireForm.php')); ?>', {id : <?php echo $data["id"]; ?>  }); return false;">Modifier</button></td>
					<td><button type="button" class="btn btn-danger btn-sm" name="suppPart" onclick="loadToMain('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('supprimerPartenaire.php')); ?>', {id : <?php echo $data["id"]; ?>}); return false;">Supprimer</button><td>
					
					
				</tr>
				<?php
			}
			?>
			</tbody>
		</table> 
	</div>
	<?php 
	}
	else
	{
		"Vous n'êtes pas autorisez à accéder à cette page";
	}