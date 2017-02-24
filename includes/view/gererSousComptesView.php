<?php
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
		
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
?>
<div class="col-lg-6" style="width:100%;" name="form-equipe" id="form-equipe">
	<?php		
		require_once(i("database.class.php"));
		$db = new Database();
		$db->select("users", array('infoId' => $_SESSION["infoId"]));
	?>
	<table class='table'>
		<thead>
			<tr>
				<th>Nom</th>
				<th>Prénom</th> 
				<th>Options</th> 
			</tr>
		</thead>
		<tbody>
		<?php
		while($data=$db->fetch())
		{   
			if ($data["id"]!=$_SESSION["id"])
			{
			?>
				<tr>
					<td><?php echo $data['nom']; ?></td> 
					<td><?php echo $data['prenom']; ?></td>
					<td><button type="button" class="btn btn-warning" onclick="loadToMain('includes/view/modifSousComptesForm.php', {id : <?php echo $data["id"]; ?>}); return false;">Modifier</button><td>
				</tr>
			<?php
			}
		}
		?>
		</tbody>
	</table> 
</div>