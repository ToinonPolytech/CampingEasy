<?php 
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();

	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	require_once(i("database.class.php"));
	$db1 = new Database();
	$db2 = new Database();
	$db1->select("activities", array('idDirigeant' => $_SESSION['id']));
?>
<div class="col-lg-6" style="width:100%;" name="form-actview" id="form-actview">
	<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('ajoutActiviteForm.php')); ?>" class="pull-left">Créer une activité </a>
	<table class='table'>
		<thead>
			<tr>
				<th>Nom </th>
				<th>Date </th>
				<th>Nombre de personnes inscrites</th>
				<th>Modifier</th>
				<th>Supprimer</th> 
			</tr>
		</thead>
		<tbody>
		<?php
		$i=0;
		while($act=$db1->fetch())
		{	if($act['time_start']>=time())
			{
				$i++;
				$nbRes=0; 
				//on sélectionne le nombre de personnes inscrites dans la réservation pour l'activité concernée
				$db2->select("reservation", array('id' => $act['id']), array("nbrPersonne"));  
				while ($nbPersRes = $db2->fetch())
				{ //tant qu'il existe des réservations pour cette activité 
					$nbRes=$nbRes+$nbPersRes["nbrPersonne"]; //on somme le nombre de personnes inscrites 
				}
				?>
				<tr>
					<td><?php echo htmlentities($act['nom']); ?></td> 
					<td><?php echo date("d/m/y H:i",$act['time_start']); ?></td>
					<td><?php echo $nbRes; ?></td>
					<td><button type="button" class="btn btn-info btn-sm" name="modifActivite"  onclick="loadToMain('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('gererActiviteForm.php')); ?>',{id : <?php echo $act["id"]; ?>}); return false;">Modifier</button></td>
					<td><button type="button" class="btn btn-danger btn-sm" name="suppReservation"  onclick="loadTo('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('supprimerActivite.php')); ?>')">Supprimer</button></td>
				</tr>
				<?php
			}
		}
		if($i==0) echo "Vous n'avez pas d'activité";
		?>
		</tbody>
	</table> 
</div>