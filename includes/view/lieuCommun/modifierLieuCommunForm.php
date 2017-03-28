 <?php
	if (!isset($_SESSION))
		session_start();
	
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	require_once(i("lieuCommun.class.php"));
	require_once(i("database.class.php"));
	
	if (!auth())
		exit();

	
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
	
	if(isset($_POST['id']))
	{
		$lc=new LieuCommun($_POST["id"]);
		$horaires=unserialize($lc->getHeureReservable());
?>
		<div class="col-lg-6" style="width:100%;" name="form-camping" id="form-camping">
			<span class="pull-left">Modification du lieu  </span><br/>
			<form role="form" method="post" enctype="multipart/form-data" name="form-lc" id="form-lc">
				<div class="form-group">
					<label for="nom">Entrez le nom du lieu</label><br/>
					<input class="form-control" type="text" name="nom" id="nom" value="<?php echo htmlspecialchars($lc->getNom()); ?>"/> <br />
					<label for="nom">Description du lieu</label><br/>
					<textarea class="form-control" rows="6" cols="30" type="text" name="description" id="description"><?php echo htmlspecialchars($lc->getDescription()); ?></textarea> <br />
					<label for="horaires_bool">Le lieu commun est-il réservable ?</label>
					<input type="checkbox" value="true" name="estReservable" id="estReservable" onclick="$('#horaires_div').toggle();" <?php if ($lc->getEstReservable()) { echo 'checked'; } ?>/><br/>
					<div id="horaires_div" name="horaires_div" <?php if (!$lc->getEstReservable()) { echo 'style="display:none;'; } ?>>
						<label for="horaires">Horaires d'ouvertures</label><br/>
						<?php makeDayForm(1, "lundi", $horaires); ?>
						<?php makeDayForm(2, "mardi", $horaires); ?>
						<?php makeDayForm(3, "mercredi", $horaires); ?>
						<?php makeDayForm(4, "jeudi", $horaires); ?>
						<?php makeDayForm(5, "vendredi", $horaires); ?>
						<?php makeDayForm(6, "samedi", $horaires); ?>
						<?php makeDayForm(0, "dimanche", $horaires); ?>
					</div>
					<label for="imageAjax" onclick="addImage();">Ajouter une photo</label><br/>
					<?php
						$i=0;
						foreach (explode(",", $lc->getPhotos()) as $val)
						{
							if (!empty($val))
							{
								$i++;
								?>
								<script type="text/javascript">
									addImage('<?php echo htmlentities($val); ?>');
								</script>
								<?php
							}
						}
					?>
					<input type="hidden" name="id" id="id" value="<?php echo htmlentities($_POST["id"]); ?>" />
					<button class="btn btn-success" onclick="loadTo('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('lieuCommun.controllerForm.php')); ?>', '#form-lc', '#form-camping', 'prepend', true); return false;">Modifier</button>
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
<?php 
	}
	else
	{
		echo 'Aucun lieu reçu pour la modification'; 
	}
?>