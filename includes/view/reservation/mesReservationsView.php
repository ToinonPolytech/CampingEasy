<?php
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
		
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
?>
<div class="col-lg-6" style="width:100%;" name="form-equipe" id="form-equipe">
	<?php		
		require_once(i("database.class.php"));
		$db = new Database();
		$db2 = new Database();
		$db->select("reservation", array('idUser' => $_SESSION['id']));
	?>
	<table class='table'>
		<thead>
			<tr>
				<th>Réservation pour</th>
				<th>Date</th>
				<th>Nombre de personnes</th>
				<th>Options</th> 
			</tr>
		</thead>
		<tbody>
		<?php
		while($data=$db->fetch())
		{
			if ($data["type"]=="ACTIVITE")
			{
				?>
				<tr>
					<td><?php echo $db2->getValue("activities", array("id" => $_POST["id"]), "nom"); ?></td> 
					<td><?php echo date("d/m/y H:i", $data['time']); ?></td>
					<td><?php echo $data['nbrPersonne'];?></td>
					<td>
						<button type="button" class="btn btn-info btn-sm" name="voirActivite" onclick="loadToMain('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i("activiteView.php")); ?>', {id : <?php echo $data["id"]; ?>}); return false;">Consulter</button>
						<button type="button" class="btn btn-danger btn-sm" name="suppReservation" onclick="loadToMain('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('supprimerReservation.php')); ?>', {id : <?php echo $data["id"]; ?>, type : <?php echo $data["type"]; ?>}); return false;">Annuler</button>
					</td>
				</tr>
				<?php
			}
		}
		?>
		</tbody>
	</table> 
</div>