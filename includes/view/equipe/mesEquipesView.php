  <?php
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
		
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
?>
<div class="col-lg-6" style="width:100%;" name="form-equipe" id="form-equipe">
<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('ajoutEquipeForm.php')); ?>" class="pull-left">Créer une équipe </a>
<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('classementEquipesView.php')); ?>" class="pull-left">Voir le classement </a>
	<?php		
		require_once(i("database.class.php"));
		$db = new Database();
		$db->select("equipe_membres",array( 'idUser' => $_SESSION['id']),array("idEquipe"));
		$db2 = new Database(); 
		
		
	?>
	<table class='table'>
		<thead>
			<tr>
			  <th>Equipe</th>
			  <th>Score </th>
			  <th>Gérer </th>
			  <th>Supprimer </th>
			</tr>
		</thead>
		<tbody>
		<?php
		while($idEquipe=$db->fetch())
		{	$db2->select("equipe", array( 'id' => $idEquipe[0] ));
			$data = $db2->fetch();

			
			?>
			<tr>
				<td><?php echo $data['nom']; ?></td> 
				<td><?php echo $data['score']; ?></td>
				<td><button type="button" class="btn btn-info btn-sm" name="gererEquipe" onclick="loadToMain('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('equipeView.php')); ?>', {id : <?php echo $data["id"]; ?>}); return false;">Gérer</button></td>
				<td><button type="button" class="btn btn-danger btn-sm" name="suppEquipe" onclick="loadToMain('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('supprimerEquipe.php')); ?>', {id : <?php echo $data["id"]; ?>}); return false;">Supprimer</button></td>
				

			</tr>
			<?php
		}
		?>
		</tbody>
	</table> 
</div>