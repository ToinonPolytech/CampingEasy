<?php
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
	
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	require_once(i("database.class.php"));
	
	function makeDayForm($d, $name_day, $horaires)
	{
		?>
		<span> <?php echo ucfirst($name_day); ?> <input type="checkbox" id="checkbox_<?php echo $name_day; ?>" onclick="$('#<?php echo $name_day; ?>_horaires').toggle();" /> Ouvert ?</span><br/>
		<div id="<?php echo $name_day; ?>_horaires" style="display:none;">
			<?php
				$j=1;
				$i=0;
				$array_horaires=array();
				while($i<48)
				{
					while ($i<48 && !$horaires[$d][$i])
					{
						$i++;
					}
					if ($i==0 && $horaires[$d][47] && !in_array($i, $array_horaires))
					{
						while ($i<48 && $horaires[$d][$i])
						{
							$array_horaires[]=$i;
							$i++;
						}
						$seconde_horaire=$i-1;
						$i=47;
						while ($i>0 && $horaires[$d][$i])
						{
							$array_horaires[]=$i;
							$i--;
						}
						$first_horaire=$i+1;
						if ($j>1) echo "<br/>";
						?>
						<input type="text" name="horaire_open_<?php echo $name_day; ?>_<?php echo $j ?>" id="horaire_open_<?php echo $name_day; ?>_<?php echo $j ?>" placeholder="Heure d'ouverture" value="<?php if (floor($first_horaire/2)<10) echo 0; echo floor($first_horaire/2); echo ":"; if ($first_horaire%2==1) echo 30; else echo "00"; ?>" />
						<input type="text" name="horaire_close_<?php echo $name_day; ?>_<?php echo $j ?>" id="horaire_close_<?php echo $name_day; ?>_<?php echo $j ?>" placeholder="Heure de fermeture" value="<?php if (floor($seconde_horaire/2)<10) echo 0; echo floor($seconde_horaire/2); echo ":"; if ($seconde_horaire%2==1) echo 30; else echo "00"; ?>" />
						<?php
						$j++;
						$i=$seconde_horaire;
					}
					else
					{
						if ($i<48 && !in_array($i, $array_horaires))
						{
							$first_horaire=$i;
							if ($i==47 || $horaires[$d][$i+1])
							{
								if ($i!=47)
								{
									while ($i<48 && $horaires[$d][$i])
									{
										$array_horaires[]=$i;
										$i++;
									}
								}
								else
								{
									$array_horaires[]=$i;
									$i++;
								}
								$i--;
								$seconde_horaire=$i;
							}
							if ($j>1) echo "<br/>";
							?>
							<input type="text" name="horaire_open_<?php echo $name_day; ?>_<?php echo $j ?>" id="horaire_open_<?php echo $name_day; ?>_<?php echo $j ?>" placeholder="Heure d'ouverture" value="<?php if (floor($first_horaire/2)<10) echo 0; echo floor($first_horaire/2); echo ":"; if ($first_horaire%2==1) echo 30; else echo "00"; ?>" />
							<input type="text" name="horaire_close_<?php echo $name_day; ?>_<?php echo $j ?>" id="horaire_close_<?php echo $name_day; ?>_<?php echo $j ?>" placeholder="Heure de fermeture" value="<?php if (floor($seconde_horaire/2)<10) echo 0; echo floor($seconde_horaire/2); echo ":"; if ($seconde_horaire%2==1) echo 30; else echo "00"; ?>" /> 
							<?php
							$j++;
						}
					}
					$i++;
				}
				if ($j==1)
				{
					?>
					<input type="text" name="horaire_open_<?php echo $name_day; ?>_1" id="horaire_open_<?php echo $name_day; ?>_1" placeholder="Heure d'ouverture" />
					<input type="text" name="horaire_close_<?php echo $name_day; ?>_1" id="horaire_close_<?php echo $name_day; ?>_1" placeholder="Heure de fermeture" /> 
					<?php
				}
				else
				{
					?>
					<script type="text/javascript">
						$("#checkbox_<?php echo $name_day; ?>").click();
					</script>
					<?php
				}
			?>
			<img src="unknow" alt="+" onclick="addHoraires('<?php echo $name_day; ?>');" id="button_plus_<?php echo $name_day; ?>" name="button_plus_<?php echo $name_day; ?>" /><br/>
		</div>
		<?php
	}
	
	if (!auth() || $_SESSION["access_level"]=="CLIENT" || $_SESSION["access_level"]=="PARTENAIRE")
		exit();
	
	if(!isset($_POST['id']))
		exit();
	
	$user=new User($_SESSION["id"]);
	$cuser=new Controller_User($user);
	
	if (!$cuser->can(CAN_EDIT_RESTAURANT_STAFF))
		exit();
	
	$restau=new Restaurant($_POST["id"]);
	$horaires=unserialize($restau->getHeureOuverture());
?>
<div class="col-lg-6" style="width:100%;" name="form-act" id="form-act">
	<h3>Rajouter un restaurant</h3><br/>
	<form role="form"  method="post" id="form_act" name="form_act" enctype="multipart/form-data">
		<div class="form-group">
			<label for="nom">Nom du restaurant</label><br/>
			<input class="form-control" type="text" name="nom" id="nom" value="<?php echo htmlspecialchars($restau->getNom()); ?>"/><br/>
			<label for="description">Description (Menu ect...)</label><br/>
			<textarea class="form-control" type="text" name="description" id="description"><?php echo htmlspecialchars($restau->getDesc()); ?></textarea><br/>
			<label for="capacite">Capacité Max.</label><br/>
			<input class="form-control" type="number" name="capacite" id="capacite" value="<?php echo htmlspecialchars($restau->getCapacite()); ?>"/><br/>
			<label for="horaires">Horaires d'ouvertures</label><br/>
			<?php makeDayForm(1, "lundi", $horaires); ?>
			<?php makeDayForm(2, "mardi", $horaires); ?>
			<?php makeDayForm(3, "mercredi", $horaires); ?>
			<?php makeDayForm(4, "jeudi", $horaires); ?>
			<?php makeDayForm(5, "vendredi", $horaires); ?>
			<?php makeDayForm(6, "samedi", $horaires); ?>
			<?php makeDayForm(0, "dimanche", $horaires); ?>
			<label for="imageAjax" onclick="addImage();">Ajouter une photo</label><br/>
			<?php
				$i=0;
				foreach (explode(",", $restau->getPhotos()) as $val)
				{
					if (!empty($val))
					{
						$i++;
						?>
						<script type="text/javascript">
							addImage('<?php echo htmlspecialchars($val); ?>');
						</script>
						<?php
					}
				}
			?>
			<input type="hidden" name="id" id="id" value="<?php echo htmlspecialchars($_POST["id"]); ?>" />
			<br/><button class="btn btn-success" onclick="loadTo('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('restaurant.controllerForm.php')); ?>','#form_act', '#form-act', 'prepend', true); return false;">Modifier</button>
		</div>
	</form>
</div>
<script type="text/javascript">
	$("input[name^='horaire_close'],input[name^='horaire_open']").datetimepicker({
		startDate:new Date(),
		format:'H:i',
		datepicker:false,
		timepicker:true,
		step:30
	});
	function addHoraires(day)
	{
		var text=$("input[name^='horaire_close_"+day+"']:last").attr("id");
		$id=parseInt(text.replace("horaire_close_", ""))+parseInt(1);
		
		$varcode='<br/><input type="text" name="horaire_open_'+day+'_'+$id+'" id="horaire_open_'+day+'_'+$id+'" placeholder="Heure douverture" /> <input type="text" name="horaire_close_'+day+'_'+$id+'" id="horaire_close_'+day+'_'+$id+'" placeholder="Heure de fermeture" /><img src="unknow" alt="+" onclick="addHoraires(\''+day+'\');" id="button_plus_'+day+'" name="button_plus_'+day+'" />';
		$("#button_plus_"+day).remove();
		$("input[name^='horaire_close_"+day+"']:last").after($varcode);
		
		$("#horaire_open_"+day+"_"+$id).datetimepicker({
			startDate:new Date(),
			format:'H:00',
			datepicker:false,
			timepicker:true,
			step:30
		});
		$("#horaire_close_"+day+"_"+$id).datetimepicker({
			startDate:new Date(),
			format:'H:00',
			datepicker:false,
			timepicker:true,
			step:30
		});
	}
</script>