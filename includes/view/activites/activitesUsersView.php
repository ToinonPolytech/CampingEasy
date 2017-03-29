  <?php
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
		
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	?><div class="col-lg-6" style="width:100%;" name="form-equipe" id="form-equipe">
	<?php 
	
		require_once(i("database.class.php"));
		$db = new Database();
		$db->selectJoin("activities", array("users AS u ON idDirigeant=u.id"), array('access_level' => 'CLIENT'));
	?>
	<table class='table'>
		<thead>
			<tr>
			  <th>Utilisateur</th>
			  <th>Activité proposée</th>
			   <th>Date </th>
			   <th>Options</th> 
			</tr>
		</thead>
		<tbody>
		<?php
		while($data=$db->fetch())
		{	
			?>
			<tr>
				<td><?php echo $data['u.nom']+" "+$data['u.prenom']; ?></td> 
				<td><?php echo $data['activities.nom']; ?></td>
				<td><?php echo date("d/m/y H:m" , $data['time_start']);  ?></td>
				<td><button type="button" class="btn btn-info btn-sm" name="voirActivite" onclick="loadToMain('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('activiteView.php')); ?>', {id : <?php echo $data["id"]; ?>  }); return false;">Voir</button></td>
							
			</tr>
			<?php
		}
		?>
		</tbody>
	</table> 
</div>