<?php
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
	
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	require_once(i("database.class.php"));
	
	function makeDay($name_day)
	{
		?>
		<span> <?php echo ucfirst($name_day); ?> <input type="checkbox" onclick="$('#<?php echo $name_day; ?>_horaires').toggle();" /> Ouvert ?</span><br/>
		<div id="<?php echo $name_day; ?>_horaires" style="display:none;">
			<input type="text" name="horaire_open_<?php echo $name_day; ?>_1" id="horaire_open_<?php echo $name_day; ?>_1" placeholder="Heure d'ouverture" />
			<input type="text" name="horaire_close_<?php echo $name_day; ?>_1" id="horaire_close_<?php echo $name_day; ?>_1" placeholder="Heure de fermeture" /> <img src="unknow" alt="+" onclick="addHoraires('<?php echo $name_day; ?>');" id="button_plus_<?php echo $name_day; ?>" name="button_plus_<?php echo $name_day; ?>" /><br/>
		</div>
		<?php
	}
	
	if (!auth())
		exit();
?>
<div class="col-lg-6" style="width:100%;" name="form-act" id="form-act">
	<h3>Rajouter un restaurant</h3><br/>
	<form role="form"  method="post" id="form_act" name="form_act" enctype="multipart/form-data">
		<div class="form-group">
			<label for="nom">Nom du restaurant</label><br/>
			<input class="form-control" type="text" name="nom" id="nom"/><br/>
			<label for="description">Description (Menu ect...)</label><br/>
			<textarea class="form-control" type="text" name="description" id="description"></textarea><br/>
			<label for="capacite">Capacité Max.</label><br/>
			<input class="form-control" type="number" name="capacite" id="capacite" value="20"/><br/>
			<label for="horaires">Horaires d'ouvertures</label><br/>
			<?php makeDay("lundi"); ?>
			<?php makeDay("mardi"); ?>
			<?php makeDay("mercredi"); ?>
			<?php makeDay("jeudi"); ?>
			<?php makeDay("vendredi"); ?>
			<?php makeDay("samedi"); ?>
			<?php makeDay("dimanche"); ?>
			<label for="imageAjax" onclick="addImage();">Ajouter une photo</label>
			<br/><button class="btn btn-success" onclick="loadTo('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('restaurant.controllerForm.php')); ?>','#form_act', '#form-act', 'prepend', true); return false;">Créer</button>
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