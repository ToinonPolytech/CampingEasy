<?php
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
?>
<div class="col-lg-6" style="width:100%;" name="form_user" id="form_user">
	<h3>Ajoutez un sous utilisateur </h3><br/>
	<form role="form"  method="post" id="form_user" name="form_user">
		<div class="form-group">
			<label for="nom">Nom</label><br/>
			<input class="form-control" type="text" name="nom" id="nom"/> <br />
			<label for="prenom">Prénom</label><br/>
			<input class="form-control" type="text" name="prenom" id="prenom"/> <br />
			<label for="creerSousCompte">Autoriser ce compte à créer des sous_comptes </label><br/>
			<input type="radio" name="creerSousCompte" value="true" id="oui" checked="checked" />Oui
			<input type="radio"  name="creerSousCompte" value="false" id="non" />Non<br/>
			<label for="creerActivite">Autoriser ce compte à créer des activités </label><br/>
			<input type="radio" name="creerActivite" value="true" id="oui" checked="checked" />Oui
			<input type="radio"  name="creerActivite" value="false" id="non" />Non<br/>
			<label for="reserverActivite">Autoriser ce compte à réserver des activités </label><br/>
			<input type="radio" name="reserverActivite" value="true" id="oui" checked="checked" />Oui
			<input type="radio"  name="reserverActivite" value="false" id="non" />Non<br/>
			<label for="payer">Autoriser ce compte à effectuer des paiements sur le camping </label><br/>
			<input type="radio" name="payer" value="true" id="oui" checked="checked" />Oui
			<input type="radio"  name="payer" value="false" id="non" />Non<br/>
			
			
			
			<button class="btn btn-success" onclick="loadTo('includes/controller/controllerFormulaire/subUser.controllerForm.php',$('#form_user').serialize() , '#form_user', 'prepend'); return false;">Ajouter</button>
		</div>
	</form>
</div>
<script type="text/javascript">
	$("#date").datetimepicker({
		format:'d-m-Y H:00'
	});
</script>