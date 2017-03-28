<?php
	if (!isset($_SESSION))
		session_start();
	
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	
	if (!auth())
		exit;
	
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
?>
<div class="col-lg-6" style="width:100%;" name="form-camping" id="form-camping">
	<span class="pull-left">Ajouter un lieu au camping</span><br/>
	<form role="form" method="post" enctype="multipart/form-data" name="form-lc" id="form-lc">
		<div class="form-group">
			<label for="nom">Entrez le nom du lieu</label><br/>
			<input class="form-control" type="text" name="nom" id="nom"/> <br />
			<label for="nom">Description du lieu</label><br/>
			<textarea class="form-control" rows="6" cols="30" type="text" name="description" id="description"></textarea> <br />
			<label for="horaires_bool">Le lieu commun est-il réservable ?</label>
			<input type="checkbox" value="true" name="estReservable" id="estReservable" onclick="$('#horaires_div').toggle();"/><br/>
			<div id="horaires_div" name="horaires_div" style="display:none;">
				<label for="horaires">Horaires d'ouvertures</label><br/>
				<?php makeDay("lundi"); ?>
				<?php makeDay("mardi"); ?>
				<?php makeDay("mercredi"); ?>
				<?php makeDay("jeudi"); ?>
				<?php makeDay("vendredi"); ?>
				<?php makeDay("samedi"); ?>
				<?php makeDay("dimanche"); ?>
			</div>
			<label for="imageAjax" onclick="addImage();">Ajouter une photo</label><br/>
			<button class="btn btn-success" onclick="loadTo('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('lieuCommun.controllerForm.php')); ?>', '#form-lc', '#form-camping', 'prepend', true); return false;">Ajouter</button>
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