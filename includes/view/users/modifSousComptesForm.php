<?php
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
	
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	require_once(i("client.class.php"));
	require_once(i("client.controller.class.php"));
	
	if (!auth())
		exit();
	
	$clientParent=new Client($_SESSION["id"]);
	$clientChild=new Client($_POST["id"]);
	$controller=new Controller_Client($clientParent);
	if (!$controller->canEdit($clientChild))
		exit();
	$controller=new Controller_Client($clientChild);
?>
<div class="col-lg-6" style="width:100%;" name="form-user" id="form-user">
	<h3>Modifier un sous utilisateur </h3><br/>
	<form role="form"  method="post" id="form_user" name="form_user">
		<div class="form-group">
			<label for="nom">Nom</label><br/>
			<input class="form-control" type="text" name="nom" id="nom" value="<?php echo htmlentities($clientChild->getNom()); ?>"/> <br />
			<label for="prenom">Prénom</label><br/>
			<input class="form-control" type="text" name="prenom" id="prenom" value="<?php echo htmlentities($clientChild->getPrenom()); ?>"/> <br />
			<label for="creerSousCompte">Autoriser ce compte à créer des sous_comptes </label><br/>
			<input type="radio" name="creerSousCompte" value="true" id="oui" <?php if ($controller->can(CAN_CREATE_SUBACCOUNT)) { echo 'checked="checked"'; } ?> />Oui
			<input type="radio"  name="creerSousCompte" value="false" id="non" <?php if (!$controller->can(CAN_CREATE_SUBACCOUNT)) { echo 'checked="checked"'; } ?> />Non<br/>
			<label for="creerActivite">Autoriser ce compte à créer des activités </label><br/>
			<input type="radio" name="creerActivite" value="true" id="oui" <?php if ($controller->can(CAN_CREATE_ACTIVITIES)) { echo 'checked="checked"'; } ?> />Oui
			<input type="radio"  name="creerActivite" value="false" id="non" <?php if (!$controller->can(CAN_CREATE_ACTIVITIES)) { echo 'checked="checked"'; } ?> />Non<br/>
			<label for="reserverActivite">Autoriser ce compte à réserver des activités </label><br/>
			<input type="radio" name="reserverActivite" value="true" id="oui" <?php if ($controller->can(CAN_JOIN_ACTIVITIES)) { echo 'checked="checked"'; } ?> />Oui
			<input type="radio"  name="reserverActivite" value="false" id="non" <?php if (!$controller->can(CAN_JOIN_ACTIVITIES)) { echo 'checked="checked"'; } ?> />Non<br/>
			<label for="payer">Autoriser ce compte à effectuer des paiements sur le camping </label><br/>
			<input type="radio" name="payer" value="true" id="oui" <?php if ($controller->can(CAN_PAY)) { echo 'checked="checked"'; } ?> />Oui
			<input type="radio"  name="payer" value="false" id="non" <?php if (!$controller->can(CAN_PAY)) { echo 'checked="checked"'; } ?> />Non<br/>
			<input type="hidden"  name="id" value="<?php echo htmlentities($_POST["id"]); ?>" id="id" />
			<button class="btn btn-success" onclick="loadTo('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('subUser.controllerForm.php')); ?>',$('#form_user').serialize() , '#form_user', 'prepend'); return false;">Ajouter</button>
		</div>
	</form>
</div>