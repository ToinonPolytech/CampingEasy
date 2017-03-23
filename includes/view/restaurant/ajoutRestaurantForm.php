<?php
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
	
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	require_once(i("database.class.php"));
	
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
			<span> Lundi <input type="checkbox" onclick="$('#lundi_horaires').toggle();" /> Ouvert ?</span><br/>
			<div id="lundi_horaires" style="display:none;">
				<input type="text" name="horaire_open_lundi_1" id="horaire_open_lundi_1" placeholder="Heure d'ouverture" />
				<input type="text" name="horaire_close_lundi_1" id="horaire_close_lundi_1" placeholder="Heure de fermeture" /> <img src="unknow" alt="+" onclick="addHoraires('lundi');" id="button_plus_lundi" name="button_plus_lundi" /><br/>
			</div>
			<span> Mardi <input type="checkbox" onclick="$('#mardi_horaires').toggle();" /> Ouvert ?</span><br/>
			<div id="mardi_horaires" style="display:none;">
				<input type="text" name="horaire_open_mardi_1" id="horaire_open_mardi_1" placeholder="Heure d'ouverture" />
				<input type="text" name="horaire_close_mardi_1" id="horaire_close_mardi_1" placeholder="Heure de fermeture" /> <img src="unknow" alt="+" onclick="addHoraires('mardi');" id="button_plus_mardi" name="button_plus_mardi" /><br/>
			</div>
			<span> Mercredi <input type="checkbox" onclick="$('#mercredi_horaires').toggle();" /> Ouvert ?</span><br/>
			<div id="mercredi_horaires" style="display:none;">
				<input type="text" name="horaire_open_mercredi_1" id="horaire_open_mercredi_1" placeholder="Heure d'ouverture" />
				<input type="text" name="horaire_close_mercredi_1" id="horaire_close_mercredi_1" placeholder="Heure de fermeture" /> <img src="unknow" alt="+" onclick="addHoraires('mercredi');" id="button_plus_mercredi" name="button_plus_mercredi" /><br/>
			</div>
			<span> Jeudi <input type="checkbox" onclick="$('#jeudi_horaires').toggle();" /> Ouvert ?</span><br/>
			<div id="jeudi_horaires" style="display:none;">
				<input type="text" name="horaire_open_jeudi_1" id="horaire_open_jeudi_1" placeholder="Heure d'ouverture" />
				<input type="text" name="horaire_close_jeudi_1" id="horaire_close_jeudi_1" placeholder="Heure de fermeture" /> <img src="unknow" alt="+" onclick="addHoraires('jeudi');" id="button_plus_jeudi" name="button_plus_jeudi" /><br/>
			</div>
			<span> Vendredi <input type="checkbox" onclick="$('#vendredi_horaires').toggle();" /> Ouvert ?</span><br/>
			<div id="vendredi_horaires" style="display:none;">
				<input type="text" name="horaire_open_vendredi_1" id="horaire_open_vendredi_1" placeholder="Heure d'ouverture" />
				<input type="text" name="horaire_close_vendredi_1" id="horaire_close_vendredi_1" placeholder="Heure de fermeture" /> <img src="unknow" alt="+" onclick="addHoraires('vendredi');" id="button_plus_vendredi" name="button_plus_vendredi" /><br/>
			</div>
			<span> Samedi <input type="checkbox" onclick="$('#samedi_horaires').toggle();" /> Ouvert ?</span><br/>
			<div id="samedi_horaires" style="display:none;">
				<input type="text" name="horaire_open_samedi_1" id="horaire_open_samedi_1" placeholder="Heure d'ouverture" />
				<input type="text" name="horaire_close_samedi_1" id="horaire_close_samedi_1" placeholder="Heure de fermeture" /> <img src="unknow" alt="+" onclick="addHoraires('samedi');" id="button_plus_samedi" name="button_plus_samedi" /><br/>
			</div>
			<span> Dimanche <input type="checkbox" onclick="$('#dimanche_horaires').toggle();" /> Ouvert ?</span><br/>
			<div id="dimanche_horaires" style="display:none;">
				<input type="text" name="horaire_open_dimanche_1" id="horaire_open_dimanche_1" placeholder="Heure d'ouverture" />
				<input type="text" name="horaire_close_dimanche_1" id="horaire_close_dimanche_1" placeholder="Heure de fermeture" /> <img src="unknow" alt="+" onclick="addHoraires('dimanche');" id="button_plus_dimanche" name="button_plus_dimanche" /><br/>	
			</div>
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