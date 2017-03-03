  <?php
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
		
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
?>
<div class="col-lg-6" style="width:100%;" name="form-equipe" id="form-equipe">
	<?php		
		require_once(i("database.class.php"));
		$db = new Database();
		$db->select("equipe", array( 'id' => $_SESSION['id']));
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
		while($data=$db->fetch())
		{
			?>
			<tr>
				<td><?php echo $data['nom']; ?></td> 
				<td><?php echo $date['score']; ?></td>
				<td><button type="button" class="btn btn-info btn-sm" name="voirActivite" onclick="loadToMain('includes/view/equipeView.php', {id : <?php echo $data["id"]; ?>}); return false;">Gérer</button></td>
				<td><button type="button" class="btn btn-info btn-sm" name="voirActivite" onclick="loadToMain('includes/view/supprimerEquipe.php', {id : <?php echo $data["i"]; ?>}); return false;">Supprimer</button></td>
				

			</tr>
			<?php
		}
		?>
		</tbody>
	</table> 
</div>