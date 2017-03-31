  <?php
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
		
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
?>
<div class="col-lg-6" style="width:100%;" name="form-equipe" id="form-equipe">

	<?php	
		if ($_SESSION["access_level"]!="CLIENT")
			?> <a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('ajoutLieuCommunForm.php')); ?>" class="pull-left">Ajouter un lieu </a>
				<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('ajoutRestaurantForm.php')); ?>" class="pull-left">Ajouter un restaurant </a>
	<?php	
		require_once(i("database.class.php"));
		$db = new Database();
	
	?>
	<table class='table'>
		<thead>
			<tr>
			  <th>Service </th>
			  <th>Nom </th>
			  <th>Description </th>
			  <th> Réservation   </th>
			  <?php
				
				
				if ($_SESSION["access_level"]!="CLIENT")
								{ ?> 
										<th>Modifier </th>
										<th> Supprimer </th> 
								<?php } ?> 
			</tr>
		</thead>
		<tbody>
		<?php
		$db->select("lieu_commun");
		while($data=$db->fetch())
		{	
			?>
			<tr> 
				<td>Espace commun</td> 
				<td><?php echo $data['nom']; ?></td> 
				<td><?php echo $data['description']; ?></td>
				
				<?php if($data['estReservable']==1 )// si état des lieux réservable => page de réservation de lieu ou dynamique avec champs pour la réservation 
				?>
						<td><button type="button" class="btn btn-info btn-sm" name="reservLieu" onclick="loadToMain('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('reserverLieuForm.php')); ?>', {id : <?php echo $data["id"]; ?>  }); return false;">Réserver</button></td>
						<td><button type="button" class="btn btn-info btn-sm" name="reservLieu" onclick="loadToMain('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('lieuCommunView.php')); ?>', {id : <?php echo $data["id"]; ?>  }); return false;">Détail</button></td>
						
				<?php if ($_SESSION["access_level"]!="CLIENT")
				{ ?> 				
					<td><button type="button" class="btn btn-info btn-sm" name="modifLieu" onclick="loadToMain('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('modifierLieuCommunForm.php')); ?>', {id : <?php echo $data["id"]; ?>  }); return false;">Modifier</button></td>
					<td><button type="button" class="btn btn-danger btn-sm" name="suppLieu" onclick="loadToMain('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('supprimerLieuCommun.php')); ?>', {id : <?php echo $data["id"]; ?>}); return false;">Supprimer</button><td>
				<?php } ?> 
				
			</tr>
			<?php
		}
		$db->select("restaurant");
		while($data=$db->fetch())
		{	
			?>
			<tr> 
				<td>Restaurant</td> 
				<td><?php echo $data['nom']; ?></td> 
				<td><?php echo $data['description']; ?></td>
				
				<td><button type="button" class="btn btn-info btn-sm" name="ereservLieu" onclick="loadToMain('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('reserverRestau.php')); ?>', {id : <?php echo $data["id"]; ?>  }); return false;">Réserver une table non ok </button></td>
				
						
				<?php if ($_SESSION["access_level"]!="CLIENT")
				{ ?> 				
					<td><button type="button" class="btn btn-info btn-sm" name="modifLieu" onclick="loadToMain('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('modifierRestaurantForm.php')); ?>', {id : <?php echo $data["id"]; ?>  }); return false;">Modifier</button></td>
					<td><button type="button" class="btn btn-danger btn-sm" name="suppLieu" onclick="loadToMain('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('supprimerRestau.php')); ?>', {id : <?php echo $data["id"]; ?>}); return false;">Supprimer non ok </button><td>
				<?php } ?> 
				
			</tr>
			<?php
		}
		?>
		</tbody>
	</table> 
</div>