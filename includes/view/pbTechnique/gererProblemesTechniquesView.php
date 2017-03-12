  <?php
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
		
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
?>
<div class="col-lg-6" style="width:100%;" name="form-equipe" id="form-equipe">

	<?php		
		require_once(i("database.class.php"));
		$db = new Database();
		$db->select("problemes_technique");
		$db2 = new Database();
		
		
	?>
	<table class='table'>
		<thead>
			<tr>
			  <th>Signalé par</th>
			  <th></th>
			  <th>Statut</th>
			  <th>Gérer</th>
			  
			</tr>
		</thead>
		<tbody>
		<?php
		while($data=$db->fetch())
		{	$db2->select("users",array('id' => $data['idUsers']),array('nom','prenom'));
			$user = $db2->fetch();
			
			
			?>
			<tr>
				<td><?php echo $user['nom']; ?></td> 
				<td><?php echo $user['prenom']; ?></td>
				<td><?php echo $data['solved']; ?></td>
				<td><button type="button" class="btn btn-info btn-sm" name="gererPbt" onclick="loadToMain('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('gererProblemeTechniqueView.php')); ?>', {id : <?php echo $data["id"]; ?>}); return false;">Gérer</button></td>
				
				

			</tr>
			<?php
		}
		?>
		</tbody>
	</table> 
</div>