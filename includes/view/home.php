<?php
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
	
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	require_once(i("database.class.php"));
	?>
	<div class="col-lg-6" style="width:100%;" name="form-connexion" id="form-connexion">
		<?php
		if (auth()) 
		{	 
			echo "Vous êtes dorénavant connecté.";
			?>
			<script type="text/javascript">
				loadTo("includes/view/menu.php", {}, "#menu_nav", "append");
			</script>
			<?php
		}
		else
		{
			$database = new Database();
			if (!isset($_GET["new"]) && isset($_COOKIE["clef"]) && $database->count('users', array("clef" => htmlspecialchars($_COOKIE["clef"])))==1)
			{
				?>
				<span class="pull-left">Bonjour, <?php echo htmlspecialchars($database->getValue('users', array("clef" => htmlspecialchars($_COOKIE["clef"])), "nom"))." ".htmlspecialchars($database->getValue('users', array("clef" => htmlspecialchars($_COOKIE["clef"])), "prenom")); ?></span><br/>
				<form role="form">
					<div class="form-group">
						<?php
						if ($database->count('users', array("clef" => htmlspecialchars($_COOKIE["clef"]), "code" => NULL))==1)
						{
						?>
							<input type="text" class="form-control" name="code" id="code" placeholder="Créez votre mot de passe de 4 caractères."><br/>
						<?php
						}
						else
						{
						?>
							<input type="text" class="form-control" name="code" id="code" placeholder="Votre mot de passe de 4 caractères."><br/>
						<?php
						}
						?>
						<button class="btn btn-success" onclick="loadTo('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('connexionUser.controller.php')); ?>', {code : $('#code').val()}, '#form-connexion', 'prepend'); return false;">Se connecter 2/2</button>
					</div>
				</form>	
				<?php
			}
			else
			{
				if (isset($_COOKIE["clef"]))
					setcookie("clef", "", time()-3600);
				
				?>
				<form role="form" onsubmit="$(this).children().children('button').click(); return false;">
					<div class="form-group">
						<label class="control-label">Votre identifiant</label>
						<input type="text" class="form-control" name="clef" id="clef" placeholder="Votre identifiant de 6 caractères."><br/>
						<button class="btn btn-success" onclick="loadTo('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('connexionUser.controller.php')); ?>', {clef : $('#clef').val()}, '#form-connexion', 'prepend'); return false;">Se connecter 1/2</button>
					</div>
				</form>		
				<?php
			}
		}
		?>
	</div>