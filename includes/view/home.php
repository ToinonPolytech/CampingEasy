<?php
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
	
	require("/../fonctions/general.php");
	require("/../modele/database.class.php");
	?>
	<div class="col-lg-6" style="width:100%;" name="form-connexion" id="form-connexion">
		<?php
		if (auth()) 
		{
			/**
				- On affiche les options disponibles à cet utilisateur.
			**/
		}
		else
		{
			$database = new Database();
			if (!isset($_GET["new"]) && isset($_COOKIE["clef"]) && $database->count('users', array("id" => htmlspecialchars($_COOKIE["clef"])))==1)
			{
				?>
				<span class="pull-left">Clef : <?php echo htmlspecialchars($_COOKIE["clef"]); ?></span>
				<form role="form">
					<div class="form-group">
						<label class="control-label">Votre mot de passe</label>
						<input type="text" class="form-control" name="code" id="code" placeholder="Votre mot de passe de 4 caractères."><br/>
						<input type="hidden" class="form-control" name="clef" id="clef" value="<?php echo htmlspecialchars($_COOKIE["clef"]); ?>"><br/>
						<label class="control-label"><a href="home.php?new=true">Ceci n'est pas vous ?</a></label>
						<button class="btn btn-success" onclick="loadTo('includes/controllerFormulaire/connexionUser.controller.php', {code : $('#code').val(), clef : $('#clef').val()}, '#form-connexion', 'prepend'); return false;">Se connecter 2/2</button>
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
						<button class="btn btn-success" onclick="loadTo('includes/controllerFormulaire/connexionUser.controller.php', {clef : $('#clef').val()}, '#form-connexion', 'prepend'); return false;">Se connecter 1/2</button>
					</div>
				</form>		
				<?php
			}
		}
		?>
	</div>