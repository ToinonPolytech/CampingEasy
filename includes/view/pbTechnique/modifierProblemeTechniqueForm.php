  <?php
	if (!isset($_SESSION))
		session_start();
	
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");

	require_once(i("database.class.php"));
	require_once(i("images.class.php"));	
	require_once(i("problemeTechnique.class.php"));
		if(!auth() || !isset($_POST['id']))
			exit();
	 
		$pb=new PbTech($_POST["id"]);
		
		if ($pb->getIdUser()!=$_SESSION["id"])
			exit();
	?>


<div class="col-lg-6" style="width:100%;" name="formulaire-pbt" id="formulaire-pbt">
	<span class="pull-left">Signaler un problème technique</span><br/>
	<form role="form" method="post" name="form-pbt" id="form-pbt" enctype="multipart/form-data">
		<div class="form-group">
			<label for="nom">Expliquez le problème que vous rencontrez</label><br/>
			<textarea class="form-control" rows="6" cols="30" type="text" name="description" id="description" ><?php echo htmlspecialchars($pb->getDescription());?></textarea>
			<label for="isBungalow">Le problème se passe dans mon bungalow ?</label><br/>
			<input type="radio" name="isBungalow" value="true" id="oui" <?php if ($pb->getIsBungalow()) { echo "checked"; } ?> />Oui
			<input type="radio"  name="isBungalow" value="false" id="non" <?php if (!$pb->getIsBungalow()) { echo "checked"; } ?> />Non<br/>
			<label for="imageAjax" onclick="addImage();">Ajouter une photo</label><br/>
			<?php
				$i=0;
				foreach ($pb->getPhotos() as $val)
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
			<button class="btn btn-success" onclick="loadTo('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('problemeTechnique.controllerForm.php')); ?>', '#form-pbt', '#formulaire-pbt', 'prepend', true); return false;">Signaler</button>

		</div>
	</form>
</div>
