<?php
	if (!isset($_SESSION))
		session_start();
	
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
?>
<div class="col-lg-6" style="width:100%;" name="form-user" id="form-user">
	<h3>Ajoutez un utilisateur </h3><br/>
	<form role="form"  method="post">
		<div class="form-group">
			<label for="numPlace">Numéro d'emplacement </label><br/>
			<input class="form-control" type="number" name="numPlace" id="numPlace"/> <br />
			<label for="email">Adresse mail</label><br/>
			<input class="form-control" type="email" name="email" id="email"/> <br />
			<label for="date">Date de départ</label><br/>
			<input id="date" name="date" type="text" ><br />
			<label for="type">Type du compte</label><br/>
			<select class="form-control" name="type" id="type">
				<option value="CLIENT">Client</option>
				<option value="ANIMATEUR">Animateur</option>
				<option value="TECHNICIEN">Technicien</option>
				<option value="PATRON">Directeur</option>
			</select><br/>
			<label for="nom">Nom</label><br/>
			<input class="form-control" type="text" name="nom" id="nom"/> <br/>
			<label for="prenom">Prénom</label><br/>
			<input class="form-control" type="text" name="prenom" id="prenom"/> <br/>
			<button class="btn btn-success" onclick="loadTo('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('user.controllerForm.php')); ?>', {numPlace : $('#numPlace').val(), mail : $('#email').val(), date : $('#date').val(), type : $('#type').val(), nom : $('#nom').val(), prenom : $('#prenom').val()}, '#form-user', 'prepend'); return false;">Ajouter</button>
		</div>
	</form>
</div>
<script type="text/javascript">
	$("#date").datetimepicker({
		format:'d-m-Y H:00'
	});
</script>