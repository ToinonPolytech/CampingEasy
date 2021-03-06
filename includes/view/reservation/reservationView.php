 <?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	require_once(i("reservation.class.php"));
	
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
	if (!isset($_POST["id"]) || !is_numeric($_POST["id"]))
		exit();
	
?> 
<div class="col-lg-6" style="width:40%;" name="form-equipe" id="form-equipe">
	<?php 
		$res= new Reservation($_POST['id'], $_POST['type'],$_SESSION['id']);
	?>
	<ul class="list-group">
		<li class="list-group-item">Type : <?php echo $res->getType(); ?></li>
		<li class="list-group-item">Date : <?php echo date("d/m/y H:i", $res->getTime()); ?></li>
		
		<?php if($res->getType()=='ACTIVITE')
				{	?>
					<li class="list-group-item">Nombre de personne inscrites : </li>
					<form method="post" id="form_reservation" name="form_reservation">
						<input type="number" name="nbrPersonnes" id="nbrPersonnes" class="form-control" value="<?php echo $res->getNbrPersonne();?>"/>
						<button class="btn btn-success" onclick="loadTo('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('reservation.controllerForm.php')); ?>', {nbrPersonnes : $('#nbrPersonnes').val(), type : 'ACTIVITE', id : <?php echo $_POST['id'];?>}, '#form-equipe', 'prepend'); return false;">Modifier</button>
					</form>
					<?php 
					$lien = "activiteView.php";
					require_once(i("activities.class.php"));
					$objet = new Activite($_POST['id']);
					
				}
				else if($res->getType()=='LIEU_COMMUN')
				{
					$lien= "lieuCommunView.php";
					require_once(i("lieuCommun.class.php"));
					$obet = new LieuCommun($_POST['id']);
					
				}
				else if($res->getType()=='RESTAURANT')
				{
					$lien= "restaurantView.php.php";
					require_once(i("restaurant.class.php"));
					$objet = new Restaurant($_POST['id']);
					?>
					<li class="list-group-item">Nombre de personnes pour la réservation : </li>
					<form method="post" id="form_reservation" name="form_reservation">
						<input type="number" name="nbrPersonnes" id="nbrPersonnes" class="form-control" value="<?php echo $res->getNbrPersonne();?>"/>
						<button class="btn btn-success" onclick="loadTo('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('reservation.controllerForm.php')); ?>', {nbrPersonnes : $('#nbrPersonnes').val(), type : 'ACTIVITE', id : <?php echo $_POST['id'];?>}, '#form-equipe', 'prepend'); return false;">Modifier</button>
					</form>
					<?php 
				}
				?>
			<li class="list-group-item">Concerne : <?php echo $objet->getNom(); ?></li>			
			<button type="button" class="btn btn-info btn-sm" name="voirService" onclick="loadToMain('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i($lien)); ?>', {id : <?php echo $_POST["id"]; ?>}); return false;">Voir le service</button>
		
		
	</ul>
</div>
