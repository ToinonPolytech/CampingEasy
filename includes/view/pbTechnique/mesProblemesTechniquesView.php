  <?php
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
		
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
?>
<div class="col-lg-6" style="width:100%;" name="form-equipe" id="form-equipe">
<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('ajoutProblemeTechniqueForm.php')); ?>" class="pull-left"> Signaler un problème technique  </a>
	<?php		
		require_once(i("database.class.php"));
		$db = new Database();
		$db->select("problemes_technique",array( 'idUsers' => $_SESSION['id']));
	?>
	<table class='table'>
		<thead>
			<tr>
			  <th>#</th>
			  <th>Description</th>
			   
				<th>Modifier </th>
				<th> Supprimer </th> 
				
			</tr>
		</thead>
		<tbody>
		<?php
		$i=0;
		while($data=$db->fetch())
		{	$i++
			?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $data['description']; ?></td>
				
				
				<td><button type="button" class="btn btn-info btn-sm" name="modifPart" onclick="loadToMain('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('modifierProblemeTechniqueForm.php')); ?>', {id : <?php echo $data["id"]; ?>  }); return false;">Modifier</button></td>
				<td><button type="button" class="btn btn-danger btn-sm" name="suppPart" onclick="loadToMain('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('supprimerProblemeTechnique.php')); ?>', {id : <?php echo $data["id"]; ?>}); return false;">Supprimer</button><td>
			
				
			</tr>
			<?php
		}
		?>
		</tbody>
	</table> 
</div>