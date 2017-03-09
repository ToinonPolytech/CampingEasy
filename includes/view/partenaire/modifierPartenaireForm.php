<?php
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
		
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	require_once(i("partenaire.class.php")); 
	
	if(isset($_POST['id']))
	{
		 
		$part = new Partenaire($_POST['id']); 
		
?>		 <div class="col-lg-6" style="width:100%;" name="form-partenaire" id="form-partenaire">
			<span class="pull-left">Modifier le partenaire </span><br/>
			<form role="form" method="post">
				<div class="form-group">
				
					<label for="nom">Entrez le nom du partenaire</label><br/>
					<input class="form-control" type="text" name="nom" id="nom" value="<?php echo $part->getNom(); ?>" required/><br/>
					<label for="nom">Description du partenaire</label><br/>
					<textarea class="form-control" rows="6" cols="30" type="text"  name="libelle" value="<?php echo $part->getLibelle(); ?>" id="libelle" required><?php echo $part->getLibelle(); ?></textarea> <br/>
					<label for="nom">Email</label><br/>
					<input class="form-control" type="email" name="mail" id="mail" value="<?php echo $part->getMail(); ?>" required/><br/>
					<label for="nom">Site Web</label><br/>
					<input class="form-control" type="url" name="siteWeb" id="siteWeb" value="<?php echo $part->getSiteWeb(); ?>"/><br/>
					<label for="nom">Téléphone</label><br/>
					<input class="form-control" type="tel" name="telephone" id="telephone" value="<?php echo $part->getTelephone(); ?>"/><br/>
					<input type="checkbox" name="isUser" id="isUser" checked="<?php  if($part->getIdUser()!=0){echo 'checked'; }?> "/>
					<label for="isUser">Je suis ce partenaire </label><br/>
					<button class="btn btn-success" onclick="loadTo('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('partenaire.controllerForm.php')); ?>', {id : <?php echo $_POST['id']; ?>, nom : $('#nom').val(), libelle :  $('#libelle').val(), mail : $('#mail').val(), siteWeb : $('#siteWeb').val(), telephone : $('#telephone').val(), isUser : $('#isUser').val()}, '#form-partenaire', 'prepend'); return false;">Modifier</button>
				</div>
			</form>
		</div>

	<?php 
	}
	else
	{
		echo 'Aucun partenaire sélectionné'; 
	}