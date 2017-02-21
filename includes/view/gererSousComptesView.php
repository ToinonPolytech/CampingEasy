<?php
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
?>
<div class="col-lg-6" style="width:100%;" name="form-equipe" id="form-equipe">
	<?php		
		require_once("/../modele/database.class.php");
		require_once("/../modele/client.class.php");
		require_once("/../controller/controllerObjet/client.controller.class.php");
		$db = new Database();
		$db2 = new Database();
		$infoID = $db2->getValue("users", array('id' => $_SESSION['id']),"infoId");
		$db->select("userInfos", array('id' => $infoID ));
	?>
	<table class='table'>
		<thead>
			<tr>
			  <th> Nom </th>
			  <th>Prenom </th>
			  <th> Creer Sous-Compte </th>
			  <th> Réserver activité</th>
			  <th> Créer activité</th> 
			    <th>Payer </th> 
				  <th> Modifier</th> 
			</tr>
		</thead>
		<tbody>
		<?php
		while($data=$db->fetch())
		{   $subUser = new Client($data['id']);
			$controller = new Controller_Client($subUser);
			if($controller->can("CAN_CREATE_SUBACCOUNT"))
			{
				$sousCompte = "Oui";
			}
			else
			{
				$sousCompte = "Non";
			}
			if($controller->can("CAN_JOIN_ACTIVITIES"))
			{
				$joinAct = "Oui";
			}
			else
			{
				$joinAct = "Non";
			}
			if($controller->can("CAN_CREATE_ACTIVITIES"))
			{
				$creerAct = "Oui";
			}
			else
			{
				$creerAct = "Non";
			}
			if($controller->can("CAN_PAY"))
			{
				$payer = "Oui";
			}
			else
			{
				$payer = "Non";
			}
			
			?>
			<tr>
				<td><?php echo $data['nom']; ?></td> 
				<td><?php echo $data['prenom']; ?></td>
				<td><?php echo $sousCompte; ?></td>
				<td><?php echo $joinAct; ?></td>
				<td><?php echo $creerAct; ?></td>
				<td><?php echo $payer; ?></td>
				
				<td><input class="form-control" type="number" name="nbrPersonne" value="<?php echo "non fait" ;?>" id="nbrPersonne"/> <button type="button" class="btn btn-info btn-sm" name="suppReservation" onclick="loadToMain('includes/controller/controllerFormulaire/activiteView.php', {id : <?php echo $data["idActivite"]; ?>}); return false;">Modifier</button></td>
				
				<td><button type="button" class="btn btn-danger btn-sm" name="suppReservation" onclick="loadToMain('includes/controller/controllerFormulaire/supprimerReservation.php', {id : <?php echo $data["idActivite"]; ?>}); return false;">Bloquer</button><td>
			</tr>
			<?php
		}
		?>
		</tbody>
	</table> 
</div>