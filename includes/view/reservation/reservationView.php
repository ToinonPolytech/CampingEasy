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
		<li class="list-group-item">Nombre de personne inscrites : <?php echo $res->getNbrPersonne(); ?></li>
		<?php if($res->getType()=='ACTIVITE')
				{
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
				}
				?>
			<li class="list-group-item">Concerne : <?php echo $objet->getNom(); ?></li>			
			<button type="button" class="btn btn-info btn-sm" name="voirService" onclick="loadToMain('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i($lien)); ?>', {id : <?php echo $_POST["id"]; ?>}); return false;">Voir le service</button>
		
		
	</ul>
</div>
