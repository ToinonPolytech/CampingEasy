 <?php
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
		
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	
		?><div class="col-lg-6" style="width:100%;" name="form-equipe" id="form-equipe"><a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('mesEquipesView.php')); ?>" class="pull-left">Voir mes équipes </a>
	<?php
		
		require_once(i("database.class.php"));
		$db = new Database();
		$db->select("equipe"); //manque sélection dans ordre de score 
	?>
	<table class='table'>
		<thead>
			<tr>
			  <th>Position</th>
			  <th>Equipe</th>
			   <th>Score </th>
			</tr>
		</thead>
		<tbody>
		<?php
		$i=0;
		while($data=$db->fetch())
		{ $i++; 
			?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $data['nom']; ?></td> 
				<td><?php echo $data['score']; ?></td> 
								
			</tr>
			<?php
		}
		?>
		</tbody>
	</table> 
</div>