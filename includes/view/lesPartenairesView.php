 <?php
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
		
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
?>
<div class="col-lg-6" style="width:100%;" name="form-equipe" id="form-equipe">
	<?php		
		require_once(i("database.class.php"));
		$db = new Database();
		$db->select("partenaire");
	?>
	<table class='table'>
		<thead>
			<tr>
			  <th>Partenaire</th>
			  <th>Service proposé</th>
			   <th>Contacter </th>
				<?php if ($_SESSION["access_level"]!="CLIENT")
								{ ?> 
										<th>Modifier </th>
										<th> Supprimer </th> 
								<?php } ?> 
			</tr>
		</thead>
		<tbody>
		<?php
		while($data=$db->fetch())
		{
			?>
			<tr>
				<td><?php echo $data['nom']; ?></td> 
				<td><?php echo $data['description']; ?></td>
				<td><button type="button" class="btn btn-info btn-sm" name="voirActivite" onclick="loadToMain('includes/view/activiteView.php', {id : <?php echo $data["id"]; ?>  }); return false;">Contacter </button></td>
				<?php if ($_SESSION["access_level"]!="CLIENT")
				{ ?> 				
					<td><button type="button" class="btn btn-info btn-sm" name="modifPart" onclick="loadToMain('includes/view/modifierPartenaireForm.php', {id : <?php echo $data["id"]; ?>  }); return false;">Modifier</button></td>
					<td><button type="button" class="btn btn-danger btn-sm" name="suppPart" onclick="loadToMain('includes/controller/controllerFormulaire/supprimerReservation.php', {id : <?php echo $data["id"]; ?>}); return false;">Supprimer</button><td>
				<?php } ?> 
				
			</tr>
			<?php
		}
		?>
		</tbody>
	</table> 
</div>