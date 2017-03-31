<?php
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
		
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	
	if (!auth())
		exit();
	
	require_once(i("client.class.php"));
	require_once(i("client.controller.class.php"));
	
	$client=new Client($_SESSION["id"]);
	$controller=new Controller_Client($client);
	if (!$controller->can(CAN_CREATE_SUBACCOUNT))
		exit;
?>
<div class="col-lg-6" style="width:100%;" name="form-equipe" id="form-equipe">
	<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('ajoutSousCompteForm.php')); ?>" class="pull-left">Ajouter un sous-compte</a>
	<?php		
		require_once(i("database.class.php"));
		require_once(i("user.class.php"));
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
			{	$user = new User($data['id']);
				$cuser = new Controller_Client($user);
				
			?>
				<tr>
					<td><?php echo $data['nom']; ?></td> 
					<td><?php echo $data['prenom']; ?></td>
					
					<td><button type="button" class="btn btn-warning" onclick="loadToMain('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('modifSousComptesForm.php')); ?>', {id : <?php echo $data["id"]; ?>}); return false;">Modifier</button></td>
					<td id="<?php echo $data["id"]; ?>_options"><button type="button" class="btn btn-danger btn-sm" name="suppUser" onclick="loadTo('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('bloquerUser.controllerForm.php')); ?>', {id : <?php echo $data["id"]; ?>}, '#<?php echo $data["id"]; ?>_options', 'replace'); return false;"><?php if ($cuser->can(CAN_LOG)) { echo "Bloquer"; } else { echo "Débloquer"; } ?></button></td>
				</tr>
			<?php
			}
		}
		?>
		</tbody>
	</table> 
</div>