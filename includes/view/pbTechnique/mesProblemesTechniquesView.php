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
		$db2 = new Database(); 
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
			if($db2->count('problemes_technique_info', array('idPbTech' => $data['id'], "idUser" => array('!=',$_SESSION['id'])))>0)
			{	$db2->select('problemes_technique_info', array('idPbTech' => $data['id'], "idUser" => array('!=',$_SESSION['id'])));
				while($mes=$db2->fetch())
				{ 
					require_once(i('user.class.php'));
					$user= new User($mes['idUser']);
					?>
					
					<tr>
						<td><?php echo 'Message du technicien :'?> </td>
						<td><i><?php echo $mes['message']?></i></td>
						<td><i><?php echo ' envoyé par '.$user->getPrenom().' '.$user->getNom().' le '.date("d/m/y H:i",$mes['time']);?> </i></td>
					</tr> 
				<?php 
				}
			}
		}
		?>
		</tbody>
	</table> 
</div>