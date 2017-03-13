 <?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	require_once(i("problemeTechnique.class.php"));
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
	if (!isset($_POST["id"]) || !is_numeric($_POST["id"]))
		exit();
	$id=$_POST["id"];
?> 
<div class="col-lg-6" style="width:40%;" name="form-message" id="form-message">
	<?php 
		$pbt= new PbTech($id);
	?>
	<ul class="list-group">
		<li class="list-group-item">Description : <?php echo $pbt->getDescription(); ?></li>
		<li class="list-group-item">Date de création : <?php echo date("d/m/y H:i", $pbt->getTimeCreated()); ?></li>
		<li class="list-group-item">Se situe sur l'emplacement : <?php if($pbt->getIsBungalow()==1)
																		{
																			echo "Oui";
																		}
																		else
																		{
																			echo "Non";
																		}
																		?></li>
		
		
		<li class="list-group-item">Envoyer un message à l'utilisateur </li>
		<form role="form" method="post" name="form-message" id="form-message">
			<div class="form-group">
				<textarea class="form-control" rows="6" cols="30" type="text" name="message" id="message"></textarea>
				<button class="btn btn-success" onclick="loadTo('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('problemeTechniqueInfo.controllerForm.php')); ?>', $.extend({}, $('#form-message').serialize(), {idPbTech : <?php echo $id;?>}), '#form-message', 'prepend'); return false;">Envoyer</button>
			<div>
		</form>
	</ul>
</div>