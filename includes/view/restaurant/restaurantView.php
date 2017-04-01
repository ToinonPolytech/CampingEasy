   <?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	require_once(i("restaurant.class.php"));
	require_once(i("database.class.php"));
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
	if (!isset($_POST["id"]) || !is_numeric($_POST["id"]))
		exit();
	$id=$_POST["id"];
	?> 
	<div class="col-lg-6" style="width:40%;" name="form-equipe" id="form-equipe">
		<?php 
			$resto=new Restaurant($id);		
		?>	
		<ul class="list-group"> //photo 
			<li class="list-group-item">Nom :<?php echo $resto->getNom();?></li>
			<li class="list-group-item">Description : <?php echo $resto->getDescription();?></li>		
		</ul>
	</div>
	<?php 
	
	$horaires=unserialize($resto->getHeureOuverture());
	foreach ($horaires as $day => $horaires_sub)
{
	switch ($day)
	{
		case 0:
			echo "Dimanche";
			break;
		case 1:
			echo "Lundi";
			break;
		case 2:
			echo "Mardi";
			break;
		case 3:
			echo "Mercredi";
			break;
		case 4:
			echo "Jeudi";
			break;
		case 5:
			echo "Vendredi";
			break;
		case 6:
			echo "Samedi";
			break;
	}
	foreach ($horaires_sub as $heures => $bool)
	{
		if (floor($heures/2)<10) echo "0";
		echo floor($heures/2)."h";
		if ($heures%2) echo "30"; else echo "00";
		if ($bool) echo "Ouvert"; else echo "Fermé"; 
		echo "<br/>";
	}
	echo "<br/>";
	if($_SESSION['access_level']!='CLIENT')
						{ 	
						?>
							<button class="btn btn-success" onclick="loadToMain('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('modifierRestaurant.php')); ?>', {id: <?php echo $_POST['id']; ?> }); return false;">Modifier</button>
						<?php 							
						}	
	}
	?>