  <?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	require_once(i("lieuCommun.class.php"));
	require_once(i("database.class.php"));
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
	if (!isset($_POST["id"]) || !is_numeric($_POST["id"]))
		exit();
	if (!auth())
		exit();
	
	$id=$_POST["id"];
?> 
<div class="col-lg-6" style="width:40%;" name="form-equipe" id="form-equipe">
	<?php 
		$lieu= new LieuCommun($id);		
	?>	
	<ul class="list-group">
		<li class="list-group-item">Nom : <?php echo $lieu->getNom(); ?></li>
		<li class="list-group-item">Description <?php echo $lieu->getDescription(); ?></li>	
		<?php
			foreach (explode(",", $lieu->getPhotos()) as $photos)
			{
				?>
				<img src="<?php echo $photos; ?>" />
				<?php
			}
		?>
	</ul>
</div>
<?php 
	if($_SESSION['access_level']!='CLIENT' && $_SESSION['access_level']!='PARTENAIRE')
	{ 	
	?>
		<button class="btn btn-success" onclick="loadToMain('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('modifierLieuCommunForm.php')); ?>', {id: <?php echo $_POST['id']; ?> }); return false;">Modifier</button>
	<?php 							
	}
	
?>