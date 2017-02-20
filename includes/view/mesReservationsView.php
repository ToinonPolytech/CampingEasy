<?php
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
?>
<div class="col-lg-6" style="width:100%;" name="form-equipe" id="form-equipe">
	<?php		
		require_once("/../modele/database.class.php");
		$db = new Database();
		$db->selectJoin("reservation", array("activities ON id=idActivite"), rray('idUser' => $_SESSION['id']));
	?>
	<table class='table'>
		<thead>
			<tr>
			  <th>#</th>
			  <th>Activité </th>
			  <th>Date </th>
			  <th>Nombre de personnes </th>
			  <th>Consulter l'activité</th>
			  <th> Supprimer </th> 
			</tr>
		</thead>
		<tbody>
		<?php
		while($data=$db->fetch())
		{
			?>
			<tr>
				<td><?php echo $data['nom']; ?></td> 
				<td><?php echo date("d/m/y H:i",$data['time_start']); ?></td>
				<td><?php echo $data['nbrPersonne']; ?></td>
				<td><button type="button" class="btn btn-info btn-sm" name="suppReservation" onclick="loadToMain('includes/controller/controllerFormulaire/supprimerReservation.php', {id : <?php echo $data["idActivite"]; ?>}); return false;">Consulter</button></td>
				<td><button type="button" class="btn btn-danger btn-sm" name="suppReservation" onclick="loadToMain('includes/controller/controllerFormulaire/supprimerReservation.php', {id : <?php echo $data["idActivite"]; ?>}); return false;">Supprimer</button><td>
				<td><input class="form-control" type="number" name="nbrPersonne" value="<?php echo $data['nbrPersonne'];?>" id="nbrPersonne"/></td>
				<td><button type="button" class="btn btn-info btn-sm" name="suppReservation" onclick="loadToMain('includes/controller/controllerFormulaire/activiteView.php', {id : <?php echo $data["idActivite"]; ?>}); return false;">Modifier</button></td>
			</tr>
			<?php
		}
		?>
		</tbody>
	</table> 
</div>